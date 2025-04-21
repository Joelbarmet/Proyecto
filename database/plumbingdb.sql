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

CREATE TABLE reparaciones (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_cliente INT,
    id_empleado INT,
    id_servicio INT,
    fecha DATE DEFAULT CURRENT_DATE,
    estado ENUM('pendiente', 'en_proceso', 'completado', 'cancelado') DEFAULT 'pendiente',
    FOREIGN KEY (id_cliente) REFERENCES clientes(id),
    FOREIGN KEY (id_empleado) REFERENCES empleados(id),
    FOREIGN KEY (id_servicio) REFERENCES servicios(id)
);

CREATE TABLE facturas (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_cliente INT,
    id_reparacion INT,
    fecha DATE DEFAULT CURRENT_DATE,
    total DECIMAL(10,2),
    FOREIGN KEY (id_cliente) REFERENCES clientes(id),
    FOREIGN KEY (id_reparacion) REFERENCES reparaciones(id)
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

INSERT INTO reparaciones (id_cliente, id_empleado, id_servicio, fecha, estado) VALUES
(1, 1, 1, '2024-04-01', 'completado'),
(2, 2, 2, '2024-04-03', 'en_proceso'),
(3, 3, 3, '2024-04-05', 'pendiente');

INSERT INTO facturas (id_cliente, id_reparacion, fecha, total) VALUES
(1, 1, '2024-04-01', 50.00),
(2, 2, '2024-04-03', 120.00),
(3, 3, '2024-04-05', 80.00);

