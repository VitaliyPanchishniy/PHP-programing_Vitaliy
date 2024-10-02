<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

echo "Привіт, " . $_SESSION['user'] . "!<br>";
echo "<a href='logout.php'>Вийти</a>";
?>
