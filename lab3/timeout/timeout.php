<?php
session_start();
$timeout = 300; // 5 хвилин

if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $timeout) {
    session_unset();
    session_destroy();
    echo "Сесія закінчилась бо ти неактавний.";
} else {
    $_SESSION['last_activity'] = time();
    echo "Сесія активна.";
}
?>
