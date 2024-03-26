<?php

namespace App\Controllers;

use App\Models\Customer;

class PasswordController
{
    public function edit()
    {
        render_view('password_change');
    }
    public function update()
    {
        $customer_id = (int)$_SESSION['id'];

        $customer = new Customer();

        $customerArray = $customer->getCustomerById($customer_id);
        $customer->fill($customerArray, except: ['confirmpassword']);

        $keys = array_keys($customerArray);

        foreach ($_POST as $key => $value) {
            $Values[$key] = $value;
        }

        if (!password_verify($Values['oldPassword'], $customerArray['passwd'])) {
            $error_msg['invalidPassword'] = "Mật khẩu không chính xác";
        } 
        
        $passwdError_msg = $customer->password_validation($Values['newPassword'], $Values['newConfirmPassword']);
        if (!empty($passwdError_msg)) {
            $error_msg[] = $passwdError_msg;
        }

        if (!empty($error_msg)) {
            render_view('password_change', [
                'errors' => $error_msg
            ]);
        } else {
            $customer->edit($customer_id, ['passwd' => $Values['newPassword']]);

            $_SESSION['update'] = 'success';

            redirect('/customer/profile');
        }
    }
}
