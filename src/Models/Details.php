<?php

namespace App\Models;

class Details extends Model
{

    private $invoice_id, $id_book, $quantity;

    public function __construct()
    {
        parent::__construct();
    }

    public function fill(array $record)
    {
        $this->invoice_id = $record['invoice_id'] ?? -1;
        $this->id_book = $record['id_book'] ?? '';
        $this->quantity = $record['quantity'] ?? '';

        return $this;
    }

    public function add()
    {
        $record['invoice_id'] = $this->invoice_id;
        $record['id_book'] = $this->id_book;
        $record['quantity'] = $this->quantity;

        $this->save('details', $record);
    }

    
}
