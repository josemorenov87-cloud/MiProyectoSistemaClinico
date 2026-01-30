<?php
namespace App\Models;

use mysqli;

class Tratamiento {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function insertar($id_atencion, $id_medicamento, $dosis, $valor_frecuencia, $dias_tratamiento, $total, $id_historial = null) {
        $stmt = $this->db->prepare("INSERT INTO tb_tratamiento (id_atencion, id_medicamento, dosis, valor_frecuencia, dias_tratamiento, total, id_historial) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('iiiiiii', $id_atencion, $id_medicamento, $dosis, $valor_frecuencia, $dias_tratamiento, $total, $id_historial);
        if ($stmt->execute()) {
            return $this->db->insert_id;
        }
        return false;
    }
}
