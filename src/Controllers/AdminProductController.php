<?php

namespace App\Controllers;

use App\Models\Book;
use App\Models\Paginator;

class AdminProductController
{
    public function index()
    {
        $limit = (isset($_GET['limit']) && is_numeric($_GET['limit'])) ?
            (int)$_GET['limit'] : 5;
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

        if (!isset($_GET['searchKey'])) {
            render_view('admin', [
                'books' => $books,
                'paginator' => $paginator,
                'pages' => $pages
            ]);
        } else {

            $key = $_GET['searchKey'];

            $books = Book::getBooksByKey($key);

            if ($books) {
                render_view('/admin', [
                    'books' => $books
                ]);
            } else {
                $error_msg['not_found'] = 'Không tìm thấy sách';
                render_view('/admin', $error_msg);
            }
        }
    }

    public function create()
    {
        render_view('admin_add_product');
    }

    public function add()
    {
        $book = new Book();
        foreach ($_POST as $key => $value) {
            $data[$key] = $value;
        }

        $data['image'] = handle_file_upload('newImage');

        if ($book->fill($data)->validate()) {
            $book->add();
            $_SESSION['added'] = 'success';
            redirect('/admin');
        } else {
            render_view('admin_add_product', $book->getvalidationErrors());
        }
    }

    public function edit()
    {

        $SecondParamArray = get_URL_Param(2);
        $id = (int)$SecondParamArray[1];

        $book = Book::getBookByID($id);

        $_SESSION['id_book'] = $id;

        if ($book) {
            render_view('product_update', $book);
        } else {
            redirect('/admin');
        }
    }

    public function update()
    {
        $data = [];

        if (isset($_POST)) {
            foreach ($_POST as $key => $value) {
                if ($key !== 'oldImage' && $key !== 'newImage')
                    $data[$key] = $value;
            }
        }

        $book_id = $_SESSION['id_book'];

        $book = new Book();

        $data['image'] = handle_file_upload('newImage');

        if (!$data['image']) {
            $data['image'] = $_POST['oldImage'];
        }

        if ($book->fill($data)->validate()) {
            $book->editBook($book_id, $data);

            $_SESSION['updated'] = 'success';
            redirect('/product_alter/id=' . $book_id);
        } else {
            $currentbook = Book::getBookByID($book_id);
            render_view('product_update', $book->getvalidationErrors(), $currentbook);
        }
    }

    public function destroy()
    {
        $sencondParamArray = get_URL_Param(2);
        $book_id = (int)$sencondParamArray[1];

        if (Book::deleteBook($book_id)) {
            redirect('/admin');
        }
    }
}
