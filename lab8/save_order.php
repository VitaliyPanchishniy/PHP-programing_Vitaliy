<?php
$dsn = "pgsql:host=postgres;port=5432;dbname=laravel-getting-started";
$username = "laravel-getting-started-user";
$password = "laravel-getting-started-password";

try {
    $pdo = new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch (PDOException $e) {
    echo json_encode(['message' => 'Помилка підключення до бази даних: ' . $e->getMessage()]);
    exit;
}

$orderNumber = $_POST['order_number'] ?? null;
$weight = $_POST['weight'] ?? null;
$city = $_POST['city'] ?? null;
$deliveryOption = $_POST['delivery_option'] ?? null;
$deliveryPoint = $_POST['delivery_point'] ?? null;

if (!$orderNumber || !$weight || !$city || !$deliveryOption || !$deliveryPoint) {
    echo json_encode(['message' => 'Заповніть усі поля']);
    exit;
}

$query = "INSERT INTO orders (order_number, weight, city, delivery_option, delivery_point)
          VALUES (:order_number, :weight, :city, :delivery_option, :delivery_point)";
try {
    $stmt = $pdo->prepare($query);
    $stmt->execute([
        ':order_number' => $orderNumber,
        ':weight' => $weight,
        ':city' => $city,
        ':delivery_option' => $deliveryOption,
        ':delivery_point' => $deliveryPoint,
    ]);
    echo json_encode(['message' => 'Замовлення успішно збережено']);
} catch (PDOException $e) {
    echo json_encode(['message' => 'Помилка збереження замовлення: ' . $e->getMessage()]);
}
?>