<?php

namespace App\Controllers;

use App\Models\Book;

class AdminProductController
{
    public function index()
    {

        render_view('admin', [
            'books' => Book::allBook()
        ]);
    }

    public function create() {
        render_view('admin_add_product');
    }

    public function add() {
        $book = new Book();
        foreach($_POST as $key => $value) {
            $data[$key] = $value;
        }

        $data['image'] = handle_file_upload('newImage');

        if ($book->fill($data)->validate()) {
            $book->add();
            $_SESSION['added'] = 'success';
            redirect('/admin');
        }
        else {
            render_view('admin_add_product', $book->getvalidationErrors());
        }
    }

    public function edit()
    {

        $url = parse_url($_SERVER['REQUEST_URI']);
        $path = $url['path'];

        $pathArray = explode('/', $path);
        $IdArray = explode('=', $pathArray[2]);

        $id = (int)$IdArray[1];

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
}
