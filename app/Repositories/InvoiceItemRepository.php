<?php
namespace App\Repositories;
use App\Models\InvoiceItem;

class InvoiceItemRepository extends BaseRepository implements InvoiceItemRepositoryInterface {
    function __construct(InvoiceItem $invoiceItem)
    {
        parent::__construct($invoiceItem);
    }

    public function deleteOldInvoiceItems($invoiceId, $excludedIds)
    {
        $oldInvoiceITems = $this->model->where('invoice_id', '=', $invoiceId)->whereNotIn('id', $excludedIds)->get();
        if(count($oldInvoiceITems))
        {
            return $this->model->where('invoice_id', '=', $invoiceId)->whereNotIn('id', $excludedIds)->delete();
        }
        return true;
    }
}