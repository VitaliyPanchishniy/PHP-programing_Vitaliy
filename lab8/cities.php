<?php
// Підключення до бази даних
$servername = "localhost";
$username = "root";
$password = ""; // Вкажіть свій пароль, якщо потрібно
$dbname = "poshta";

$conn = new mysqli($servername, $username, $password, $dbname);

// Перевірка з'єднання
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL-запит для отримання списку міст
$sql = "SELECT id, name FROM cities";
$result = $conn->query($sql);

$cities = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $cities[] = $row; // Додаємо місто до масиву
    }
} else {
    echo "0 results";
}

$conn->close();

// Повертаємо дані як JSON
header('Content-Type: application/json');
echo json_encode($cities);

