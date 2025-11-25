-- Scripts SQL para las tablas del sistema de Servicios Escolares

-- Tabla para notificaciones entre servicios escolares y estudiantes
CREATE TABLE IF NOT EXISTS `notificaciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `solicitud_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `mensaje` text NOT NULL,
  `tipo` varchar(50) DEFAULT 'general',
  `fecha_creacion` datetime NOT NULL,
  `leida` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `fk_notificaciones_solicitud` (`solicitud_id`),
  KEY `fk_notificaciones_usuario` (`usuario_id`),
  CONSTRAINT `fk_notificaciones_solicitud` FOREIGN KEY (`solicitud_id`) REFERENCES `solicitudes_becas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_notificaciones_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabla para observaciones del historial de solicitudes
CREATE TABLE IF NOT EXISTS `observaciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `solicitud_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `observacion` text NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_observaciones_solicitud` (`solicitud_id`),
  KEY `fk_observaciones_usuario` (`usuario_id`),
  CONSTRAINT `fk_observaciones_solicitud` FOREIGN KEY (`solicitud_id`) REFERENCES `solicitudes_becas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_observaciones_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabla para historial académico de estudiantes
CREATE TABLE IF NOT EXISTS `historial_academico` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `estudiante_id` int(11) NOT NULL,
  `periodo` varchar(20) NOT NULL,
  `promedio` decimal(4,2) NOT NULL,
  `materias_aprobadas` int(11) DEFAULT 0,
  `materias_reprobadas` int(11) DEFAULT 0,
  `creditos_aprobados` int(11) DEFAULT 0,
  `creditos_reprobados` int(11) DEFAULT 0,
  `fecha_actualizacion` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_historial_estudiante` (`estudiante_id`),
  CONSTRAINT `fk_historial_estudiante` FOREIGN KEY (`estudiante_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabla para configuraciones del sistema
CREATE TABLE IF NOT EXISTS `configuraciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `clave` varchar(100) NOT NULL,
  `valor` text NOT NULL,
  `descripcion` text,
  `fecha_actualizacion` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `clave` (`clave`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insertar configuraciones iniciales
INSERT INTO `configuraciones` (`clave`, `valor`, `descripcion`, `fecha_actualizacion`) VALUES
('promedio_minimo_beca', '8.0', 'Promedio mínimo requerido para becas de excelencia', NOW()),
('promedio_minimo_alimenticia', '7.0', 'Promedio mínimo requerido para beca alimenticia', NOW()),
('promedio_minimo_asistencia', '7.5', 'Promedio mínimo requerido para beca de asistencia', NOW()),
('tiempo_maximo_revision', '48', 'Tiempo máximo en horas para revisar una solicitud', NOW()),
('notificaciones_automaticas', '1', 'Activar notificaciones automáticas (1=si, 0=no)', NOW());

-- Agregar índices adicionales para mejorar el rendimiento
ALTER TABLE `solicitudes_becas` ADD INDEX `idx_estatus_fecha` (`estatus`, `fecha_solicitud`);
ALTER TABLE `solicitudes_becas` ADD INDEX `idx_estudiante_estatus` (`estudiante_id`, `estatus`);
ALTER TABLE `usuarios` ADD INDEX `idx_rol_activo` (`rol_id`, `activo`);

-- Insertar datos de ejemplo para pruebas
INSERT INTO `notificaciones` (`solicitud_id`, `usuario_id`, `mensaje`, `tipo`, `fecha_creacion`, `leida`) VALUES
(1, 1, 'Tu solicitud de beca ha sido recibida y está siendo revisada.', 'general', NOW(), 0),
(1, 1, 'Por favor, sube nuevamente el comprobante de ingresos ya que no es legible.', 'documentos', NOW(), 0);

INSERT INTO `observaciones` (`solicitud_id`, `usuario_id`, `observacion`, `fecha_creacion`) VALUES
(1, 2, 'Solicitud recibida y en proceso de revisión inicial.', NOW()),
(1, 2, 'Documentos verificados, pendiente validación académica.', NOW());

INSERT INTO `historial_academico` (`estudiante_id`, `periodo`, `promedio`, `materias_aprobadas`, `materias_reprobadas`, `creditos_aprobados`, `creditos_reprobados`, `fecha_actualizacion`) VALUES
(1, '2024-1', 8.5, 6, 0, 18, 0, NOW()),
(1, '2023-2', 8.2, 5, 1, 15, 3, NOW()),
(1, '2023-1', 7.8, 4, 2, 12, 6, NOW());
