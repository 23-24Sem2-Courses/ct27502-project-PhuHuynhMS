<?php 

namespace App\Controllers;

use App\Models\Customer;

class CustomerController {

    public function index() {
        render_view('/sign-up');
    }

    public function create() {
        $data = [
            'title' => 'Đăng ký',
            'post_url' => '/customer',
            'customer' => new Customer()

        ];
        render_view('/login',$data);
    }

    public function store()
    {
        $customer = new Customer();
        if ($customer->fill($_POST)->add()) {
            redirect('/');
        }

        $_SESSION['error'] = 'Đã có lỗi xảy ra.';
        redirect('/customer');
    }
}


?>