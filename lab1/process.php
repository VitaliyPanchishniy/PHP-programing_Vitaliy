<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Очищення введених даних від зайвих пробілів
    $firstName = isset($_POST['firstName']) ? trim($_POST['firstName']) : '';
    $lastName = isset($_POST['lastName']) ? trim($_POST['lastName']) : '';

    // Перевірка, чи не порожні поля
    if (empty($firstName)) {
        echo "Помилка: Поле 'Ім'я' не може бути порожнім.<br>";
    }
    
    if (empty($lastName)) {
        echo "Помилка: Поле 'Прізвище' не може бути порожнім.<br>";
    }
    
    // Якщо обидва поля заповнені коректно
    if (!empty($firstName) && !empty($lastName)) {
        if (is_string($firstName) && is_string($lastName)) {
            // Виведення привітання
            echo "Привіт, $firstName $lastName!";
        } else {
            // Якщо типи даних некоректні
            echo "Помилка: Ім'я та прізвище повинні бути текстовими значеннями.";
        }
    }
    
} else {
    // Якщо скрипт відкрито без надсилання форми
    echo "Немає даних для обробки. Будь ласка, заповніть форму на <a href='index.html'>сторінці форми</a>.";
}

