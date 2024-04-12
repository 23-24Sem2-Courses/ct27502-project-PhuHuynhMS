<?php

namespace App\Controllers;

class CartController
{
    public function index()
    {
        if (isset($_SESSION['logged_in'])) {
            $user = getSessionValues($_SESSION, ['logged_in']);
            render_view('cart', $user);
        } else {
            redirect('/login');
        }
    }
}
