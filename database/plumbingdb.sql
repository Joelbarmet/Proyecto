DROP DATABASE IF EXISTS plumbing;
CREATE DATABASE plumbing;
USE plumbing;

CREATE TABLE empleados (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    usuario VARCHAR(100) NOT NULL,
    telefono VARCHAR(20),
    email VARCHAR(100),
    contraseña VARCHAR(255) NOT NULL
);
CREATE TABLE clientes (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    telefono VARCHAR(20),
    email VARCHAR(100),
    direccion TEXT
);

CREATE TABLE servicios (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT,
    precio DECIMAL(10,2) NOT NULL
);

CREATE TABLE productos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT,
    precio DECIMAL(10,2) NOT NULL,
    stock INT DEFAULT 0
);

CREATE TABLE trabajos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_cliente INT,
    id_empleado INT,
    id_servicio INT,
    tipo ENUM('reparacion', 'instalacion') DEFAULT 'reparacion',
    fecha DATE DEFAULT CURRENT_DATE,
    estado ENUM('pendiente', 'en_proceso', 'completado', 'cancelado') DEFAULT 'pendiente',
    FOREIGN KEY (id_cliente) REFERENCES clientes(id),
    FOREIGN KEY (id_empleado) REFERENCES empleados(id),
    FOREIGN KEY (id_servicio) REFERENCES servicios(id)
);

CREATE TABLE facturas (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_cliente INT,
    id_trabajo INT,
    fecha DATE DEFAULT CURRENT_DATE,
    total DECIMAL(10,2),
    FOREIGN KEY (id_cliente) REFERENCES clientes(id),
    FOREIGN KEY (id_trabajo) REFERENCES trabajos(id)
);

CREATE TABLE ventas (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_cliente INT,
    fecha DATE DEFAULT CURRENT_DATE,
    total DECIMAL(10,2),
    FOREIGN KEY (id_cliente) REFERENCES clientes(id)
);

CREATE TABLE detalles_ventas (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_venta INT,
    id_producto INT,
    cantidad INT NOT NULL,
    precio_unitario DECIMAL(10,2),
    FOREIGN KEY (id_venta) REFERENCES ventas(id),
    FOREIGN KEY (id_producto) REFERENCES productos(id)
);

INSERT INTO empleados (nombre, usuario, telefono, email, contraseña) VALUES
('Juan Pérez', 'Juan', '555-1234', 'juan@plumbing.com', '1234'),
('Laura Gómez', 'Laura', '555-5678', 'laura@plumbing.com', 'abcd'),
('Carlos Ruiz', 'Carlos', '555-9012', 'carlos@plumbing.com', 'admin123');

INSERT INTO clientes (nombre, telefono, email, direccion) VALUES
('Ana Martínez', '555-1111', 'ana@gmail.com', 'Calle 1, Ciudad A'),
('Luis Torres', '555-2222', 'luis@hotmail.com', 'Calle 2, Ciudad B'),
('María López', '555-3333', 'maria@yahoo.com', 'Calle 3, Ciudad C');

INSERT INTO servicios (nombre, descripcion, precio) VALUES
('Reparación de fuga', 'Detección y reparación de fugas de agua', 50.00),
('Instalación de lavabo', 'Instalación completa de lavamanos', 120.00),
('Mantenimiento general', 'Revisión completa de tuberías y grifos', 80.00);

INSERT INTO productos (nombre, descripcion, precio, stock) VALUES
('Tubo PVC 1m', 'Tubo de PVC de 1 metro de largo', 5.00, 100),
('Llave de paso', 'Llave metálica para control de agua', 12.00, 50),
('Sifón de lavamanos', 'Sifón de plástico universal', 8.00, 30);

INSERT INTO trabajos (id_cliente, id_empleado, id_servicio, tipo, fecha, estado) VALUES
(1, 1, 1, 'reparacion', '2024-04-01', 'completado'),
(2, 2, 2, 'instalacion', '2024-04-03', 'en_proceso'),
(3, 3, 3, 'reparacion', '2024-04-05', 'pendiente');

INSERT INTO facturas (id_cliente, id_trabajo, fecha, total) VALUES
(1, 1, '2024-04-01', 50.00),
(2, 2, '2024-04-03', 120.00),
(3, 3, '2024-04-05', 80.00);

INSERT INTO ventas (id_cliente, fecha, total) VALUES
(1, '2024-04-02', 25.00),
(2, '2024-04-04', 20.00);

INSERT INTO detalles_ventas (id_venta, id_producto, cantidad, precio_unitario) VALUES
(1, 1, 2, 5.00),
(1, 3, 1, 8.00),
(2, 2, 1, 12.00);
