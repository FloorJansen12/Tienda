CREATE DATABASE tienda;
USE tienda;
CREATE TABLE productoses (
    id INT AUTO_INCREMENT NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT,
    precio DECIMAL(10,2) NOT NULL,
    PRIMARY KEY (id)
);
CREATE TABLE productosen (
    id INT AUTO_INCREMENT NOT NULL,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    PRIMARY KEY (id)
);  


INSERT INTO productoses (nombre, descripcion, precio) VALUES
('Camiseta', 'Camiseta de algodón 100%', 19.99),
('Pantalones', 'Pantalones vaqueros ajustados', 49.99),
('Zapatos', 'Zapatos deportivos cómodos', 89.99),
('Gorra', 'Gorra de béisbol clásica', 15.99),
('Chaqueta', 'Chaqueta impermeable', 79.99);

INSERT INTO productosen (name, description, price) VALUES
('T-Shirt', '100% cotton T-shirt', 19.99),
('Jeans', 'Slim fit jeans', 49.99),
('Shoes', 'Comfortable sports shoes', 89.99),
('Cap', 'Classic baseball cap', 15.99),
('Jacket', 'Waterproof jacket', 79.99);