<?php

namespace App\Models;


class Invoice extends Model
{
    public $invoice_id, $customer_id, $invoice_status, $total, $payment_method, $shipment_method, $created_at;

    public function __construct()
    {
        parent::__construct();
    }

    public function fill(array $record): Invoice
    {
        $this->invoice_id = $record['invoice_id'] ?? -1;
        $this->invoice_status = htmlspecialchars($record['invoice_status'] ?? '');
        $this->total = htmlspecialchars($record['total'] ?? '');
        $this->payment_method = htmlspecialchars($record['payment_method'] ?? '');
        $this->shipment_method = htmlspecialchars($record['shipment_method'] ?? '');

        $this->customer_id = $record['customer_id'] ?? '';

        return $this;
    }

    public function add()
    {

        $sql = "INSERT INTO invoices(customer_id, invoice_status, total, payment_method, shipment_method)
         VALUES (:customer_id,:invoice_status,:total,:payment_method,:shipment_method)";

        $stmt = $this->getPDO()->prepare($sql);

        $stmt->execute([
            ':customer_id' => $this->customer_id,
            ':invoice_status' => $this->invoice_status,
            ':total' => $this->total,
            ':payment_method' => $this->payment_method,
            ':shipment_method' => $this->shipment_method
        ]);
        if ($this->invoice_id == -1) {
            $this->invoice_id = $this->getPDO()->lastInsertId();
        }
    }

    public function getCustomerID(): string
    {
        return $this->customer_id;
    }

    public function getInvoiceID(): int
    {
        return $this->invoice_id;
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

    public static function getInvoiceByID(int $id): array
    {
        $sql = 'SELECT * FROM invoices WHERE invoice_id = :invoice_id';

        $model = new Model();

        $stmt = $model->getPDO()->prepare($sql);

        $stmt->execute([
            ':invoice_id' => $id
        ]);

        return $stmt->fetch();
    }

    public static function getAllInvoice(): array
    {
        $sql = 'SELECT * FROM invoices';

        $model = new Model();

        $stmt = $model->getPDO()->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll();
    }

    public static function count(): int
    {
        $sql = 'SELECT COUNT(*) FROM invoices';

        $model = new Model();
        $stmt = $model->getPDO()->prepare($sql);

        $stmt->execute();

        return $stmt->fetchColumn(0);
    }

    protected function fillfromDB(array $row): Invoice
    {
        [
            'invoice_id' => $this->invoice_id,
            'invoice_status' => $this->invoice_status,
            'created_at' => $this->created_at,
            'total' => $this->total,
            'payment_method' => $this->payment_method,
            'shipment_method' => $this->shipment_method,
            'customer_id' => $this->customer_id

        ] = $row;

        return $this;
    }

    public function paginate(int $offset = 0, int $lim = 10): array
    {
        $contacts = [];

        $sql = 'SELECT * FROM invoices LIMIT :offset, :lim';
        $stmt = $this->getPDO()->prepare($sql);
        $stmt->bindValue(':offset', $offset, $this->getPDO()::PARAM_INT);
        $stmt->bindValue(':lim', $lim, $this->getPDO()::PARAM_INT);
        $stmt->execute();

        while ($row = $stmt->fetch()) {
            $contact = new Invoice($this->getPDO());
            $contact->fillfromDB($row);
            $contacts[] = $contact;
        }

        return $contacts;
    }
}
