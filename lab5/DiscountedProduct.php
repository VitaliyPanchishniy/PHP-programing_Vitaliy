<?php
class DiscountedProduct extends Product {
    private $discount;  // Відсоток знижки

    // Конструктор, який ініціалізує батьківські властивості та знижку
    public function __construct($name, $price, $description, $discount) {
        parent::__construct($name, $price, $description);  // Виклик конструктора батьківського класу
        $this->discount = $discount;
    }

    // Метод для розрахунку ціни з урахуванням знижки
    public function getDiscountedPrice() {
        return $this->price - ($this->price * $this->discount / 100);
    }

    // Перевизначений метод для виведення інформації про товар зі знижкою
    public function getInfo() {
        return parent::getInfo() .
               "Знижка: " . $this->discount . "%<br>" .
               "Ціна зі знижкою: " . $this->getDiscountedPrice() . "<br>";
    }
}
