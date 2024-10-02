<?php
// Видалення cookie
setcookie('username', '', time() - 3600); // Мінус час для видалення
header('Location: index.php'); // Повернення на головну сторінку
exit;
?>
