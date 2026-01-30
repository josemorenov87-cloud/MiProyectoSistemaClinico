<?php
namespace App\Models;

use mysqli;

class HistorialDetalle {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function insertar($id_historial_pac, $id_cita, $id_triaje, $id_atencion, $id_medico, $id_especialidad, $id_cie10, $motivo_consulta, $desc_diagnostico, $desc_antecedentes, $fecha_atencion, $estado) {
        $stmt = $this->db->prepare("INSERT INTO tb_historial_detalle (id_historial_pac, id_cita, id_triaje, id_atencion, id_medico, id_especialidad, id_cie10, motivo_consulta, desc_diagnostico, desc_antecedentes, fecha_atencion, estado) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('iiiiiiissssi', $id_historial_pac, $id_cita, $id_triaje, $id_atencion, $id_medico, $id_especialidad, $id_cie10, $motivo_consulta, $desc_diagnostico, $desc_antecedentes, $fecha_atencion, $estado);
        if ($stmt->execute()) {
            return $this->db->insert_id;
        }
        return false;
    }
}
