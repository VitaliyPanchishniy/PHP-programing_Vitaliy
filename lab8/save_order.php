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

// Отримання даних із запиту
$data = json_decode(file_get_contents('php://input'), true);

// Перевірка, чи є всі необхідні дані
if (!isset($data['order_number'], $data['weight'], $data['city'], $data['delivery_type'], $data['branch'])) {
    echo json_encode(["message" => "Не всі дані були надані!"]);
    exit;
}

// Підготовка даних до запису
$order_number = $conn->real_escape_string($data['order_number']);
$weight = $conn->real_escape_string($data['weight']);
$city = $conn->real_escape_string($data['city']);
$delivery_type = $conn->real_escape_string($data['delivery_type']);
$branch = $conn->real_escape_string($data['branch']);

// SQL-запит для додавання нового замовлення
$sql = "INSERT INTO orders (order_number, weight, city, delivery_type, branch) 
        VALUES ('$order_number', '$weight', '$city', '$delivery_type', '$branch')";

if ($conn->query($sql) === TRUE) {
    echo json_encode(["message" => "Замовлення успішно оформлено!"]);
} else {
    echo json_encode(["message" => "Помилка: " . $conn->error]);
}

$conn->close();
?>
