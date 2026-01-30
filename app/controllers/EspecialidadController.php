<?php
/**
 * Controlador de Especialidades
 */
namespace App\Controllers;

class EspecialidadController {
    private $db;

    public function __construct() {
        global $mysqli;
        $this->db = $mysqli;
    }

    public function index() {
        header('Content-Type: application/json');
        
        $sql = "SELECT id_especialidad, nom_especialidad FROM tb_especialidades ORDER BY nom_especialidad";
        $result = $this->db->query($sql);
        $rows = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) { 
                $rows[] = $row; 
            }
        }
        echo json_encode($rows);
    }
}
echo json_encode($rows);
