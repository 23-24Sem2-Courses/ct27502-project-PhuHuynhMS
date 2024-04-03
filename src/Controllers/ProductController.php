<?php

namespace App\Controllers;

use App\Models\Book;

class ProductController
{
    public function index()
    {
        if (!isset($_GET['searchKey'])) {
            render_view('/home', [
                'books' => Book::allBook()
            ]);
        } else {

            $key = $_GET['searchKey'];

            $books = Book::getBooksByKey($key);

            if ($books) {
                render_view('/home', [
                    'books' => $books
                ]);
            } else {
                $error_msg['not_found'] = 'Không tìm thấy sách';
                render_view('/home', $error_msg);
            }
        }
    }
}
