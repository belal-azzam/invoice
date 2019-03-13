<?php
namespace App\Services;
use App\Repositories\InvoiceItemRepositoryInterface;
use App\Repositories\InvoiceRepositoryInterface;
use App\Repositories\ProductRepositoryInterface;
use Illuminate\Http\Request;

class InvoiceService {
    const INVOICE_STATUS_PAID = 1;
    const INVOICE_STATUS_UNPAID = 2;

    private $invoiceRepo = null;
    private $invoiceItemRepo = null;
    private $productRepository = null;
    function __construct(
        InvoiceRepositoryInterface $repo,
        InvoiceItemRepositoryInterface $invoiceItemRepository,
        ProductRepositoryInterface $productRepo
    )
    {
        $this->invoiceRepo  = $repo;
        $this->invoiceItemRepo = $invoiceItemRepository;
        $this->productRepo  = $productRepo;
    }

    function invoiceStatusList()
    {
        return [
            SELF::INVOICE_STATUS_PAID => 'Paid',
            SELF::INVOICE_STATUS_UNPAID => 'Unpaid',
        ];
    }

    function getViewData($invoiceId)
    {
        $invoice = $this->findOrFail($invoiceId);
        return ['statusesText' => $this->invoiceStatusList(),'invoice' => $invoice];
    }

    function findOrFail($id)
    {
        return $this->invoiceRepo->findOrFail($id);
    }

    function find($id)
    {
        return $this->invoiceRepo->find($id);
    }

    function delete($id)
    {
        $this->InvoiceRepo->delete($id);
    }

    function all()
    {
        return $this->invoiceRepo->all();
    }

    function setInvoiceStatus($invoice)
    {
        if(isset($invoice['status']) && $invoice['status'] == SELF::INVOICE_STATUS_PAID)
        {
            $invoice['paid'] = $invoice['total'];
            $invoice['unpaid'] = 0;
        }else{
            $invoice['unpaid'] = $invoice['total'];
            $invoice['paid'] = 0;
            $invoice['status'] = SELF::INVOICE_STATUS_UNPAID;
        }
        return $invoice;
    }

    function setInvoiceTotals($data)
    {
        $invoiceTotal = 0;
        foreach($data['InvoiceItem'] as $k => &$invoiceItem) {
            //calculate totals
            $product = $this->productRepo->find($invoiceItem['product_id']);
            if ($product) {
                $invoiceItemTotal = $invoiceItem['quantity'] * $invoiceItem['item_price'];
                $invoiceTotal += $invoiceItemTotal;
                $invoiceItem['item_total'] = $invoiceItemTotal;
            } else {
                unset($data['InvoiceItem'][$k]);
            }
        }
        $data['total'] = $invoiceTotal;
        return $data;
    }

    /**
     * @param Request $request
     * @return array
     * sets Invoice and invoice item totals
     * set InvoiceStatus
     */
    function processInvoiceData(request $request)
    {
        $data = $request->except(['_token','_method']);
        $data = $this->setInvoiceTotals($data);
        $invoiceItemsData = $data['InvoiceItem'];
        unset($data['InvoiceItem']);
        $data = $this->setInvoiceStatus($data);
        return ['invoiceItemsData' => $invoiceItemsData, 'invoice' => $data];
    }

    function add(request $request){
        $data = $this->processInvoiceData($request);
        $result = $this->invoiceRepo->create($data['invoice']);
        $result = $this->saveInvoiceItems($data['invoiceItemsData'], $result->id);
        return $result;
    }

    function update($id, request $request)
    {
        $data = $this->processInvoiceData($request);
        $result = $this->invoiceRepo->update($data['invoice'], $id);
        $result = $this->saveInvoiceItems($data['invoiceItemsData'], $id);
        return $result;
    }

    /**
     * @param $invoiceItems
     * @param $invoiceId
     */
    function saveInvoiceItems($invoiceItems, $invoiceId)
    {
            $result = false;
            $newItemsIds =  [];
            foreach ($invoiceItems as $k => $invoiceItem)
            {
                $invoiceItem['invoice_id']  = $invoiceId;
                if(isset($invoiceItem['id']))
                {
                    $newItemsIds[]  =  $invoiceItem['id'];
                    $this->invoiceItemRepo->update($invoiceItem, $invoiceItem['id']);
                }else{
                    $result = $this->invoiceItemRepo->create($invoiceItem);
                    $newItemsIds[] = $result->id;
                }
            }
            $result = $this->invoiceItemRepo->deleteOldInvoiceItems($invoiceId, $newItemsIds);
            return $result;
    }
}