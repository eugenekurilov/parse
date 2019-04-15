<?php

$message = "Пароль: 3336
Спишется 2010,06р.
Перевод на счет 41001677064554";

function parse($message) {

    $result = [];

    $wordsPassword = [
        'Пароль'
    ];

    $wordsSum = [
        'Спишется'
    ];

    $wordsAccount = [
        'Перевод на счет'
    ];

    $data = explode(PHP_EOL, $message);

    if (is_array($data) && count($data) == 3) {
        foreach ($data as $value) {
            if (mb_eregi('(' . implode('|', $wordsPassword) . ')', $value)) {
                $result['code'] = preg_replace("/[^0-9]/", '', $value);
            }
            if (mb_eregi('(' . implode('|', $wordsAccount) . ')', $value)) {
                $result['account'] = preg_replace("/[^0-9]/", '', $value);
            }
            if (mb_eregi('(' . implode('|', $wordsSum) . ')', $value)) {
                $result['sum'] = preg_replace("/[^0-9,]/", '', $value);
            }
        }
    }

    return $result;
}

print_r(parse($message));

?>
