-- =====================================================
-- SCRIPT DE VERIFICACIÓN Y LIMPIEZA
-- =====================================================
-- Este script verifica qué tablas existen antes de operar

-- =====================================================
-- PASO 1: VERIFICAR TABLAS EXISTENTES
-- =====================================================
SHOW TABLES;

-- =====================================================
-- PASO 2: DESHABILITAR VERIFICACIONES FK
-- =====================================================
SET FOREIGN_KEY_CHECKS = 0;

-- =====================================================
-- PASO 3: ELIMINAR TABLAS DE RBAC
-- =====================================================
DROP TABLE IF EXISTS `auth_assignment`;
DROP TABLE IF EXISTS `auth_item_child`;
DROP TABLE IF EXISTS `auth_item`;
DROP TABLE IF EXISTS `auth_rule`;

-- =====================================================
-- PASO 4: ELIMINAR TABLAS NO CONECTADAS
-- =====================================================
DROP TABLE IF EXISTS `becas`;
DROP TABLE IF EXISTS `tipos_becas`;
DROP TABLE IF EXISTS `criterios_elegibilidad`;

-- =====================================================
-- PASO 5: ELIMINAR TABLAS ADICIONALES
-- =====================================================
DROP TABLE IF EXISTS `configuraciones`;
DROP TABLE IF EXISTS `migration`;
DROP TABLE IF EXISTS `observaciones`;

-- =====================================================
-- PASO 6: LIMPIAR DATOS (SOLO SI LAS TABLAS EXISTEN)
-- =====================================================
-- Limpiar roles (si existe la tabla)
DELETE FROM `roles` WHERE `id` IN (2, 4, 5, 6);

-- Limpiar usuarios (si existe la tabla)
DELETE FROM `usuarios` WHERE `rol_id` IN (2, 4, 5, 6);

-- =====================================================
-- PASO 7: LIMPIAR DATOS HUÉRFANOS (SOLO SI LAS TABLAS EXISTEN)
-- =====================================================
-- Eliminar notificaciones huérfanas (si existen las tablas)
DELETE n FROM `notificaciones` n 
LEFT JOIN `usuarios` u ON n.usuario_id = u.id 
WHERE u.id IS NULL;

DELETE n FROM `notificaciones` n 
LEFT JOIN `solicitudes_becas` s ON n.solicitud_id = s.id 
WHERE s.id IS NULL;

-- Eliminar documentos huérfanos (si existen las tablas)
DELETE d FROM `documentos_solicitud` d 
LEFT JOIN `solicitudes_becas` s ON d.solicitud_id = s.id 
WHERE s.id IS NULL;

-- Eliminar solicitudes huérfanas (si existen las tablas)
DELETE sb FROM `solicitudes_becas` sb 
LEFT JOIN `usuarios` u ON sb.estudiante_id = u.id 
WHERE u.id IS NULL;

-- Eliminar historial académico huérfano (si existen las tablas)
DELETE ha FROM `historial_academico` ha 
LEFT JOIN `usuarios` u ON ha.estudiante_id = u.id 
WHERE u.id IS NULL;

-- =====================================================
-- PASO 8: CREAR FOREIGN KEYS (SOLO SI LAS TABLAS EXISTEN)
-- =====================================================
-- Intentar agregar FK a usuarios (ignorar si ya existe o tabla no existe)
ALTER TABLE `usuarios` 
ADD CONSTRAINT `fk_usuario_rol` 
FOREIGN KEY (`rol_id`) REFERENCES `roles`(`id`) ON DELETE RESTRICT;

-- Intentar agregar FK a solicitudes_becas (ignorar si ya existe o tabla no existe)
ALTER TABLE `solicitudes_becas` 
ADD CONSTRAINT `fk_solicitud_usuario` 
FOREIGN KEY (`estudiante_id`) REFERENCES `usuarios`(`id`) ON DELETE CASCADE;

-- Intentar agregar FK a documentos_solicitud (ignorar si ya existe o tabla no existe)
ALTER TABLE `documentos_solicitud` 
ADD CONSTRAINT `fk_documento_solicitud` 
FOREIGN KEY (`solicitud_id`) REFERENCES `solicitudes_becas`(`id`) ON DELETE CASCADE;

-- Intentar agregar FK a notificaciones (ignorar si ya existen o tabla no existe)
ALTER TABLE `notificaciones` 
ADD CONSTRAINT `fk_notificacion_solicitud` 
FOREIGN KEY (`solicitud_id`) REFERENCES `solicitudes_becas`(`id`) ON DELETE CASCADE;

ALTER TABLE `notificaciones` 
ADD CONSTRAINT `fk_notificacion_usuario` 
FOREIGN KEY (`usuario_id`) REFERENCES `usuarios`(`id`) ON DELETE CASCADE;

-- Intentar agregar FK a historial_academico (ignorar si ya existe o tabla no existe)
ALTER TABLE `historial_academico` 
ADD CONSTRAINT `fk_historial_usuario` 
FOREIGN KEY (`estudiante_id`) REFERENCES `usuarios`(`id`) ON DELETE CASCADE;

-- =====================================================
-- PASO 9: REHABILITAR VERIFICACIONES FK
-- =====================================================
SET FOREIGN_KEY_CHECKS = 1;

-- =====================================================
-- PASO 10: VERIFICAR RESULTADOS FINALES
-- =====================================================
-- Mostrar tablas restantes
SHOW TABLES;

-- Mostrar foreign keys creadas
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

-- Contar registros en tablas (solo si existen)
SELECT 'usuarios' as tabla, COUNT(*) as total FROM `usuarios` WHERE `rol_id` IN (1, 3)
UNION ALL
SELECT 'solicitudes_becas' as tabla, COUNT(*) as total FROM `solicitudes_becas`
UNION ALL
SELECT 'roles' as tabla, COUNT(*) as total FROM `roles`;

-- Mostrar roles restantes
SELECT * FROM `roles`;

-- =====================================================
-- PASO 11: OPTIMIZAR TABLAS (SOLO SI EXISTEN)
-- =====================================================
OPTIMIZE TABLE `usuarios`;
OPTIMIZE TABLE `solicitudes_becas`;
OPTIMIZE TABLE `documentos_solicitud`;
OPTIMIZE TABLE `notificaciones`;
OPTIMIZE TABLE `historial_academico`;






