<?php
/**
 * Controlador de Ubigeo
 * Maneja los endpoints AJAX para obtener departamentos, provincias y distritos
 */

namespace App\Controllers;

class UbigeoController {
    private $db;

    public function __construct() {
        global $mysqli;
        $this->db = $mysqli;
    }

    /**
     * Obtener todos los departamentos
     */
    public function departamentos() {
        $sql = "SELECT id_departamento, nom_departamento FROM tb_departamento ORDER BY nom_departamento";
        $result = $this->db->query($sql);
        
        $departamentos = [];
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $departamentos[] = $row;
            }
        }
        
        header('Content-Type: application/json');
        echo json_encode($departamentos);
    }

    /**
     * Obtener provincias por departamento
     */
    public function provincias() {
        $idDepartamento = $_GET['id_departamento'] ?? 0;
        
        if ($idDepartamento > 0) {
            $sql = "SELECT id_provincia, nom_provincia FROM tb_provincia WHERE id_departamento = ? ORDER BY nom_provincia";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param('i', $idDepartamento);
            $stmt->execute();
            $result = $stmt->get_result();
            
            $provincias = [];
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $provincias[] = $row;
                }
            }
            
            $stmt->close();
            header('Content-Type: application/json');
            echo json_encode($provincias);
        } else {
            echo json_encode([]);
        }
    }

    /**
     * Obtener distritos por provincia
     */
    public function distritos() {
        $idProvincia = $_GET['id_provincia'] ?? 0;
        
        if ($idProvincia > 0) {
            $sql = "SELECT id_distrito, nom_distrito FROM tb_distrito WHERE id_provincia = ? ORDER BY nom_distrito";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param('i', $idProvincia);
            $stmt->execute();
            $result = $stmt->get_result();
            
            $distritos = [];
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $distritos[] = $row;
                }
            }
            
            $stmt->close();
            header('Content-Type: application/json');
            echo json_encode($distritos);
        } else {
            echo json_encode([]);
        }
    }
}
