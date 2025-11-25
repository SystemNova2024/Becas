-- =====================================================
-- SCRIPT SEGURO - LIMPIEZA DE BASE DE DATOS
-- =====================================================
-- Este script verifica la existencia de tablas antes de operar

-- =====================================================
-- PASO 1: DESHABILITAR VERIFICACIONES FK
-- =====================================================
SET FOREIGN_KEY_CHECKS = 0;

-- =====================================================
-- PASO 2: ELIMINAR TABLAS DE RBAC (SIN DEPENDENCIAS)
-- =====================================================
DROP TABLE IF EXISTS `auth_assignment`;
DROP TABLE IF EXISTS `auth_item_child`;
DROP TABLE IF EXISTS `auth_item`;
DROP TABLE IF EXISTS `auth_rule`;

-- =====================================================
-- PASO 3: ELIMINAR TABLAS NO CONECTADAS
-- =====================================================
DROP TABLE IF EXISTS `becas`;
DROP TABLE IF EXISTS `tipos_becas`;
DROP TABLE IF EXISTS `criterios_elegibilidad`;

-- =====================================================
-- PASO 4: ELIMINAR TABLAS ADICIONALES
-- =====================================================
DROP TABLE IF EXISTS `configuraciones`;
DROP TABLE IF EXISTS `migration`;
DROP TABLE IF EXISTS `observaciones`;

-- =====================================================
-- PASO 5: ELIMINAR FOREIGN KEYS EXISTENTES (SOLO SI LAS TABLAS EXISTEN)
-- =====================================================
-- Verificar y eliminar FK de usuarios
SET @table_exists = 0;
SELECT COUNT(*) INTO @table_exists 
FROM information_schema.tables 
WHERE table_schema = DATABASE() 
AND table_name = 'usuarios';

SET @sql = IF(@table_exists > 0, 
    'ALTER TABLE `usuarios` DROP FOREIGN KEY IF EXISTS `fk_usuario_rol`',
    'SELECT "Tabla usuarios no existe" as mensaje'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- Verificar y eliminar FK de solicitudes_becas
SET @table_exists = 0;
SELECT COUNT(*) INTO @table_exists 
FROM information_schema.tables 
WHERE table_schema = DATABASE() 
AND table_name = 'solicitudes_becas';

SET @sql = IF(@table_exists > 0, 
    'ALTER TABLE `solicitudes_becas` DROP FOREIGN KEY IF EXISTS `fk_solicitud_usuario`',
    'SELECT "Tabla solicitudes_becas no existe" as mensaje'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- Verificar y eliminar FK de documentos_solicitud
SET @table_exists = 0;
SELECT COUNT(*) INTO @table_exists 
FROM information_schema.tables 
WHERE table_schema = DATABASE() 
AND table_name = 'documentos_solicitud';

SET @sql = IF(@table_exists > 0, 
    'ALTER TABLE `documentos_solicitud` DROP FOREIGN KEY IF EXISTS `fk_documento_solicitud`',
    'SELECT "Tabla documentos_solicitud no existe" as mensaje'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- Verificar y eliminar FK de notificaciones
SET @table_exists = 0;
SELECT COUNT(*) INTO @table_exists 
FROM information_schema.tables 
WHERE table_schema = DATABASE() 
AND table_name = 'notificaciones';

SET @sql = IF(@table_exists > 0, 
    'ALTER TABLE `notificaciones` DROP FOREIGN KEY IF EXISTS `fk_notificacion_solicitud`; ALTER TABLE `notificaciones` DROP FOREIGN KEY IF EXISTS `fk_notificacion_usuario`',
    'SELECT "Tabla notificaciones no existe" as mensaje'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- Verificar y eliminar FK de historial_academico
SET @table_exists = 0;
SELECT COUNT(*) INTO @table_exists 
FROM information_schema.tables 
WHERE table_schema = DATABASE() 
AND table_name = 'historial_academico';

SET @sql = IF(@table_exists > 0, 
    'ALTER TABLE `historial_academico` DROP FOREIGN KEY IF EXISTS `fk_historial_usuario`',
    'SELECT "Tabla historial_academico no existe" as mensaje'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- =====================================================
-- PASO 6: LIMPIAR DATOS DE ROLES
-- =====================================================
DELETE FROM `roles` WHERE `id` IN (2, 4, 5, 6);

-- =====================================================
-- PASO 7: LIMPIAR USUARIOS CON ROLES ELIMINADOS
-- =====================================================
DELETE FROM `usuarios` WHERE `rol_id` IN (2, 4, 5, 6);

-- =====================================================
-- PASO 8: LIMPIAR REFERENCIAS HUÉRFANAS
-- =====================================================
-- Solo si las tablas existen
DELETE n FROM `notificaciones` n 
LEFT JOIN `solicitudes_becas` s ON n.solicitud_id = s.id 
WHERE s.id IS NULL;

DELETE d FROM `documentos_solicitud` d 
LEFT JOIN `solicitudes_becas` s ON d.solicitud_id = s.id 
WHERE s.id IS NULL;

-- =====================================================
-- PASO 9: CREAR FOREIGN KEYS NUEVAS
-- =====================================================
-- Agregar FK a usuarios
ALTER TABLE `usuarios` 
ADD CONSTRAINT `fk_usuario_rol` 
FOREIGN KEY (`rol_id`) REFERENCES `roles`(`id`) ON DELETE RESTRICT;

-- Agregar FK a solicitudes_becas
ALTER TABLE `solicitudes_becas` 
ADD CONSTRAINT `fk_solicitud_usuario` 
FOREIGN KEY (`estudiante_id`) REFERENCES `usuarios`(`id`) ON DELETE CASCADE;

-- Agregar FK a documentos_solicitud
ALTER TABLE `documentos_solicitud` 
ADD CONSTRAINT `fk_documento_solicitud` 
FOREIGN KEY (`solicitud_id`) REFERENCES `solicitudes_becas`(`id`) ON DELETE CASCADE;

-- Agregar FK a notificaciones
ALTER TABLE `notificaciones` 
ADD CONSTRAINT `fk_notificacion_solicitud` 
FOREIGN KEY (`solicitud_id`) REFERENCES `solicitudes_becas`(`id`) ON DELETE CASCADE;

ALTER TABLE `notificaciones` 
ADD CONSTRAINT `fk_notificacion_usuario` 
FOREIGN KEY (`usuario_id`) REFERENCES `usuarios`(`id`) ON DELETE CASCADE;

-- Agregar FK a historial_academico
ALTER TABLE `historial_academico` 
ADD CONSTRAINT `fk_historial_usuario` 
FOREIGN KEY (`estudiante_id`) REFERENCES `usuarios`(`id`) ON DELETE CASCADE;

-- =====================================================
-- PASO 10: REHABILITAR VERIFICACIONES FK
-- =====================================================
SET FOREIGN_KEY_CHECKS = 1;

-- =====================================================
-- PASO 11: VERIFICAR RESULTADOS
-- =====================================================
SHOW TABLES;

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

SELECT COUNT(*) as usuarios_validos FROM `usuarios` WHERE `rol_id` IN (1, 3);
SELECT COUNT(*) as solicitudes_activas FROM `solicitudes_becas`;
SELECT * FROM `roles`;

-- =====================================================
-- PASO 12: OPTIMIZAR TABLAS
-- =====================================================
OPTIMIZE TABLE `usuarios`;
OPTIMIZE TABLE `solicitudes_becas`;
OPTIMIZE TABLE `documentos_solicitud`;
OPTIMIZE TABLE `notificaciones`;
OPTIMIZE TABLE `historial_academico`;

COMMIT;






