<?php
session_start();

// Додавання товарів до сесії
if (isset($_POST['product'])) {
    $_SESSION['cart'][] = $_POST['product'];
}

// Збереження попередніх покупок у cookie
if (isset($_SESSION['cart'])) {
    setcookie('previous_cart', serialize($_SESSION['cart']), time() + 7 * 24 * 60 * 60);
}

// Виведення товарів з корзини
if (isset($_SESSION['cart'])) {
    echo "<h2>Товари в корзині:</h2><ul>";
    foreach ($_SESSION['cart'] as $item) {
        echo "<li>$item</li>";
    }
    echo "</ul>";
}

// Виведення попередніх покупок з cookie
if (isset($_COOKIE['previous_cart'])) {
    $previous_cart = unserialize($_COOKIE['previous_cart']);
    echo "<h2>Попередні покупки:</h2><ul>";
    foreach ($previous_cart as $item) {
        echo "<li>$item</li>";
    }
    echo "</ul>";
}
?>

<form method="post" action="index.php">
    Додати товар: <input type="text" name="product"><br>
    <input type="submit" value="Додати в корзину">
</form>
<a href="clear_cart.php">Очистити корзину</a>