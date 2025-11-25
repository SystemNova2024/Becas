-- =====================================================
-- SCRIPT CON VALIDACIÓN DE DATOS
-- =====================================================
-- Este script limpia datos huérfanos antes de crear FK

-- =====================================================
-- PASO 1: DESHABILITAR VERIFICACIONES FK
-- =====================================================
SET FOREIGN_KEY_CHECKS = 0;

-- =====================================================
-- PASO 2: ELIMINAR TABLAS DE RBAC
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
-- PASO 5: LIMPIAR DATOS DE ROLES PRIMERO
-- =====================================================
DELETE FROM `roles` WHERE `id` IN (2, 4, 5, 6);

-- =====================================================
-- PASO 6: LIMPIAR USUARIOS CON ROLES ELIMINADOS
-- =====================================================
DELETE FROM `usuarios` WHERE `rol_id` IN (2, 4, 5, 6);

-- =====================================================
-- PASO 7: LIMPIAR DATOS HUÉRFANOS ANTES DE CREAR FK
-- =====================================================
-- Eliminar notificaciones de usuarios que no existen
DELETE n FROM `notificaciones` n 
LEFT JOIN `usuarios` u ON n.usuario_id = u.id 
WHERE u.id IS NULL;

-- Eliminar notificaciones de solicitudes que no existen
DELETE n FROM `notificaciones` n 
LEFT JOIN `solicitudes_becas` s ON n.solicitud_id = s.id 
WHERE s.id IS NULL;

-- Eliminar documentos de solicitudes que no existen
DELETE d FROM `documentos_solicitud` d 
LEFT JOIN `solicitudes_becas` s ON d.solicitud_id = s.id 
WHERE s.id IS NULL;

-- Eliminar solicitudes de usuarios que no existen
DELETE sb FROM `solicitudes_becas` sb 
LEFT JOIN `usuarios` u ON sb.estudiante_id = u.id 
WHERE u.id IS NULL;

-- Eliminar historial académico de usuarios que no existen
DELETE ha FROM `historial_academico` ha 
LEFT JOIN `usuarios` u ON ha.estudiante_id = u.id 
WHERE u.id IS NULL;

-- =====================================================
-- PASO 8: ELIMINAR FOREIGN KEYS EXISTENTES
-- =====================================================
-- Eliminar FK de usuarios (ignorar error si no existe)
ALTER TABLE `usuarios` DROP FOREIGN KEY `fk_usuario_rol`;

-- Eliminar FK de solicitudes_becas (ignorar error si no existe)
ALTER TABLE `solicitudes_becas` DROP FOREIGN KEY `fk_solicitud_usuario`;

-- Eliminar FK de documentos_solicitud (ignorar error si no existe)
ALTER TABLE `documentos_solicitud` DROP FOREIGN KEY `fk_documento_solicitud`;

-- Eliminar FK de notificaciones (ignorar errores si no existen)
ALTER TABLE `notificaciones` DROP FOREIGN KEY `fk_notificacion_solicitud`;
ALTER TABLE `notificaciones` DROP FOREIGN KEY `fk_notificacion_usuario`;

-- Eliminar FK de historial_academico (ignorar error si no existe)
ALTER TABLE `historial_academico` DROP FOREIGN KEY `fk_historial_usuario`;

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






