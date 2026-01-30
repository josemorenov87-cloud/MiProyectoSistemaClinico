<?php
namespace App\Models;

use mysqli;

class HistorialDiag {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function insertar($id_historial, $id_cie10, $es_principal, $nota) {
        $stmt = $this->db->prepare("INSERT INTO tb_historial_diag (id_historial, id_cie10, es_principal, nota) VALUES (?, ?, ?, ?)");
        $stmt->bind_param('iiis', $id_historial, $id_cie10, $es_principal, $nota);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
