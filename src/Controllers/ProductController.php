<?php

namespace App\Controllers;

use App\Models\Book;
use App\Models\Paginator;

class ProductController
{
    public function index()
    {
        $limit = (isset($_GET['limit']) && is_numeric($_GET['limit'])) ?
            (int)$_GET['limit'] : 12;
        $page = (isset($_GET['page']) && is_numeric($_GET['page'])) ?
            (int)$_GET['page'] : 1;
        $count = Book::count();


        $paginator = new Paginator(
            totalRecords: (int)$count,
            recordsPerpage: $limit,
            currentPage: $page
        );

        $book = new Book();

        $books = $book->paginate($paginator->recordOffset, $paginator->recordsPerpage);
        $pages = $paginator->getPages(length: 3);


        $genres = Book::getAllGenre();

        if (!isset($_GET['searchKey'])) {
            render_view('/home', [
                'books' => $books,
                'genres' => $genres,
                'paginator' => $paginator,
                'pages' => $pages
            ]);
        } else {

            $key = $_GET['searchKey'];

            $books = Book::getBooksByKey($key);
            //$books = $book->paginate($paginator->recordOffset, $paginator->recordsPerpage);


            if ($books) {
                render_view('/home', [
                    'books' => $books,
                    'genres' => $genres,
                    'paginator' => $paginator,
                    'pages' => $pages
                ]);
            } else {
                $error_msg['not_found'] = 'Không tìm thấy sách';
                render_view('/home', $error_msg);
            }
        }
    }
}
