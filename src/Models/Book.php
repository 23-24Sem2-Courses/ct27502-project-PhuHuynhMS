<?php

namespace App\Models;

use App\Models\Model;

class Book extends Model
{
    private $book_id = -1, $book_name, $author, $price, $quantity, $description, $image;

    public function __construct()
    {
        parent::__construct();
    }

    public function fill(array $book): Book
    {
        $this->book_name = htmlspecialchars($book["book_name"]) ?? "";
        $this->author = htmlspecialchars($book["author"]) ?? "";
        $this->price = htmlspecialchars($book["price"]) ?? "";
        $this->quantity = htmlspecialchars($book["quantity"]) ?? "";
        $this->description = htmlspecialchars($book["description"]) ?? "";
        $this->image = htmlspecialchars($book["image"]) ?? "";

        return $this;
    }

    #Add book info into database
    public function add(): bool
    {
        $book = [
            'book_name' => $this->book_name,
            'author' => $this->author,
            'price' => $this->price,
            'quantity' => $this->quantity,
            'description' => $this->description,
            'image' => $this->image
        ];

        if ($this->book_id === -1) {
            $book['id'] = $this->getPDO()->lastInsertId();
        }
        return $this->save('products', $book);
    }

    public function editBook(int $id, array $newValue): bool
    {
        return parent::update('products', $newValue, $id);
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
}
