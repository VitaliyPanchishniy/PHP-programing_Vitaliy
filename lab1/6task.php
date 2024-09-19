<?php
$student = [
    "ім'я" => "Іван",
    "прізвище" => "Петренко",
    "вік" => 20,
    "спеціальність" => "Повар"
];

echo "Ім'я: " . $student["ім'я"] . "<br>";
echo "Прізвище: " . $student["прізвище"] . "<br>";
echo "Вік: " . $student["вік"] . "<br>";
echo "Спеціальність: " . $student["спеціальність"] . "<br>";

$student["середній бал"] = 2.1;

echo "<br>Оновлений масив:<br>";
foreach ($student as $key => $value) {
    echo "$key: $value<br>";
}

