-- Crear tabla de becas
USE uth_becas;

CREATE TABLE IF NOT EXISTS `becas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `archivo_convocatoria` varchar(500) DEFAULT NULL,
  `activa` tinyint(1) DEFAULT 1,
  `fecha_creacion` timestamp DEFAULT CURRENT_TIMESTAMP,
  `fecha_actualizacion` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insertar algunas becas de ejemplo
INSERT INTO `becas` (`nombre`, `descripcion`, `fecha_inicio`, `fecha_fin`, `activa`) VALUES
('Beca Alimenticia', 'Beca para estudiantes con necesidades alimentarias básicas', '2025-01-01', '2025-12-31', 1),
('Beca de Excelencia', 'Beca para estudiantes con promedio superior a 8.5', '2025-01-01', '2025-12-31', 1),
('Beca Académica', 'Beca para estudiantes con buen rendimiento académico', '2025-01-01', '2025-12-31', 1),
('Beca Socioeconómica', 'Beca para estudiantes con situación económica vulnerable', '2025-01-01', '2025-12-31', 1);
