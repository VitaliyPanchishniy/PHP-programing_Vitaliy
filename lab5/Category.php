<?php
class Category {
    public $categoryName;
    public $products = [];

    // Конструктор для ініціалізації назви категорії
    public function __construct($categoryName) {
        $this->categoryName = $categoryName;
    }

    // Метод для додавання товару до категорії
    public function addProduct($product) {
        $this->products[] = $product;
    }

    // Метод для виведення всіх товарів категорії
    public function showProducts() {
        echo "<h2>Категорія: " . $this->categoryName . "</h2>";
        foreach ($this->products as $product) {
            echo $product->getInfo() . "<hr>";
        }
    }
}
