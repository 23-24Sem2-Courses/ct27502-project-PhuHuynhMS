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

function getSessionValues(array $session, array $neededArray): array {
    foreach($session as $key => $value) {
        $neededArray[$key] = $value;
    }
    return $neededArray;
}