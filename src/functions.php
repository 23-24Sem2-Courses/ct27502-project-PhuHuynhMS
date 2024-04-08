<?php

function redirect(string $location): void
{
    header("Location: $location", true, 302);
    exit();
}

function html_escape(string|null $text): string
{
    return htmlspecialchars($text ?? '', ENT_QUOTES, 'UTF-8', false);
}

function render_view(string $document, array $data = [], array $anotherData = [])
{
    $path = VIEWS_DIR . "/{$document}.php";
    extract($data, EXTR_PREFIX_SAME, '__var_');
    extract($anotherData, EXTR_PREFIX_SAME, '__var_');
    require($path);
}

function thousandsCurrencyFormat($num)
{

    if ($num > 1000) {

        $x = round($num);
        $x_number_format = number_format($x);
        $x_array = explode(',', $x_number_format);
        $x_parts = array('k', 'm', 'b', 't');
        $x_count_parts = count($x_array) - 1;
        $x_display = $x;
        $x_display = $x_array[0] . ((int) $x_array[1][0] !== 0 ? '.' . $x_array[1][0] : '');
        $x_display .= $x_parts[$x_count_parts - 1];

        return $x_display;
    }

    return $num;
}

function getSessionValues(array $session, array $except = []): array
{
    $neededArray = [];
    
    foreach ($session as $key => $value) {
        if (!in_array($key, $except)) {
            $neededArray[$key] = $value;
        }
    }
    return $neededArray;
}

function handle_file_upload(string $fileTypeName): string | bool
{
    if (!isset($_FILES[$fileTypeName]))
        return false;

    $avatar = $_FILES[$fileTypeName];
    $avatar_name = $avatar['name'];
    $avatar_tmp_name = $avatar['tmp_name'];
    $avatar_size = $avatar['size'];
    $avatar_error = $avatar['error'];

    if ($avatar_error !== 0 || $avatar_size > 10000000)
        return false;

    $avatar_new_name = uniqid() . '_' . $avatar_name;
    $avatar_destination = __DIR__ . '/../public/uploads/' . $avatar_new_name;

    if (!move_uploaded_file($avatar_tmp_name, $avatar_destination))
        return false;

    return $avatar_new_name;
}

function limit_word(string $string, bool $isAdmin, int $limit): string
{
    $string = strip_tags($string);

    $substring = '';

    if (strlen($string) > $limit) {

        $index = $limit - 1;

        while ($string[$index] !== ' ') {
            $index = $index + 1;
        }
        $substring = substr($string, 0, $index);

        $substring .= '...';
    } else {
        $substring = $string;
    }

    if (!$isAdmin) {
        $substring .= '
        <a href="#">Xem thêm</a>
        ';
    }

    return $substring;
}

function get_URL_Param(int $orderNumber)
{
    $url = parse_url($_SERVER['REQUEST_URI']);
    $path = $url['path'];

    $pathArray = explode('/', $path);
    $concludedArray = explode('=', $pathArray[$orderNumber]);

    return $concludedArray;
}

function split_paragraph(string $long_text): array
{
    $paragraph_array = explode("\n", $long_text);
    return $paragraph_array;
}
