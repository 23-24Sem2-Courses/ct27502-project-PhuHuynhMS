<?php

namespace App\Models;

use App\Models\Model;

class Customer extends Model
{
    private $id, $username, $passwd, $name, $phone_number, $address, $email;

    public function __construct()
    {
        parent::__construct();
    }

    #fill data for customer object from external data
    public function fill(array $record): Customer
    {
        $this->id = $record['id'] ?? -1;
        $this->username = htmlspecialchars($record['username']) ?? '';
        $this->passwd = htmlspecialchars($record['passwd']) ?? '';
        $this->name = htmlspecialchars($record['name']) ?? '';
        $this->phone_number = htmlspecialchars($record['phone_number']) ?? '';
        $this->address = htmlspecialchars($record['address']) ?? '';
        $this->email = htmlspecialchars($record['email']) ?? '';

        return $this;
    }

    #Add customer info into database
    public function add()
    {
        $customer = [
            'username' => $this->username,
            'passwd' => password_hash($this->passwd, PASSWORD_BCRYPT),
            'name' => $this->name,
            'phone_number' => $this->phone_number,
            'address' => $this->address,
            'email' => $this->email
        ];

        if ($this->id === -1) {
            $this->save('customers', $customer);
            $customer['id'] = $this->getPDO()->lastInsertId();
        }
    }

    #update customer info
    public function edit(int $id, array $newRecord)
    {
        return parent::update('customers', $newRecord, $id);
    }

    #Get customer info
    public function getCustomer(int $id): Customer|bool
    {
        return parent::find($id, 'customers');
    }

    #Get all customers
    public function getAllCustomer()
    {
        return parent::all('customers');
    }
}
