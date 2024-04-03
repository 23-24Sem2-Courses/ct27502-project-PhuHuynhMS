<?php

namespace App\Controllers;

use App\Models\Book;

class AdminProductController
{
    public function index()
    {
        if (!isset($_GET['searchKey'])) {
            render_view('admin', [
                'books' => Book::allBook()
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
