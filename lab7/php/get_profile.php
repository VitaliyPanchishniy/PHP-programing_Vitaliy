<?php
session_start();
include 'db.php';

if (!isset($_SESSION['username'])) {
  http_response_code(401);
  echo "Користувач не авторизований.";
  exit;
}

$username = $_SESSION['username'];
$stmt = $pdo->prepare("SELECT username FROM users WHERE username = ?");
$stmt->execute([$username]);

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user) {
  echo json_encode($user);
} else {
  http_response_code(404);
  echo "Користувач не знайдений.";
}
?>
