<?php

namespace App\Controllers;

use App\Models\Customer;

class Controller
{
    public function passArray(array $Array, array $keys): array
    {
        $data = [];
        foreach ($keys as $key) {
            $data["$key"] = $Array["$key"];
        }
        return $data;
    }
}
