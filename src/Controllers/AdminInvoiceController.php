<?php

namespace App\Controllers;

use App\Models\Invoice;
use App\Models\Paginator;

class AdminInvoiceController
{
    public function index()
    {
        $limit = (isset($_GET['limit']) && is_numeric($_GET['limit'])) ?
            (int)$_GET['limit'] : 5;
        $page = (isset($_GET['page']) && is_numeric($_GET['page'])) ?
            (int)$_GET['page'] : 1;
        $count = Invoice::count();


        $paginator = new Paginator(
            totalRecords: (int)$count,
            recordsPerpage: $limit,
            currentPage: $page
        );

        $invoice = new Invoice();

        $invoices = $invoice->paginate($paginator->recordOffset, $paginator->recordsPerpage);
        $pages = $paginator->getPages(length: 3);

        render_view('admin_invoice', [
            'invoices' => $invoices,
            'paginator' => $paginator,
            'pages' => $pages
        ]);
    }
}
