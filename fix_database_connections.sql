-- =====================================================
-- SCRIPT PARA ARREGLAR CONEXIONES DE BASE DE DATOS
-- =====================================================
-- Este script arregla las conexiones entre tablas y luego limpia

-- =====================================================
-- PASO 1: DESHABILITAR VERIFICACIONES DE FK
-- =====================================================
SET FOREIGN_KEY_CHECKS = 0;

-- =====================================================
-- PASO 2: ARREGLAR TABLA SOLICITUDES_BECAS
-- =====================================================
-- Agregar foreign key a becas si existe la tabla
-- (Esto fallará si la tabla becas no existe, pero no importa)

-- Primero verificar si existe la tabla becas
-- Si existe, agregar la foreign key
SET @table_exists = 0;
SELECT COUNT(*) INTO @table_exists 
FROM information_schema.tables 
WHERE table_schema = DATABASE() 
AND table_name = 'becas';

-- Solo agregar FK si la tabla becas existe
SET @sql = IF(@table_exists > 0, 
    'ALTER TABLE `solicitudes_becas` ADD CONSTRAINT `fk_solicitud_beca` FOREIGN KEY (`beca_id`) REFERENCES `becas`(`id`) ON DELETE CASCADE',
    'SELECT "Tabla becas no existe, saltando FK" as mensaje'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- =====================================================
-- PASO 3: ARREGLAR TABLA USUARIOS
-- =====================================================
-- Agregar foreign key a roles
ALTER TABLE `usuarios` 
ADD CONSTRAINT `fk_usuario_rol` 
FOREIGN KEY (`rol_id`) REFERENCES `roles`(`id`) ON DELETE RESTRICT;

-- =====================================================
-- PASO 4: ARREGLAR TABLA DOCUMENTOS_SOLICITUD
-- =====================================================
-- Agregar foreign key a solicitudes_becas
ALTER TABLE `documentos_solicitud` 
ADD CONSTRAINT `fk_documento_solicitud` 
FOREIGN KEY (`solicitud_id`) REFERENCES `solicitudes_becas`(`id`) ON DELETE CASCADE;

-- =====================================================
-- PASO 5: ARREGLAR TABLA NOTIFICACIONES
-- =====================================================
-- Agregar foreign key a solicitudes_becas
ALTER TABLE `notificaciones` 
ADD CONSTRAINT `fk_notificacion_solicitud` 
FOREIGN KEY (`solicitud_id`) REFERENCES `solicitudes_becas`(`id`) ON DELETE CASCADE;

-- Agregar foreign key a usuarios
ALTER TABLE `notificaciones` 
ADD CONSTRAINT `fk_notificacion_usuario` 
FOREIGN KEY (`usuario_id`) REFERENCES `usuarios`(`id`) ON DELETE CASCADE;

-- =====================================================
-- PASO 6: ARREGLAR TABLA OBSERVACIONES
-- =====================================================
-- Agregar foreign key a solicitudes_becas
ALTER TABLE `observaciones` 
ADD CONSTRAINT `fk_observacion_solicitud` 
FOREIGN KEY (`solicitud_id`) REFERENCES `solicitudes_becas`(`id`) ON DELETE CASCADE;

-- Agregar foreign key a usuarios
ALTER TABLE `observaciones` 
ADD CONSTRAINT `fk_observacion_usuario` 
FOREIGN KEY (`usuario_id`) REFERENCES `usuarios`(`id`) ON DELETE CASCADE;

-- =====================================================
-- PASO 7: ARREGLAR TABLA HISTORIAL_ACADEMICO
-- =====================================================
-- Agregar foreign key a usuarios
ALTER TABLE `historial_academico` 
ADD CONSTRAINT `fk_historial_usuario` 
FOREIGN KEY (`estudiante_id`) REFERENCES `usuarios`(`id`) ON DELETE CASCADE;

-- =====================================================
-- PASO 8: ARREGLAR TABLA SOLICITUDES_BECAS
-- =====================================================
-- Agregar foreign key a usuarios
ALTER TABLE `solicitudes_becas` 
ADD CONSTRAINT `fk_solicitud_usuario` 
FOREIGN KEY (`estudiante_id`) REFERENCES `usuarios`(`id`) ON DELETE CASCADE;

-- =====================================================
-- PASO 9: REHABILITAR VERIFICACIONES DE FK
-- =====================================================
SET FOREIGN_KEY_CHECKS = 1;

-- =====================================================
-- PASO 10: VERIFICAR CONEXIONES
-- =====================================================
-- Mostrar todas las foreign keys creadas
SELECT 
    TABLE_NAME,
    COLUMN_NAME,
    CONSTRAINT_NAME,
    REFERENCED_TABLE_NAME,
    REFERENCED_COLUMN_NAME
FROM information_schema.KEY_COLUMN_USAGE 
WHERE TABLE_SCHEMA = DATABASE() 
AND REFERENCED_TABLE_NAME IS NOT NULL
ORDER BY TABLE_NAME, COLUMN_NAME;

-- =====================================================
-- PASO 11: MOSTRAR ESTRUCTURA FINAL
-- =====================================================
-- Mostrar tablas y sus relaciones
SHOW TABLES;

-- Mostrar resumen de conexiones
SELECT 
    'Conexiones establecidas correctamente' as estado,
    COUNT(*) as total_fk
FROM information_schema.KEY_COLUMN_USAGE 
WHERE TABLE_SCHEMA = DATABASE() 
AND REFERENCED_TABLE_NAME IS NOT NULL;

COMMIT;






