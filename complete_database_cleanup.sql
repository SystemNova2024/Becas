-- =====================================================
-- SCRIPT COMPLETO: ARREGLAR Y LIMPIAR BASE DE DATOS
-- =====================================================
-- Este script arregla las conexiones y luego limpia la BD
-- HACER BACKUP ANTES DE EJECUTAR

-- =====================================================
-- PARTE 1: ARREGLAR CONEXIONES DE BASE DE DATOS
-- =====================================================

-- Deshabilitar verificaciones FK temporalmente
SET FOREIGN_KEY_CHECKS = 0;

-- =====================================================
-- ARREGLAR TABLA USUARIOS
-- =====================================================
-- Agregar foreign key a roles
ALTER TABLE `usuarios` 
ADD CONSTRAINT `fk_usuario_rol` 
FOREIGN KEY (`rol_id`) REFERENCES `roles`(`id`) ON DELETE RESTRICT;

-- =====================================================
-- ARREGLAR TABLA SOLICITUDES_BECAS
-- =====================================================
-- Agregar foreign key a usuarios
ALTER TABLE `solicitudes_becas` 
ADD CONSTRAINT `fk_solicitud_usuario` 
FOREIGN KEY (`estudiante_id`) REFERENCES `usuarios`(`id`) ON DELETE CASCADE;

-- =====================================================
-- ARREGLAR TABLA DOCUMENTOS_SOLICITUD
-- =====================================================
-- Agregar foreign key a solicitudes_becas
ALTER TABLE `documentos_solicitud` 
ADD CONSTRAINT `fk_documento_solicitud` 
FOREIGN KEY (`solicitud_id`) REFERENCES `solicitudes_becas`(`id`) ON DELETE CASCADE;

-- =====================================================
-- ARREGLAR TABLA NOTIFICACIONES
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
-- ARREGLAR TABLA OBSERVACIONES
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
-- ARREGLAR TABLA HISTORIAL_ACADEMICO
-- =====================================================
-- Agregar foreign key a usuarios
ALTER TABLE `historial_academico` 
ADD CONSTRAINT `fk_historial_usuario` 
FOREIGN KEY (`estudiante_id`) REFERENCES `usuarios`(`id`) ON DELETE CASCADE;

-- =====================================================
-- PARTE 2: LIMPIAR TABLAS INNECESARIAS
-- =====================================================

-- =====================================================
-- ELIMINAR TABLAS DE RBAC (YA NO SE USAN)
-- =====================================================
DROP TABLE IF EXISTS `auth_assignment`;
DROP TABLE IF EXISTS `auth_item_child`;
DROP TABLE IF EXISTS `auth_item`;
DROP TABLE IF EXISTS `auth_rule`;

-- =====================================================
-- ELIMINAR TABLAS NO CONECTADAS
-- =====================================================
DROP TABLE IF EXISTS `becas`;
DROP TABLE IF EXISTS `tipos_becas`;
DROP TABLE IF EXISTS `criterios_elegibilidad`;

-- =====================================================
-- ELIMINAR TABLAS ADICIONALES
-- =====================================================
DROP TABLE IF EXISTS `configuraciones`;
DROP TABLE IF EXISTS `migration`;
DROP TABLE IF EXISTS `observaciones`;

-- =====================================================
-- LIMPIAR DATOS DE ROLES
-- =====================================================
-- Eliminar roles obsoletos
DELETE FROM `roles` WHERE `id` IN (2, 4, 5, 6);

-- =====================================================
-- LIMPIAR USUARIOS CON ROLES ELIMINADOS
-- =====================================================
-- Eliminar usuarios que tenían roles eliminados
DELETE FROM `usuarios` WHERE `rol_id` IN (2, 4, 5, 6);

-- =====================================================
-- LIMPIAR REFERENCIAS HUÉRFANAS
-- =====================================================
-- Eliminar notificaciones de solicitudes que ya no existen
DELETE n FROM `notificaciones` n 
LEFT JOIN `solicitudes_becas` s ON n.solicitud_id = s.id 
WHERE s.id IS NULL;

-- Eliminar documentos de solicitudes que ya no existen
DELETE d FROM `documentos_solicitud` d 
LEFT JOIN `solicitudes_becas` s ON d.solicitud_id = s.id 
WHERE s.id IS NULL;

-- =====================================================
-- REHABILITAR VERIFICACIONES DE FK
-- =====================================================
SET FOREIGN_KEY_CHECKS = 1;

-- =====================================================
-- VERIFICAR RESULTADOS
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

-- Contar usuarios válidos
SELECT COUNT(*) as usuarios_validos FROM `usuarios` WHERE `rol_id` IN (1, 3);

-- Contar solicitudes activas
SELECT COUNT(*) as solicitudes_activas FROM `solicitudes_becas`;

-- Mostrar roles restantes
SELECT * FROM `roles`;

-- =====================================================
-- OPTIMIZAR TABLAS RESTANTES
-- =====================================================
OPTIMIZE TABLE `usuarios`;
OPTIMIZE TABLE `solicitudes_becas`;
OPTIMIZE TABLE `documentos_solicitud`;
OPTIMIZE TABLE `notificaciones`;
OPTIMIZE TABLE `historial_academico`;

-- =====================================================
-- RESUMEN FINAL
-- =====================================================
-- ✅ CONEXIONES ARREGLADAS:
--    - usuarios.rol_id → roles.id
--    - solicitudes_becas.estudiante_id → usuarios.id
--    - documentos_solicitud.solicitud_id → solicitudes_becas.id
--    - notificaciones.solicitud_id → solicitudes_becas.id
--    - notificaciones.usuario_id → usuarios.id
--    - observaciones.solicitud_id → solicitudes_becas.id
--    - observaciones.usuario_id → usuarios.id
--    - historial_academico.estudiante_id → usuarios.id

-- ✅ TABLAS ELIMINADAS:
--    - auth_assignment, auth_item, auth_item_child, auth_rule
--    - becas, tipos_becas, criterios_elegibilidad
--    - configuraciones, migration, observaciones

-- ✅ TABLAS QUE QUEDAN (SISTEMA MÍNIMO Y CONECTADO):
--    - usuarios (con FK a roles)
--    - roles (solo Coordinador y Estudiante)
--    - solicitudes_becas (con FK a usuarios)
--    - documentos_solicitud (con FK a solicitudes_becas)
--    - notificaciones (con FK a solicitudes_becas y usuarios)
--    - historial_academico (con FK a usuarios)

COMMIT;






