<?php

namespace App\Models;

use App\Models\Model;
use App\Models\Cart;

class Customer extends Model
{
    private $id, $passwd, $confirmpasswd, $name, $phone_number, $address, $email;
    private array $errors = [];

    public function __construct()
    {
        parent::__construct();
    }

    #fill data for customer object from external data
    public function fill(array $record, array $except = []): Customer
    {
        $this->id = $record['id'] ?? -1;
        $this->passwd = (!in_array('password', $except)) ? htmlspecialchars($record['passwd']) : '';
        $this->name = (!in_array('name', $except)) ? htmlspecialchars($record['name']) : '';
        $this->phone_number = (!in_array('phone_number', $except)) ? htmlspecialchars($record['phone_number']) : '';
        $this->confirmpasswd = (!in_array('confirmpassword', $except)) ? htmlspecialchars($record['confirmpasswd']) : '';
        $this->address = (!in_array('address', $except)) ? htmlspecialchars($record['address']) : '';
        $this->email = (!in_array('email', $except)) ? htmlspecialchars($record['email']) : '';

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
        $keys = array_keys($newRecord);

        if (in_array('passwd', $keys)) {
            $newRecord['passwd'] = password_hash($newRecord['passwd'], PASSWORD_BCRYPT);
        }
        return parent::update('customers', $newRecord, $id, 'id');
    }

    #Get customer info
    public static function getCustomer(string $prop, string $phone): array|bool
    {
        return parent::find($prop, $phone, 'customers');
    }

    #Get all customers
    public function getAllCustomer()
    {
        return parent::all('customers');
    }

    public function getPasswd()
    {
        return $this->passwd;
    }

    #Get columns value by attribute
    public function getColByProp(string $property, string|int $value, int $column)
    {
        $sql = "SELECT * FROM customers WHERE $property = :$property";
        $stmt = $this->getPDO()->prepare($sql);
        $stmt->execute([
            ":$property" => $value
        ]);
        return $stmt->fetchColumn($column);
    }

    #Get phone number of customer
    public function getPhoneNumber(): string
    {
        return $this->phone_number;
    }

    public static function findPhonenumber(string $phonenumber)
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

    public function getCustomerById(int $id): array
    {
        $sql = "SELECT * FROM customers WHERE id = :id";
        $stmt = $this->getPDO()->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    public function getCustomerValue(): array
    {
        $values = [];
        $values['id'] = $this->id;
        $values['name'] = $this->name;
        $values['passwd'] = $this->passwd;
        $values['email'] = $this->email;
        $values['phone_number'] = $this->phone_number;
        $values['address'] = $this->address;

        return $values;
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


    #Validate form values
    public function validate(array $except = [], bool $isUpdate = false): bool
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
        } elseif ($this->findPhonenumber($this->phone_number)) {
            $this->errors['phone'] = 'Số điện thoại đã tồn tại';
        }

        if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $this->email)) {
            $this->errors['email'] = 'Email không hợp lệ';
        } elseif ($this->getEmail($this->email) && !$isUpdate) {
            $this->errors['email'] = 'Email đã tồn tại';
        }

        if (!in_array('passwd', $except) && !in_array('confirmpasswd', $except)) {
            if (empty($this->name) || empty($this->email) || empty($this->address) || empty($this->confirmpasswd) || empty($this->passwd) || empty($this->phone_number)) {
                $this->errors['empty_input'] = 'Vui lòng điền đầy đủ thông tin';
            }
            if (!empty($this->password_validation($this->passwd, $this->confirmpasswd)))
                $this->errors[] = $this->password_validation($this->passwd, $this->confirmpasswd);
        } else {
            if (empty($this->name) || empty($this->email) || empty($this->address) || empty($this->phone_number)) {
                $this->errors['empty_input'] = 'Vui lòng điền đầy đủ thông tin';
            }
        }

        return empty($this->errors);
    }

    public static function password_validation(string|null $passwd, string|null $confirmpasswd): array|null
    {
        $errors = [];
        if (strlen($passwd) <= 8) {
            $errors['passwd'] = "Mật khẩu phải có ít nhất 8 ký tự";
        } elseif (!preg_match("#[0-9]+#", $passwd)) {
            $errors['passwd'] = "Mật khẩu phải có ít nhất 1 ký tự số";
        } elseif (!preg_match("#[A-Z]+#", $passwd)) {
            $errors['passwd'] = "Mật khẩu phải có ít nhất 1 ký tự in hoa";
        } elseif (!preg_match("#[a-z]+#", $passwd)) {
            $errors['passwd'] = "Mật khẩu phải có ít nhất 1 ký tự in thường";
        } elseif ($passwd !== $confirmpasswd) {
            $errors['passwd_confirm'] = "Mật khẩu không trùng khớp";
        }
        return $errors;
    }

    public function check_empty_login(): bool
    {
        if (empty($this->phone_number) || empty($this->passwd)) {
            $this->errors['empty_input'] = "Vui lòng nhập đầy đủ thông tin";
        }
        return empty($this->errors);
    }

    public function check_admin_login(): bool
    {
        if ($this->phone_number === '0123321' && $this->passwd === 'Admin@123') {
            return true;
        }
        return false;
    }
}
