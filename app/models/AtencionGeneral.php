<?php
namespace App\Models;

use mysqli;

class AtencionGeneral {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function insertar($id_triaje, $id_paciente, $id_cie10, $desc_diagnostico, $desc_antecedentes) {
        $stmt = $this->db->prepare("INSERT INTO tb_atengeneral (id_triaje, id_paciente, id_cie10, desc_diagnostico, desc_antecedentes) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param('iiiss', $id_triaje, $id_paciente, $id_cie10, $desc_diagnostico, $desc_antecedentes);
        if ($stmt->execute()) {
            return $this->db->insert_id;
        }
        return false;
    }
}
