<?php
namespace App\Repositories;
use App\Models\Invoice;

class InvoiceRepository extends BaseRepository implements InvoiceRepositoryInterface {


    function __construct(Invoice $invoice)
    {
        parent::__construct($invoice);
    }


}