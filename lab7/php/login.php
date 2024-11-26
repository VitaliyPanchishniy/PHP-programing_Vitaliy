<?php
include 'db.php';

$email = $_POST['email'];
$password = $_POST['password'];

$stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
$stmt->execute([$email]);

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user && password_verify($password, $user['password'])) {
  session_start();
  $_SESSION['username'] = $user['username'];
  echo "success";
} else {
  echo "Невірний логін або пароль.";
}
?>
