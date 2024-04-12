<?php

namespace App\Controllers;

use App\Models\Details;

class DetailController
{
    public function index()
    {
        $user = getSessionValues($_SESSION, ['logged_in']);

        render_view('detail', $user);
    }

    public function store()
    {
    }
}
