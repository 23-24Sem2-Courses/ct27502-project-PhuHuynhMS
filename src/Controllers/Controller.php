<?php

namespace App\Controllers;

class Controller
{
    public function passArray(array $Array, array $keys): array
    {
        $data = [];
        foreach ($keys as $key) {
            $data[$key] = $Array[$key];
        }
        return $data;
    }
}
