<?php
namespace App\Repositories;
use App\Models\Invoice;

class InvoiceRepository extends BaseRepository implements InvoiceRepositoryInterface {


    function __construct(Invoice $invoice)
    {
        parent::__construct($invoice);
    }

    function invoiceStatusList()
    {
        return [
            SELF::INVOICE_STATUS_PAID => 'Paid',
            SELF::INVOICE_STATUS_UNPAID => 'Unpaid',
        ];
    }
}