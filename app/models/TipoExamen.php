<?php
namespace App\Models;

class TipoExamen {
    private $conn;
    private $table = 'tb_tipexam';

    public function __construct() {
        global $mysqli;
        $this->conn = $mysqli;
    }

    public function getAll() {
        $sql = "SELECT * FROM {$this->table}";
        $stmt = $this->conn->prepare($sql);
        
        if (!$stmt) {
            return [];
        }

        $stmt->execute();
        $rs = $stmt->get_result();
        $data = [];
        
        while ($row = $rs->fetch_assoc()) {
            $data[] = $row;
        }
        
        $stmt->close();
        return $data;
    }

    public function getById($id) {
        $sql = "SELECT * FROM {$this->table} WHERE id_tipexam = ?";
        $stmt = $this->conn->prepare($sql);
        
        if (!$stmt) {
            return null;
        }

        $stmt->bind_param('i', $id);
        $stmt->execute();
        $rs = $stmt->get_result();
        $data = $rs->fetch_assoc();
        $stmt->close();
        
        return $data;
    }
}
