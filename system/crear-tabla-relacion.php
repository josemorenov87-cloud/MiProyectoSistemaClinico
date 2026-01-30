<?php
// Script para crear/actualizar la estructura de relación médico-especialidad
header('Content-Type: application/json; charset=utf-8');
require_once 'app/conexion.php';

// Verificar si la tabla tb_medico_especialidad existe
$checkTableSQL = "SHOW TABLES LIKE 'tb_medico_especialidad'";
$result = $conn->query($checkTableSQL);

if ($result->num_rows == 0) {
    // Crear tabla de relación muchos-a-muchos
    $createTableSQL = "
    CREATE TABLE tb_medico_especialidad (
        id_rel INT PRIMARY KEY AUTO_INCREMENT,
        id_medico INT NOT NULL,
        id_especialidad INT NOT NULL,
        fecha_asignacion DATETIME DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (id_medico) REFERENCES tb_medicos(id_medico) ON DELETE CASCADE,
        FOREIGN KEY (id_especialidad) REFERENCES tb_especialidades(id_especialidad) ON DELETE CASCADE,
        UNIQUE KEY unique_med_esp (id_medico, id_especialidad)
    )
    ";
    
    if ($conn->query($createTableSQL) === TRUE) {
        echo json_encode(['success' => true, 'message' => 'Tabla tb_medico_especialidad creada correctamente']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al crear tabla: ' . $conn->error]);
    }
} else {
    echo json_encode(['success' => true, 'message' => 'La tabla tb_medico_especialidad ya existe']);
}

// Si el campo esp_medico existe en tb_medicos, hacer migración de datos
$checkColumnSQL = "SHOW COLUMNS FROM tb_medicos LIKE 'esp_medico'";
$resultColumn = $conn->query($checkColumnSQL);

if ($resultColumn->num_rows > 0) {
    // Migrar datos: insertar en la nueva tabla
    $migrateSQL = "
    INSERT IGNORE INTO tb_medico_especialidad (id_medico, id_especialidad)
    SELECT id_medico, esp_medico FROM tb_medicos WHERE esp_medico IS NOT NULL AND esp_medico > 0
    ";
    
    if ($conn->query($migrateSQL) === TRUE) {
        echo json_encode(['success' => true, 'message' => 'Datos migrados correctamente']);
    }
}

$conn->close();
?>
