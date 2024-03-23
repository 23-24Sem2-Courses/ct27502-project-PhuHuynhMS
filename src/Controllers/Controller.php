<?php

namespace App\Controllers;

use App\Models\Customer;

class Controller
{

    public function is_input_empty( array $data): bool {
        foreach ($data as $val) {
            if (empty($val)) {
                return true;
            }
        }
        return false;
    }

    public function is_invalid_email(string $email): bool
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else
            return false;
    }

    public function is_invalid_phonenumber(string $phonenumber): bool
    {
        if (!preg_match('/^[0-9]{10}+$/', $phonenumber)) {
            return true;
        } else {
            return false;
        }
    }

    public function is_exist_phonenumber(string $phonenumber): bool
    {
        if (Customer::getPhonenumber($phonenumber)) {
            return true;
        } else {
            return false;
        }
    }

    public function is_email_registed(string $email): bool
    {
        if (Customer::getEmail($email)) {
            return true;
        } else {
            return false;
        }
    }

    public function is_invalid_password(string $pwd): bool
    {
        if (strlen($pwd) < 6) {
            return true;
        } else {
            return false;
        }
    }

    public function passArray(array $Array, array $keys): array
    {
        $data = [];
        foreach ($keys as $key) {
            $data["$key"] = $Array["$key"];
        }
        return $data;
    }
}
