<?php

namespace App\Controllers;

use App\Models\Customer;

use App\Controllers\Controller;

class CustomerRegisterController extends Controller
{

    public function index()
    {
        render_view('/sign-up');
    }

    public function create()
    {
        $data = [
            'title' => 'Đăng ký',
            'post_url' => '/customer',
            'customer' => new Customer()

        ];
        render_view('/login', $data);
    }

    public function store()
    {
        $customer = new Customer();
        if ($customer->fill($_POST)->validate()) {
            $customer->add() && render_view('/home');
        }
        else {
            $errors = $customer->getValidationErrors();
            $values = $customer->getCustomerFormValue();
            render_view('/sign-up', [
                'errors' => $errors,
                'oldValues' => $values
            ]);
        }
    }
}
