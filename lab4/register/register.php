<?php
session_start();
$servername = "localhost";
$username = "root";  // Замінити на ваше ім'я користувача MySQL
$password = "";      // Замінити на ваш пароль MySQL
$dbname = "users_db";

// Створення підключення до бази даних
$conn = new mysqli($servername, $username, $password, $dbname);

// Перевірка підключення
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $email = $_POST['email'];
    $pass = md5($_POST['password']);  // Хешуємо пароль за допомогою md5

    // Використання підготовленого запиту для запобігання SQL-ін'єкціям
    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $user, $email, $pass);

    if ($stmt->execute()) {
        echo "Registration successful!";
        header("Location: login.php");  // Перенаправляємо на сторінку входу
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();

