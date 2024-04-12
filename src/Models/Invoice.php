<?php

namespace App\Models;


class Invoice extends Model
{
    private $invoice_id, $customer_id, $invoice_status, $total, $payment_method, $shipment_method;

    public function __construct()
    {
        parent::__construct();
    }

    public function fill(array $record): Invoice
    {
        $this->invoice_id = htmlspecialchars($record['invoice_id'] ?? -1);
        $this->invoice_status = htmlspecialchars($record['invoice_status'] ?? '');
        $this->total = htmlspecialchars($record['total'] ?? '');
        $this->payment_method = htmlspecialchars($record['payment_method'] ?? '');
        $this->shipment_method = htmlspecialchars($record['shipment_method'] ?? '');

        $this->customer_id = $record['customer_id'] ?? '';

        return $this;
    }

    public function add(): bool
    {
        if ($this->invoice_id === -1) {
            $invoice['invoice_id'] = $this->getPDO()->lastInsertId();
        }

        $sql = "INSERT INTO invoices(customer_id, invoice_status, total, payment_method, shipment_method)
         VALUES (:customer_id,:invoice_status,:total,:payment_method,:shipment_method)";

        $stmt = $this->getPDO()->prepare($sql);

        return $stmt->execute([
            ':customer_id' => $this->customer_id,
            ':invoice_status' => $this->invoice_status,
            ':total' => $this->total,
            ':payment_method' => $this->payment_method,
            ':shipment_method' => $this->shipment_method
        ]);
    }

    public function getCustomerID(): string
    {
        return $this->customer_id;
    }

    public function getInvoiceID(): string
    {
        $sql = 'SELECT invoice_id FROM invoices WHERE customer_id = :customer_id';

        $stmt = $this->getPDO()->prepare($sql);

        $stmt->execute([
            ':customer_id' => $this->customer_id
        ]);

        return $stmt->fetchColumn();
    }

    public static function getInvoiceByCustomerID(int $id)
    {
        $sql = 'SELECT * FROM invoices WHERE customer_id = :customer_id';

        $model = new Model();

        $stmt = $model->getPDO()->prepare($sql);

        $stmt->execute([
            ':customer_id' => $id
        ]);

        return $stmt->fetchAll();
    }

    public static function deleteInvoice(int $id): bool
    {
        $sql = 'DELETE FROM invoices WHERE invoice_id = :invoice_id';

        $model = new Model();

        $stmt = $model->getPDO()->prepare($sql);

        return $stmt->execute([
            ':invoice_id' => $id
        ]);
    }
}
