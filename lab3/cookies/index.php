<?php
// Встановлення cookie на 7 днів, якщо ім'я введено
if (isset($_POST['username'])) {
    setcookie('username', htmlspecialchars($_POST['username']), time() + 7 * 24 * 60 * 60);
    header('Location: index.php'); // Оновлюємо сторінку після введення
    exit;
}

// Видалення cookie, якщо воно встановлене
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
?>
