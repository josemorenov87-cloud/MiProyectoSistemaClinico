-- Agregar campo fecha_registro a tabla tb_triaje
ALTER TABLE tb_triaje ADD COLUMN fecha_registro DATETIME DEFAULT CURRENT_TIMESTAMP AFTER interp;

-- Opcional: Si necesitas cambiar id_cita a NULL si aún no lo es
ALTER TABLE tb_triaje MODIFY COLUMN id_cita INT(11) NULL;
