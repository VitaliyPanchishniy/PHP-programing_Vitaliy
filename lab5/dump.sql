CREATE DATABASE IF NOT EXISTS shop_db;
USE shop_db;

-- Таблиця для товарів
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    description TEXT NOT NULL,
    discount DECIMAL(5, 2) DEFAULT 0.00
);

-- Таблиця для категорій
CREATE TABLE IF NOT EXISTS categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

-- Зв'язок товарів з категоріями
CREATE TABLE IF NOT EXISTS category_product (
    category_id INT,
    product_id INT,
    FOREIGN KEY (category_id) REFERENCES categories(id),
    FOREIGN KEY (product_id) REFERENCES products(id)
);
