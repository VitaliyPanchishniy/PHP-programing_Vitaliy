<?php
class Product {
    public $name;
    public $description;
    protected $price;

    // Конструктор для ініціалізації властивостей товару
    public function __construct($name, $price, $description) {
        $this->name = $name;
        $this->setPrice($price);  // Валідація ціни
        $this->description = $description;
    }

    // Встановлення ціни з валідацією (ціна не може бути від'ємною)
    public function setPrice($price) {
        if ($price < 0) {
            throw new Exception("Price cannot be negative.");
        }
        $this->price = $price;
    }

    // Метод для отримання ціни
    public function getPrice() {
        return $this->price;
    }

    // Метод для виведення інформації про товар
    public function getInfo() {
        return "Назва: " . $this->name . "<br>" .
               "Ціна: " . $this->getPrice() . "<br>" .
               "Опис: " . $this->description . "<br>";
    }
}
