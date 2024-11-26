<?php
session_start();
include 'db.php';

if (!isset($_SESSION['username'])) {
  echo "Користувач не авторизований.";
  exit;
}

$currentUsername = $_SESSION['username'];
$newUsername = $_POST['username'];
$newPassword = $_POST['password'];

if (!$newUsername) {
  echo "Ім'я користувача не може бути порожнім.";
  exit;
}

// Перевірка, чи ім'я вже зайняте
$stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? AND username != ?");
$stmt->execute([$newUsername, $currentUsername]);
if ($stmt->rowCount() > 0) {
  echo "Ім'я користувача вже використовується.";
  exit;
}

// Оновлення даних
$query = "UPDATE users SET username = ?";
$params = [$newUsername];

if ($newPassword) {
  $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
  $query .= ", password = ?";
  $params[] = $hashedPassword;
}

$query .= " WHERE username = ?";
$params[] = $currentUsername;

$stmt = $pdo->prepare($query);
if ($stmt->execute($params)) {
  $_SESSION['username'] = $newUsername;
  echo "success";
} else {
  echo "Помилка оновлення профілю.";
}
?>
