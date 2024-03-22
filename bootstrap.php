<?php

require_once __DIR__ . '/vendor/autoload.php';

session_start();

// autoload file .env
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();