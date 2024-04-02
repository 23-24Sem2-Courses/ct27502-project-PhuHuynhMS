<?php

namespace App\Models;

use App\Models\Model;

class Book extends Model
{
    private $book_id = -1, $book_name, $author, $price, $quantity, $quantity_sold, $description, $image,
        $genre, $page_quantity, $cover, $manufactorer, $year;
    private $errors = [];

    public function __construct()
    {
        parent::__construct();
    }

    public function fill(array $book): Book
    {
        $this->book_name = htmlspecialchars($book["book_name"]) ?? "";
        $this->author = htmlspecialchars($book["author"]) ?? "";
        $this->genre = htmlspecialchars($book["genre"]) ?? "";
        $this->price = htmlspecialchars($book['price']) ?? "";
        $this->quantity = htmlspecialchars($book["quantity"]) ?? "";
        $this->quantity_sold = htmlspecialchars($book["quantity_sold"]) ?? "";
        $this->description = htmlspecialchars($book["description"]) ?? "";
        $this->image = htmlspecialchars($book["image"]) ?? "";
        $this->page_quantity = htmlspecialchars($book["page_quantity"]) ?? "";
        $this->cover = htmlspecialchars($book["cover"]) ?? "";
        $this->manufactorer = htmlspecialchars($book["manufactorer"]) ?? "";
        $this->year = htmlspecialchars($book["year"]) ?? "";


        return $this;
    }

    #Add book info into database
    public function add(): bool
    {
        $book = [
            'book_name' => $this->book_name,
            'author' => $this->author,
            'price' => $this->price,
            'genre' => $this->genre,
            'quantity' => $this->quantity,
            'quantity_sold' => $this->quantity_sold,
            'description' => $this->description,
            'image' => $this->image,
            'page_quantity' => $this->page_quantity,
            'cover' => $this->cover,
            'manufactorer' => $this->manufactorer,
            'year' => $this->year
        ];

        if ($this->book_id === -1) {
            $book['id_book'] = $this->getPDO()->lastInsertId();
        }
        return $this->save('products', $book);
    }

    public function editBook(int $id, array $newValue): bool
    {
        return parent::update('products', $newValue, $id, 'id_book');
    }

    public function deleteBook(int $id): bool
    {
        return parent::delete($id, 'products');
    }

    public static function allBook(): array
    {
        $books = [];
        $book = new Book();
        $books = $book->all('products');

        return $books;
    }

    public static function getBookByID(int $book_id): array|bool
    {

        $book = parent::find('id_book', $book_id, 'products');

        return $book;
    }

    public function validate() : bool
    {
        $book = [
            'book_name' => $this->book_name,
            'author' => $this->author,
            'price' => $this->price,
            'genre' => $this->genre,
            'quantity' => $this->quantity,
            'quantity_sold' => $this->quantity_sold,
            'description' => $this->description,
            'image' => $this->image,
            'page_quantity' => $this->page_quantity,
            'cover' => $this->cover,
            'manufactorer' => $this->manufactorer,
            'year' => $this->year
        ];

        foreach ($book as $key => $value) {
            $book[$key] = trim($book[$key]);

            if (empty($book[$key])) {
                $this->errors['empty_input'] = 'Vui lòng điền đầy đủ thông tin';
                break;
            }
        }

        return empty($this->errors);
    }

    public function getvalidationErrors() {
        return $this->errors;
    }
}
