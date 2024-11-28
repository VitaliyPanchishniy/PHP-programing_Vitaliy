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

// Отримання параметрів
$city_id = isset($_GET['city_id']) ? (int)$_GET['city_id'] : 0;
$delivery_type = isset($_GET['delivery_type']) ? $_GET['delivery_type'] : '';

// SQL-запит для отримання відділень або поштоматів
$sql = "SELECT id, name FROM branches WHERE city_id = $city_id AND delivery_type = '$delivery_type'";
$result = $conn->query($sql);

$branches = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $branches[] = $row; // Додаємо відділення до масиву
    }
} else {
    echo "0 results";
}

$conn->close();

// Повертаємо дані як JSON
header('Content-Type: application/json');
echo json_encode($branches);

