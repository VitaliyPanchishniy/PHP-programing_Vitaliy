<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

  
    if ($username == 'admin' && $password == '1234') {
        $_SESSION['user'] = $username;
        header('Location: dashboard.php');
        exit;
    } else {
        echo "Невірний логін або пароль!";
    }
}

if (isset($_SESSION['user'])) {
    header('Location: dashboard.php');
    exit;
}
?>

<form method="post" action="login.php">
    Логін: <input type="text" name="username"><br>
    Пароль: <input type="password" name="password"><br>
    <input type="submit" value="Увійти">
</form>
