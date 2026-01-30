-- ============================================
-- TABLA INTERMEDIA: RELACIÓN MÉDICO-ESPECIALIDAD
-- ============================================

-- Crear tabla de relación muchos-a-muchos
CREATE TABLE IF NOT EXISTS tb_medico_especialidad (
    id_rel INT PRIMARY KEY AUTO_INCREMENT,
    id_medico INT NOT NULL,
    id_especialidad INT NOT NULL,
    fecha_asignacion DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_medico) REFERENCES tb_medicos(id_medico) ON DELETE CASCADE,
    FOREIGN KEY (id_especialidad) REFERENCES tb_especialidades(id_especialidad) ON DELETE CASCADE,
    UNIQUE KEY unique_med_esp (id_medico, id_especialidad)
);

-- ============================================
-- DATOS DE EJEMPLO (OPCIONAL)
-- ============================================

-- Asignar especialidades a médicos existentes
-- Dr. Alba Romero (id_medico = 1)
INSERT INTO tb_medico_especialidad (id_medico, id_especialidad) VALUES (1, 13);  -- Ginecología y Obstetricia

-- Dr. Daniel Villamizar (id_medico = 2)
INSERT INTO tb_medico_especialidad (id_medico, id_especialidad) VALUES (2, 36);  -- Psiquiatría

-- Dr. José Zambrano (id_medico = 3)
INSERT INTO tb_medico_especialidad (id_medico, id_especialidad) VALUES (3, 21);  -- Medicina Interna

-- Dr. Wilder Galindo (id_medico = 4)
INSERT INTO tb_medico_especialidad (id_medico, id_especialidad) VALUES (4, 36);  -- Psiquiatría

-- ============================================
-- CONSULTAS DE VERIFICACIÓN
-- ============================================

-- Ver la estructura de la tabla
-- DESC tb_medico_especialidad;

-- Ver todos los médicos con sus especialidades asignadas
-- SELECT 
--   m.id_medico,
--   CONCAT(m.nom_medico, ' ', m.apepat_medico) AS medico,
--   GROUP_CONCAT(e.desc_especialidad SEPARATOR ', ') AS especialidades
-- FROM tb_medicos m
-- LEFT JOIN tb_medico_especialidad me ON m.id_medico = me.id_medico
-- LEFT JOIN tb_especialidades e ON me.id_especialidad = e.id_especialidad
-- GROUP BY m.id_medico
-- ORDER BY m.nom_medico;

-- Ver médicos de una especialidad específica (ej: Psiquiatría id=36)
-- SELECT 
--   m.id_medico,
--   CONCAT(m.nom_medico, ' ', m.apepat_medico) AS medico,
--   e.desc_especialidad
-- FROM tb_medicos m
-- INNER JOIN tb_medico_especialidad me ON m.id_medico = me.id_medico
-- INNER JOIN tb_especialidades e ON me.id_especialidad = e.id_especialidad
-- WHERE e.id_especialidad = 36
-- ORDER BY m.nom_medico;

-- Ver especialidades de un médico específico (ej: médico id=1)
-- SELECT 
--   e.id_especialidad,
--   e.desc_especialidad
-- FROM tb_especialidades e
-- INNER JOIN tb_medico_especialidad me ON e.id_especialidad = me.id_especialidad
-- WHERE me.id_medico = 1
-- ORDER BY e.desc_especialidad;
