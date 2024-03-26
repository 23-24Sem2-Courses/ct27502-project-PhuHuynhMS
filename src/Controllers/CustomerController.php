<?php

namespace App\Controllers;
use App\Models\Customer;

class CustomerController
{
    public function edit()
    {
        $loggedinInfo = [];
        $loggedinInfo = getSessionValues($_SESSION, $loggedinInfo);
        render_view('/user_info', $loggedinInfo);
    }

    public function update() {
        $customer = new Customer();

        $validate = $customer->fill($_POST, ['confirmpassword'])->validate(['passwd', 'confirmpasswd'], isUpdate: True);
        $customerValues = $customer->getCustomerValue();

        $errors = $customer->getValidationErrors();

        if (!$validate) {
            render_view('/user_info', [
                'errors' => $errors
            ], $customerValues);
        }
        else {

            $customer->edit($_POST['id'], $_POST);

            $customerValues = $customer->getCustomerValue();
            foreach($customerValues as $key => $value) {
                $_SESSION[$key] = $value;
            }

            $_SESSION['update'] = 'success';

            render_view('/user_info', $_POST);


        }
    }

    public function destroy() {
        session_destroy();
        redirect('/');
    }
}
