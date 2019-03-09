<?php
namespace App\Repositories;
interface InvoiceRepositoryInterface extends BaseRepositoryInterface {
    const INVOICE_STATUS_PAID = 1;
    const INVOICE_STATUS_UNPAID = 2;
    function invoiceStatusList();

}
