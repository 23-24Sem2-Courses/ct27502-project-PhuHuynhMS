<?php

namespace App\Controllers;

use App\Models\Customer;

class CustomerLoginController
{
    public function index()
    {
        render_view('/');
    }

    public function create() {
        render_view('/login');
    }

    public function store() {

    }
}
