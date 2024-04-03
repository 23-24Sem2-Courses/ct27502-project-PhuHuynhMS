<?php

namespace App\Controllers;

use App\Models\Book;

class ItemDetailController
{
    public function index()
    {
        $array = get_URL_Param(3);
        $id = $array[1];
        $book = Book::getBookByID((int)$id);

        if ($book === false)
            echo $id;
        else
            render_view('item_detail', $book);
    }
}
