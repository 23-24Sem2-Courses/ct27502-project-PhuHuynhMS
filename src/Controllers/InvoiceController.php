<?php

namespace App\Controllers;

use App\Models\Customer;
use App\Models\Details;
use App\Models\Invoice;

class InvoiceController
{
    public function index()
    {
        $id = $_SESSION['id'];
        $invoices = Invoice::getInvoiceByCustomerID($id);
        render_view('invoice', [
            "invoices" => $invoices
        ]);
    }

    public function store()
    {
        //Nhận dữ liệu POST từ client
        $data = json_decode(file_get_contents("php://input"), true);

        $invoice = new Invoice();
        $detail = new Details();
        $customer = new Customer();

        $record = getSessionValues($_SESSION, ['logged_in']);
        $customer->fill($record, ['confirmpassword']);

        $invoice_record = [
            'customer_id' => isset($_SESSION['id']) ? (int)$_SESSION['id'] : 0,
            'shipment_method' => isset($_POST['shipment']) ? $_POST['shipment'] : '',
            'payment_method' => isset($_POST['payment']) && $_POST['payment'] == 'payByCash' ? 'Thanh toán bằng tiền mặt' : 'Thanh toán bằng thẻ',
            'invoice_status' => 'Đang chờ kiểm duyệt',
            'total' => isset($_POST['total']) ? (float)$_POST['total'] : 0
        ];

        $books_record = json_decode($_POST['dataFromLocalStorage']);

        $invoice->fill($invoice_record)->add();

        foreach ($books_record as $record) {
            $detail_record = [
                'invoice_id' => $invoice->getInvoiceID(),
                'id_book' => (int)$record->id,
                'quantity' => (int)$record->quantity
            ];

            $detail->fill($detail_record)->add();
        }
    }

    public function destroy()
    {
        $invoice_id = $_POST['invoice_delete_id'];
        $invoice_status = $_POST['invoice_delete_status'];
        $_SESSION['test'] = $_POST['invoice_delete_status'];

        if ($invoice_status === 'Đang chờ kiểm duyệt') {
            if (Invoice::deleteInvoice($invoice_id)) {
                $_SESSION['delete_invoice'] = 'success';
                redirect('/checkout/confirmation');
            }
        }
    }
}
