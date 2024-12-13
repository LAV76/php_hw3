<?php

$address = '/code/birthdays.txt';

// Получаем данные от пользователя
$name = readline("Введите имя: ");
$date = readline("Введите дату рождения в формате ДД-ММ-ГГГГ: ");

// Проверяем данные
if (validateName($name) && validateDate($date)) {
    $data = $name . ", " . $date . "\r\n";

    // Открываем файл и записываем данные
    $fileHandler = fopen($address, 'a');
    
    if (fwrite($fileHandler, $data)) {
        echo "Запись '$data' добавлена в файл $address\n";
    } else {
        echo "Произошла ошибка записи. Данные не сохранены.\n";
    }
    
    fclose($fileHandler);
} else {
    echo "Введена некорректная информация.\n";
}

// Функция проверки имени
function validateName(string $name): bool {
    // Имя не должно быть пустым, содержать цифры или специальные символы
    return preg_match('/^[a-zA-Zа-яА-ЯёЁ]+(?: [a-zA-Zа-яА-ЯёЁ]+)*$/u', $name);
}

// Функция проверки даты
function validateDate(string $date): bool {
    // Проверяем формат даты ДД-ММ-ГГГГ
    $format = 'd-m-Y';
    $parsedDate = DateTime::createFromFormat($format, $date);

    if ($parsedDate && $parsedDate->format($format) === $date) {
        // Проверяем, что дата не больше текущей
        $currentDate = new DateTime();
        return $parsedDate <= $currentDate;
    }

    return false;
}
