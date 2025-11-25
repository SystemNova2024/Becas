-- =====================================================
-- SCRIPT DE LIMPIEZA DE BASE DE DATOS - MÓDULO DE BECAS
-- =====================================================
-- Este script elimina tablas no utilizadas y limpia la base de datos
-- Ejecutar con precaución - HACER BACKUP ANTES DE EJECUTAR

-- =====================================================
-- 1. ELIMINAR TABLAS DE RBAC (YA NO SE USAN)
-- =====================================================
-- IMPORTANTE: Eliminar en orden correcto para evitar errores de FK

-- Primero eliminar las tablas que dependen de auth_item
DROP TABLE IF EXISTS `auth_assignment`;

-- Luego eliminar las tablas que dependen de auth_item
DROP TABLE IF EXISTS `auth_item_child`;

-- Después eliminar auth_item (tabla padre)
DROP TABLE IF EXISTS `auth_item`;

-- Finalmente eliminar auth_rule
DROP TABLE IF EXISTS `auth_rule`;

-- =====================================================
-- 2. ELIMINAR TABLA DE BECAS (NO CONECTADA)
-- =====================================================

-- Eliminar tabla de becas (no está conectada con solicitudes)
DROP TABLE IF EXISTS `becas`;

-- =====================================================
-- 3. ELIMINAR TABLAS NO UTILIZADAS
-- =====================================================

-- Eliminar tabla de criterios de elegibilidad (vacía y no usada)
DROP TABLE IF EXISTS `criterios_elegibilidad`;

-- Eliminar tabla de tipos de becas (vacía y no usada)
DROP TABLE IF EXISTS `tipos_becas`;

-- =====================================================
-- 4. LIMPIAR TABLA DE ROLES
-- =====================================================

-- Eliminar roles que ya no se usan
DELETE FROM `roles` WHERE `id` IN (2, 4, 5, 6);

-- Actualizar la tabla roles para que solo tenga los roles necesarios
-- (Opcional: Recrear la tabla roles con solo los roles necesarios)
DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insertar solo los roles que se usan
INSERT INTO `roles` (`id`, `nombre`) VALUES
(1, 'Coordinador de becas'),
(3, 'Estudiante');

-- =====================================================
-- 5. LIMPIAR USUARIOS CON ROLES ELIMINADOS
-- =====================================================

-- Eliminar usuarios que tenían roles eliminados
DELETE FROM `usuarios` WHERE `rol_id` IN (2, 4, 5, 6);

-- =====================================================
-- 6. LIMPIAR SOLICITUDES SIN BECAS VÁLIDAS
-- =====================================================

-- Eliminar solicitudes que referencian becas que ya no existen
-- (Esto es opcional, puedes comentar si quieres mantener los datos)
-- DELETE FROM `solicitudes_becas` WHERE `beca_id` NOT IN (SELECT `id` FROM `becas`);

-- =====================================================
-- 7. LIMPIAR NOTIFICACIONES Y OBSERVACIONES HUÉRFANAS
-- =====================================================

-- Eliminar notificaciones de solicitudes eliminadas
DELETE FROM `notificaciones` WHERE `solicitud_id` NOT IN (SELECT `id` FROM `solicitudes_becas`);

-- Eliminar observaciones de solicitudes eliminadas
DELETE FROM `observaciones` WHERE `solicitud_id` NOT IN (SELECT `id` FROM `solicitudes_becas`);

-- Eliminar documentos de solicitudes eliminadas
DELETE FROM `documentos_solicitud` WHERE `solicitud_id` NOT IN (SELECT `id` FROM `solicitudes_becas`);

-- =====================================================
-- 8. LIMPIAR TABLA DE MIGRACIONES
-- =====================================================

-- Eliminar registros de migración de RBAC
DELETE FROM `migration` WHERE `version` LIKE '%rbac%';

-- =====================================================
-- 9. VERIFICAR INTEGRIDAD DE DATOS
-- =====================================================

-- Verificar que no queden referencias huérfanas
-- (Estas consultas son solo para verificación, no eliminan datos)

-- Verificar usuarios con roles válidos
SELECT COUNT(*) as usuarios_validos FROM `usuarios` WHERE `rol_id` IN (1, 3);

-- Verificar solicitudes activas
SELECT COUNT(*) as solicitudes_activas FROM `solicitudes_becas`;

-- Verificar notificaciones válidas
SELECT COUNT(*) as notificaciones_validas FROM `notificaciones` n 
INNER JOIN `solicitudes_becas` s ON n.solicitud_id = s.id;

-- =====================================================
-- 10. OPTIMIZAR TABLAS
-- =====================================================

-- Optimizar tablas después de las eliminaciones
OPTIMIZE TABLE `usuarios`;
OPTIMIZE TABLE `solicitudes_becas`;
OPTIMIZE TABLE `documentos_solicitud`;
OPTIMIZE TABLE `notificaciones`;
OPTIMIZE TABLE `observaciones`;
OPTIMIZE TABLE `historial_academico`;
OPTIMIZE TABLE `configuraciones`;

-- =====================================================
-- RESUMEN DE CAMBIOS
-- =====================================================
-- ✅ Eliminadas tablas: auth_assignment, auth_item, auth_item_child, auth_rule
-- ✅ Eliminada tabla: becas (no conectada)
-- ✅ Eliminadas tablas: criterios_elegibilidad, tipos_becas (vacías)
-- ✅ Limpiada tabla: roles (solo Coordinador y Estudiante)
-- ✅ Eliminados usuarios con roles obsoletos
-- ✅ Limpiadas referencias huérfanas
-- ✅ Optimizadas tablas restantes

-- =====================================================
-- TABLAS QUE QUEDAN ACTIVAS
-- =====================================================
-- ✅ usuarios (con roles 1 y 3)
-- ✅ roles (solo Coordinador y Estudiante)
-- ✅ solicitudes_becas
-- ✅ documentos_solicitud
-- ✅ notificaciones
-- ✅ observaciones
-- ✅ historial_academico
-- ✅ configuraciones
-- ✅ migration (limpiada)

COMMIT;
