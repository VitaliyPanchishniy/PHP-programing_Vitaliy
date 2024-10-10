<?php
// Імпортуємо класи
require_once 'Product.php';
require_once 'DiscountedProduct.php';
require_once 'Category.php';

// Створюємо об'єкти товарів
$product1 = new Product("Ноутбук", 15000, "Ноутбук високої якості.");
$product2 = new Product("Телефон", 8000, "Сучасний смартфон.");
$product3 = new DiscountedProduct("Телевізор", 20000, "Сучасний телевізор з 4K", 10);

// Створюємо об'єкт категорії
$electronics = new Category("Електроніка");

// Додаємо товари до категорії
$electronics->addProduct($product1);
$electronics->addProduct($product2);
$electronics->addProduct($product3);

// Виводимо всі товари категорії
$electronics->showProducts();
