<?php
namespace App\Models;

use mysqli;

class HistorialPaciente {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function insertar($id_paciente, $numdoc_paciente, $codigo_historial) {
        // Verificar si ya existe el codigo_historial
        $check = $this->db->prepare("SELECT id_historial_pac FROM tb_historial_paciente WHERE codigo_historial = ? LIMIT 1");
        $check->bind_param('s', $codigo_historial);
        $check->execute();
        $result = $check->get_result();
        if ($row = $result->fetch_assoc()) {
            // Ya existe, omitir inserción y retornar el id existente
            return $row['id_historial_pac'];
        }
        // Si no existe, insertar
        $stmt = $this->db->prepare("INSERT INTO tb_historial_paciente (id_paciente, numdoc_paciente, codigo_historial) VALUES (?, ?, ?)");
        $stmt->bind_param('iss', $id_paciente, $numdoc_paciente, $codigo_historial);
        if ($stmt->execute()) {
            return $this->db->insert_id;
        }
        return false;
    }

    public function buscarPorPaciente($id_paciente) {
        $stmt = $this->db->prepare("SELECT * FROM tb_historial_paciente WHERE id_paciente = ?");
        $stmt->bind_param('i', $id_paciente);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
}
