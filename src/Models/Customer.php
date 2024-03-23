<?php

namespace App\Models;

use App\Models\Model;

class Customer extends Model
{
    private $id, $passwd, $confirmpasswd, $name, $phone_number, $address, $email;
    private array $errors = [];

    public function __construct()
    {
        parent::__construct();
    }

    #fill data for customer object from external data
    public function fill(array $record): Customer
    {
        $this->id = $record['id'] ?? -1;
        $this->passwd = htmlspecialchars($record['passwd']) ?? '';
        $this->name = htmlspecialchars($record['name']) ?? '';
        $this->phone_number = htmlspecialchars($record['phone_number']) ?? '';
        $this->confirmpasswd = htmlspecialchars($record['confirmpasswd']);
        $this->address = htmlspecialchars($record['address']) ?? '';
        $this->email = htmlspecialchars($record['email']) ?? '';

        return $this;
    }

    #Add customer info into database
    public function add()
    {
        $customer = [
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

    public static function getPhonenumber(string $phonenumber)
    {
        return parent::findByProp('customers', 'phone_number', $phonenumber);
    }
    public function getEmail(string $email)
    {
        return parent::findByProp('customers', 'email', $email);
    }

    public function getValidationErrors(): array
    {
        return $this->errors;
    }

    public function getCustomerFormValue(): array
    {
        $values = [];
        $values['name'] = $this->name;
        $values['phone'] = $this->phone_number;
        $values['email'] = $this->email;
        $values['address'] = $this->address;

        return $values;
    }

    public function validate(): bool
    {
        $name = trim($this->name);
        if (!$name) {
            $this->errors['name'] = 'Tên không hợp lệ';
        }

        $address = trim($this->address);
        if (!$address) {
            $this->errors['address'] = 'Địa chỉ không hợp lệ';
        }

        $validPhone = preg_match(
            '/^(03|05|07|08|09|01[2|6|8|9])+([0-9]{8})\b$/',
            $this->phone_number
        );
        if (!$validPhone) {
            $this->errors['phone'] = 'Số điện thoại không hợp lệ';
        }

        if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $this->email)) {
            $this->errors['email'] = 'Email không hợp lệ';
        } elseif ($this->getEmail($this->email)) {
            $this->errors['email'] = 'Email đã tồn tại';
        }

        if (empty($this->name) || empty($this->email) || empty($this->address) || empty($this->confirmpasswd) || empty($this->passwd) || empty($this->phone_number)) {
            $this->errors['empty_input'] = 'Vui lòng điền đầy đủ thông tin';
        }

        if (strlen($this->passwd) <= 8) {
            $this->errors['passwd'] = "Mật khẩu phải có ít nhất 8 ký tự";
        } elseif (!preg_match("#[0-9]+#", $this->passwd)) {
            $this->errors['passwd'] = "Mật khẩu phải có ít nhất 1 ký tự số";
        } elseif (!preg_match("#[A-Z]+#", $this->passwd)) {
            $this->errors['passwd'] = "Mật khẩu phải có ít nhất 1 ký tự in hoa";
        } elseif (!preg_match("#[a-z]+#", $this->passwd)) {
            $this->errors['passwd'] = "Mật khẩu phải có ít nhất 1 ký tự in thường";
        } elseif ($this->passwd !== $this->confirmpasswd) {
            $this->errors['passwd_confirm'] = "Mật khẩu không trùng khớp";
        }

        return empty($this->errors);
    }
}
