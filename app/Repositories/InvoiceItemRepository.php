<?php
namespace App\Repositories;
use App\Models\InvoiceItem;

class InvoiceItemRepository extends BaseRepository implements InvoiceItemRepositoryInterface {
    function __construct(InvoiceItem $invoiceItem)
    {
        parent::__construct($invoiceItem);
    }
}