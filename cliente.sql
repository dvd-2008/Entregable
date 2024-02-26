-- Crear la tabla "cliente"
CREATE TABLE cliente (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    Nombre VARCHAR(50) NOT NULL,
    Apellido VARCHAR(50) NOT NULL,
    Edad INT NOT NULL
);

-- Insertar algunos datos ficticios
INSERT INTO cliente (Nombre, Apellido, Edad) VALUES ('Juan', 'González', 35);
INSERT INTO cliente (Nombre, Apellido, Edad) VALUES ('María', 'López', 28);
INSERT INTO cliente (Nombre, Apellido, Edad) VALUES ('Pedro', 'Martínez', 42);
