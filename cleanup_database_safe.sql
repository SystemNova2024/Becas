-- =====================================================
-- SCRIPT DE LIMPIEZA SEGURO - MÓDULO DE BECAS
-- =====================================================
-- Este script elimina tablas no utilizadas de forma segura
-- HACER BACKUP ANTES DE EJECUTAR

-- =====================================================
-- PASO 1: DESHABILITAR VERIFICACIONES DE FK TEMPORALMENTE
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
-- PASO 3: ELIMINAR TABLA DE BECAS (NO CONECTADA)
-- =====================================================
DROP TABLE IF EXISTS `becas`;

-- =====================================================
-- PASO 4: ELIMINAR TABLAS VACÍAS/NO UTILIZADAS
-- =====================================================
DROP TABLE IF EXISTS `criterios_elegibilidad`;
DROP TABLE IF EXISTS `tipos_becas`;
DROP TABLE IF EXISTS `configuraciones`;
DROP TABLE IF EXISTS `migration`;
DROP TABLE IF EXISTS `observaciones`;

-- =====================================================
-- PASO 5: LIMPIAR DATOS DE ROLES
-- =====================================================
-- Eliminar roles obsoletos
DELETE FROM `roles` WHERE `id` IN (2, 4, 5, 6);

-- =====================================================
-- PASO 6: LIMPIAR USUARIOS CON ROLES ELIMINADOS
-- =====================================================
-- Eliminar usuarios que tenían roles eliminados
DELETE FROM `usuarios` WHERE `rol_id` IN (2, 4, 5, 6);

-- =====================================================
-- PASO 7: LIMPIAR REFERENCIAS HUÉRFANAS
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
-- PASO 8: REHABILITAR VERIFICACIONES DE FK
-- =====================================================
SET FOREIGN_KEY_CHECKS = 1;

-- =====================================================
-- PASO 9: VERIFICAR RESULTADOS
-- =====================================================
-- Mostrar tablas restantes
SHOW TABLES;

-- Contar usuarios válidos
SELECT COUNT(*) as usuarios_validos FROM `usuarios` WHERE `rol_id` IN (1, 3);

-- Contar solicitudes activas
SELECT COUNT(*) as solicitudes_activas FROM `solicitudes_becas`;

-- Mostrar roles restantes
SELECT * FROM `roles`;

-- =====================================================
-- PASO 10: OPTIMIZAR TABLAS RESTANTES
-- =====================================================
OPTIMIZE TABLE `usuarios`;
OPTIMIZE TABLE `solicitudes_becas`;
OPTIMIZE TABLE `documentos_solicitud`;
OPTIMIZE TABLE `notificaciones`;
OPTIMIZE TABLE `historial_academico`;

-- =====================================================
-- RESUMEN FINAL
-- =====================================================
-- ✅ Eliminadas tablas RBAC: auth_assignment, auth_item, auth_item_child, auth_rule
-- ✅ Eliminada tabla: becas (no conectada)
-- ✅ Eliminadas tablas: criterios_elegibilidad, tipos_becas, configuraciones, migration, observaciones
-- ✅ Limpiados usuarios con roles obsoletos
-- ✅ Limpiadas referencias huérfanas
-- ✅ Optimizadas tablas restantes

-- =====================================================
-- TABLAS QUE QUEDAN ACTIVAS (SISTEMA MÍNIMO)
-- =====================================================
-- ✅ usuarios (solo roles 1 y 3)
-- ✅ roles (solo Coordinador y Estudiante)
-- ✅ solicitudes_becas
-- ✅ documentos_solicitud
-- ✅ notificaciones
-- ✅ historial_academico

COMMIT;
