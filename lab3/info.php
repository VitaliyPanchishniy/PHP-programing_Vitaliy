<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: info.php'); // Перенаправлення, якщо не POST
    exit;
}

echo "IP-адреса клієнта: " . $_SERVER['REMOTE_ADDR'] . "<br>";
echo "Назва браузера: " . $_SERVER['HTTP_USER_AGENT'] . "<br>";
echo "Скрипт, що виконується: " . $_SERVER['PHP_SELF'] . "<br>";
echo "Метод запиту: " . $_SERVER['REQUEST_METHOD'] . "<br>";
echo "Шлях до файлу на сервері: " . $_SERVER['SCRIPT_FILENAME'] . "<br>";
?>
