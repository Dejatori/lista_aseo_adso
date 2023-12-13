-- Crea la base de datos y la tabla
CREATE DATABASE IF NOT EXISTS lista_aseo;

USE lista_aseo;

CREATE TABLE lista (
    id INT AUTO_INCREMENT PRIMARY KEY,
    aprendiz VARCHAR(50) UNIQUE,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, -- Fecha se actualiza automaticamente
    puntos INT DEFAULT 1
);

-- Volcado de datos para la tabla `lista`
INSERT INTO lista (aprendiz, puntos) VALUES
('Andrés Prada', 1),
('Angel Corzo', 1),
('Brayan Tarazona', 1),
('Carlos Soto', 1),
('Cristian Camperos', 1),
('David Rodriguez', 1),
('David Toscano', 1),
('Edwar Parra', 1),
('Edwin Palacios', 1),
('Gersón Silva', 1),
('Hernán Rios', 1),
('Javier Cala', 1),
('Jonathan Albarracin', 1),
('Juan Niño', 1),
('Leonardo Montes', 1),
('Mauricio Peñaranda', 1),
('Nilton Betancur', 1),
('Osman Sepulveda', 1),
('Ronaldo Palacios', 1),
('Sergio Meneses', 1),
('Shirley Ortiz', 1),
('Yalile Martinez', 1),
('Yener Arismendi', 1),
('Yesica Vargas', 1);