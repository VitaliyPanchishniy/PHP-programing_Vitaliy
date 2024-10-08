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
    $pass = md5($_POST['password']);  // Отримуємо хеш пароля за допомогою md5

    // Використання підготовленого запиту
    $stmt = $conn->prepare("SELECT id, username FROM users WHERE username=? AND password=?");
    $stmt->bind_param("ss", $user, $pass);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $_SESSION['username'] = $user;
        header("Location: welcome.php");  // Перенаправляємо на захищену сторінку
        exit();
    } else {
        echo "Invalid username or password!";
    }

    $stmt->close();
}

$conn->close();

