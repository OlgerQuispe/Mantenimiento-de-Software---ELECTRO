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
    precio decimal(5,2) not null,
    stock int(32) not null,
    img_url VARCHAR(255) not null,
    categoria int,
    starr VARCHAR(255),
    KEY categoria(categoria),
    CONSTRAINT `productos_fk`FOREIGN KEY (categoria) REFERENCES categoria_productos (id_categoria)
);

-- Insertar datos en la tabla categoria_productos
INSERT INTO categoria_productos (id_categoria, categoria_nombre) VALUES
(1, 'Notebook'),
(2, 'Smartphones'),
(3, 'Camaras'),
(4, 'Accesorios');

-- Insertar datos en la tabla productos
INSERT INTO productos (id, titulo, precio, stock, img_url, categoria, starr) VALUES
(1, 'Notebook HP',          25.00,      100,    './img/product01.png', 1, 'Estrellas'),
(2, 'Auriculares Gamer',    7.00,       50,     './img/AuriGamer.png', 4, 'Estrellas2'),
(3, 'Notebook Bangho',      20.00,      20,     './img/product03.png', 1, 'Estrellas3'),
(4, 'Tablet Sony 10°',      10.00,      30,     './img/product04.png', 2, 'Estrellas4'),
(5, 'Auriculares Sony',     100.00,     40,     './img/aurisony.png',  4, 'Estrellas5');


