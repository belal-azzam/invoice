<?php

namespace App\Http\Controllers;

use App\Repositories\ClientRepositoryInterface;
use App\Repositories\InvoiceItemRepositoryInterface;
use App\Repositories\InvoiceRepositoryInterface;
use App\Repositories\ProductRepositoryInterface;
use Illuminate\Http\Request;

class InvoiceController extends BaseController
{

    var $invoiceRepo;
    var $invoiceItemRepo;
    var $clientRepo;
    var $productRepo;
    function __construct( InvoiceRepositoryInterface $invoiceRepository,
                          InvoiceItemRepositoryInterface $invoiceItemRepo,
                          ProductRepositoryInterface $productRepository,
                          ClientRepositoryInterface $clientRepository
    )
    {
        $this->invoiceRepo = $invoiceRepository;
        $this->invoiceItemRepo = $invoiceItemRepo;
        $this->clientRepo = $clientRepository;
        $this->productRepo = $productRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $invoices = $this->invoiceRepo->all();
        $statuses = $this->invoiceRepo->invoiceStatusList();
        return view('invoices.index', compact('invoices', 'statuses'));
    }

    private function __formCommon()
    {
        $products = $this->productRepo->all();
        $clients = $this->clientRepo->all();

        return ['clients' => $clients, 'products' => $products];
    }

    public function __submitCommon(Request $request)
    {
        $data = $request->except(['_token','_method']);
        if(isset($data['status']) && $data['status'] == $this->invoiceRepo::INVOICE_STATUS_PAID)
        {
            $data['paid'] = $data['total'];
            $data['unpaid'] = 0;
        }else{
            $data['unpaid'] = $data['total'];
            $data['paid'] = 0;
            $data['status'] = $this->invoiceRepo::INVOICE_STATUS_UNPAID;
        }

        $invoiceItemsData = $data['InvoiceItem'];
        unset($data['InvoiceItem']);
        return ['invoiceData' => $data, 'invoiceItemsData' => $invoiceItemsData];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('invoices.create', $this->__formCommon());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $result = $this->__submitCommon($request);
        $invoiceItemsData = $result['invoiceItemsData'];
        $result = $this->invoiceRepo->create($result['invoiceData']);

        if($result)
        {
            foreach ($invoiceItemsData as $k => &$invoiceItem)
            {
                $invoiceItem['invoice_id'] = $result->id;
            }
            $this->invoiceItemRepo->insertAll($invoiceItemsData);
        }
        return redirect()->route('invoices.index')->with('alert-success','Invoice Saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $invoice = $this->invoiceRepo->find($id);
        if($invoice){
            return view('invoices.create', array_merge($this->__formCommon(), ['invoice' => $invoice]));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $result = $this->__submitCommon($request);
        $invoiceItemsData = $result['invoiceItemsData'];

        $result = $this->invoiceRepo->update($result['invoiceData'], $id);
        $oldInvoiceitemsIds = $this->invoiceItemRepo->findBy('invoice_id', $id, ['id'])->toArray();
        var_dump($invoiceItemsData);
        var_dump($oldInvoiceitemsIds);
        dd(1);

        if($result)
        {
            foreach ($invoiceItemsData as $k => &$invoiceItem)
            {
                $invoiceItem['invoice_id'] = $result->id;
            }
            $this->invoiceItemRepo->insertAll($invoiceItemsData);
        }
        return redirect()->route('invoices.index')->with('alert-success','Invoice Saved');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->invoiceRepo->delete($id);
        return redirect()->route('invoices.index')->with('alert-success','Invoice Deleted');
    }
}
