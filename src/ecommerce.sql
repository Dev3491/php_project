CREATE DATABASE ecommerce;

USE ecommerce;

CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    price DECIMAL(10, 2),
    image VARCHAR(100)
);

INSERT INTO products (name, price, image) VALUES
('Product 1', 19.99, 'product1.jpg'),
('Product 2', 29.99, 'product2.jpg'),
('Product 3', 39.99, 'product3.jpg');
