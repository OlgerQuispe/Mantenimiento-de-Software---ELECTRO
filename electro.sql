-- Crear la tabla usuarios
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE categoria_productos(
    id_categoria int(11) not null primary KEY,
    categoria_nombre VARCHAR(255) not null

);

CREATE TABLE productos(
    id int(11) primary KEY,
    titulo VARCHAR(255),
    precio decimal(2,1) not null,
    stock int(32) not null,
    img_url VARCHAR(255) not null,
    categoria int,
    KEY categoria(categoria),
    CONSTRAINT `productos_fk`FOREIGN KEY (categoria) REFERENCES categoria_productos (id_categoria)
);

-- Insertar datos en la tabla categoria_productos
INSERT INTO categoria_productos (id_categoria, categoria_nombre) VALUES
(1, 'Notebook'),
(2, 'Smartphones'),
(3, 'Camaras'),
(4, 'Accesorios'),

-- Insertar datos en la tabla productos
INSERT INTO productos (id, titulo, precio, stock, img_url, categoria) VALUES
(1, 'Notebook HP', 25.000, 100, './img/product01.png', 1),
(2, 'Auriculares Gamer', 790, 50, './img/AuriGamer.png', 4),
(3, 'Notebook Bangho', 20.000, 20, './img/product03.png', 1),
(4, 'Tablet Sony 10°', 10.000, 30, './img/product04.png', 2),
(5, 'Auriculares Sony', 1.030, 40, './img/aurisony.png', 4),


