<?php

namespace App\Models;


class Invoice extends Model
{
    private $invoice_id, $customer, $status, $total, $payment_method;

    public function __construct()
    {
        parent::__construct();
    }

    public function fill(array $record): Invoice
    {
        $this->invoice_id = htmlspecialchars($record['invoice_id']) ?? -1;
        $this->status = htmlspecialchars($record['status']) ?? '';
        $this->total = htmlspecialchars($record['total']) ?? '';
        $this->payment_method = htmlspecialchars($record['payment_method']) ?? '';

        $customerModel = new Customer();

        $record = getSessionValues($_SESSION, ['logged_in']);

        $this->customer = $customerModel->fill($record);

        return $this;
    }

    public function isCartExist(int $customer_id): array|bool
    {
        $sql = 'SELECT * FROM carts WHERE customer_id = :customer_id';

        $stmt = $this->getPDO()->prepare($sql);

        $stmt->bindParam(':customer_id', $this->customer_id);

        $stmt->execute();

        return $stmt->fetch();
    }

    public function add()
    {
        $sql = 'INSERT INTO carts(customer_id) VALUES (:customer_id)';

        $stmt = $this->getPDO()->prepare($sql);

        $stmt->bindParam(':customer_id', $this->customer_id);

        $stmt->execute();
        if ($this->cart_id === -1) {
            $this->cart_id = $this->getPDO()->lastInsertId();
        }
    }

    public function getCustomerID(): string
    {
        return $this->customer_id;
    }

    public function getCartID(): string
    {
        $sql = 'SELECT cart_id FROM carts WHERE customer_id = :customer_id';

        $stmt = $this->getPDO()->prepare($sql);

        $stmt->execute([
            ':customer_id' => $this->customer_id
        ]);

        return $stmt->fetchColumn();
    }
}
