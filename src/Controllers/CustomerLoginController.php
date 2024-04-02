<?php

namespace App\Controllers;

use App\Models\Customer;

class CustomerLoginController
{
    public function index()
    {
        render_view('/home');
    }

    public function create()
    {
        render_view('/login');
    }

    public function store()
    {
        $customer = new Customer();

        $customer = $customer->fill($_POST, ['confirmpassword', 'email', 'address', 'name']);

        if (!$customer->check_empty_login()) {
            $errors = $customer->getValidationErrors();
            render_view('/login', $errors);
        } elseif ($customer->check_admin_login()) {
            $_SESSION['isAdmin'] = True;
            redirect('/admin');
        } else {
            $phoneDB = Customer::findPhonenumber($customer->getPhoneNumber());

            if ($phoneDB) {
                $pass = $customer->getColByProp('phone_number', $phoneDB, 1);
                $data = Customer::getCustomer('phone_number', $phoneDB);

                if (password_verify($customer->getPasswd(), $pass)) {
                    $_SESSION['logged_in'] = 'success';
                    foreach ($data as $key => $value) {
                        $_SESSION[$key] = $value;
                    }
                    redirect('/');
                } else {
                    render_view('/login', [
                        'passwd_error' => 'Mật khẩu không đúng'
                    ]);
                }
            } else {
                render_view('login', [
                    'phone_error' => 'Số điện thoại chưa được đăng ký'
                ]);
            }
        }
    }
}
