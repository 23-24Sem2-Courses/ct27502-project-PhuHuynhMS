<?php

require_once __DIR__ . '/../bootstrap.php';

const ROOT_DIR = __DIR__ . '/..';
define('VIEWS_DIR', ROOT_DIR . '/src/views');

$router = new \Bramus\Router\Router();

require_once __DIR__ . '/../src/routes/home.php';

require_once __DIR__ . '/../src/routes/customer.php';

require_once __DIR__ . '/../src/routes/login.php';

require_once __DIR__ . '/../src/routes/signup.php';

require_once __DIR__ . '/../src/routes/admin.php';



$router->run();