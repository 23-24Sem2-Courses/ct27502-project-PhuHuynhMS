<?php

namespace App\Controllers;

use App\Models\Book;

class ProductController
{
    public function index()
    {
        render_view('/home', [
            'books' => Book::allBook()
        ]);
    }
    
}
