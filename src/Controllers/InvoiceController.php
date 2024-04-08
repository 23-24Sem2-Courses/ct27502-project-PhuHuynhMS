<?php

namespace App\Controllers;

class InvoiceController
{
    public function index()
    {
        $user = getSessionValues($_SESSION, ['logged_in']);
        render_view('invoice', $user);
    }
}
