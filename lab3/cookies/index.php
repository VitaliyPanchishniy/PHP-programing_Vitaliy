<?php
if (isset($_POST['username'])) {
    setcookie('username', htmlspecialchars($_POST['username']), time() + 7 * 24 * 60 * 60);
    header('Location: index.php'); 
    exit;
}

if (isset($_COOKIE['username'])) {
    $username = $_COOKIE['username'];
    echo "Привіт, $username!<br>";
    echo "<a href='clear_cookie.php'>Видалити ім'я</a>";
} else {
    echo "<form method='post' action='index.php'>
            Введіть ваше ім'я: <input type='text' name='username'>
            <input type='submit' value='Зберегти'>
          </form>";
}

