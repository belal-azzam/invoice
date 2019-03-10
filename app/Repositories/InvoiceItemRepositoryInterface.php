<?php
namespace App\Repositories;
interface InvoiceItemRepositoryInterface extends BaseRepositoryInterface {
    public function deleteOldInvoiceItems($invoiceId, $excludedIds);
}
