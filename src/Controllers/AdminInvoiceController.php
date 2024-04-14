<?php

namespace App\Controllers;

use App\Models\Invoice;
use App\Models\Paginator;
use App\Models\Book;
use App\Models\Customer;
use App\Models\Details;

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

    public function show()
    {
        $id = get_URL_Param(4)[1];

        $bookModel = new Book();
        $customer = new Customer();

        $detailArr = Details::getAllDetails($id);

        $books = [];
        foreach ($detailArr as $detail) {
            $books[] = [
                Book::getBookByID((int)$detail['id_book']),
                'quantity' => (int)$detail['quantity']
            ];
        }

        $invoice = Invoice::getInvoiceByID((int)$id);

        $customerArr = $customer->getCustomerById((int)$invoice['customer_id']);

        render_view('admin_invoice_detail', $customerArr, [
            'books' => $books,
            'invoice' => $invoice
        ]);
    }

    public function update()
    {
        $invoice = new Invoice();
        $invoice = $invoice->getInvoiceByID($_POST['invoice_id']);
        $invoice_status = $invoice['invoice_status'];

        if ($invoice_status !== 'Đã duyệt') {
            Invoice::update_status($_POST['invoice_id'], 'Đã duyệt');
            $_SESSION['pass'] = 'success';
            redirect('/admin/invoice');
        } else {
            $_SESSION['pass'] = 'failed';
            $url = '/admin/invoice/detail/id=' . $_POST['invoice_id'];
            redirect($url);
        }
    }

    public function find()
    {

        $needed_status = $_POST['status'];
        $date = $_POST['date'];

        if ($date === '' && $needed_status !== '#') {

            $invoices = new Invoice();

            $invoices = $invoices->findByStatus($needed_status);

            render_view('admin_invoice', [
                'invoices' => $invoices
            ]);
        } elseif ($date !== '' && $needed_status === '#') {
            $invoices = new Invoice();

            $invoices = $invoices->findByDate($date);

            render_view('admin_invoice', [
                'invoices' => $invoices
            ]);
        } else {
            redirect('/admin/invoice');
        }
    }

    public function destroy()
    {
        $id = $_POST['invoice_id_hidden'];

        $invoice = new Invoice();
        $invoice = $invoice->getInvoiceByID($id);

        if ($invoice['invoice_status'] !== 'Đã duyệt') {
            if (Invoice::deleteInvoice($id)) {
                $_SESSION['admin-invoice-delete'] = 'success';
                redirect('/admin/invoice');
            }
        } else {
            $_SESSION['admin-invoice-delete'] = 'failed';
            redirect('/admin/invoice');
        }
    }
}
