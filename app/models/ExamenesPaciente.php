<?php
namespace App\Models;

use mysqli;

class ExamenesPaciente {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function insertar($id_historial, $id_tipexam, $observacion) {
        $stmt = $this->db->prepare("INSERT INTO tb_examenes_paciente (id_historial, id_tipexam, observacion) VALUES (?, ?, ?)");
        $stmt->bind_param('iis', $id_historial, $id_tipexam, $observacion);
        if ($stmt->execute()) {
            return $this->db->insert_id;
        }
        return false;
    }
}
