<?php

// Function to read all data from the file
function readAllFunction(array $config) : string {
    $address = $config['storage']['address'];
    
    if (file_exists($address) && is_readable($address)) {
        $file = fopen($address, "rb");
        
        $contents = ''; 
    
        while (!feof($file)) {
            $contents .= fread($file, 100);
        }
        
        fclose($file);
        return $contents;
    }
    else {
        return handleError("Файл не существует");
    }
}

// Function to add a new record to the file
function addFunction(array $config) : string {
    $address = $config['storage']['address'];

    $name = readline("Введите имя: ");
    $date = readline("Введите дату рождения в формате ДД-ММ-ГГГГ: ");
    $data = $name . ", " . $date . "\r\n";

    $fileHandler = fopen($address, 'a');

    if(fwrite($fileHandler, $data)){
        return "Запись $data добавлена в файл $address"; 
    }
    else {
        return handleError("Произошла ошибка записи. Данные не сохранены");
    }

    fclose($fileHandler);
}

// Function to clear the contents of the file
function clearFunction(array $config) : string {
    $address = $config['storage']['address'];

    if (file_exists($address) && is_readable($address)) {
        $file = fopen($address, "w");
        
        fwrite($file, '');
        
        fclose($file);
        return "Файл очищен";
    }
    else {
        return handleError("Файл не существует");
    }
}

// Function to search for birthdays in the file
function searchBirthdays(array $config): string {
    $address = $config['storage']['address'];
    $today = date('d-m'); // Get today's day and month

    if (file_exists($address) && is_readable($address)) {
        $file = fopen($address, "r");
        $results = "Поздравления для:\n";

        while (($line = fgets($file)) !== false) {
            $parts = explode(", ", $line);

            if (count($parts) > 1) {
                $name = trim($parts[0]);
                $date = trim($parts[1]);
                $dateParts = explode('-', $date);

                if (count($dateParts) >= 2 && $dateParts[0] . '-' . $dateParts[1] === $today) {
                    $results .= "$name\n";
                }
            }
        }

        fclose($file);

        return strlen($results) > 16 ? $results : "Сегодня нет именинников.";
    }
    else {
        return handleError("Файл не существует или недоступен для чтения.");
    }
}

// Function to delete a specific record
function deleteRecord(array $config): string {
    $address = $config['storage']['address'];
    $criteria = readline("Введите имя или дату для удаления строки: ");

    if (file_exists($address) && is_readable($address)) {
        $file = file($address); // Read file into an array
        $updatedFile = "";
        $found = false;

        foreach ($file as $line) {
            if (stripos($line, $criteria) === false) {
                $updatedFile .= $line;
            } else {
                $found = true;
            }
        }

        file_put_contents($address, $updatedFile);

        return $found ? "Строка удалена." : "Строка не найдена.";
    } else {
        return handleError("Файл не существует или недоступен для чтения.");
    }
}

// Error handler
function handleError(string $message): string {
    return "Ошибка: $message";
}
