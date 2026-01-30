<?php
/**
 * Modelo Médico
 * Gestiona todas las operaciones de base de datos para médicos
 */

namespace App\Models;

class Medico {
    
    private $conn;
    private $table = 'tb_medicos';
    
    public function __construct() {
        global $mysqli;
        $this->conn = $mysqli;
    }
    
    /**
     * Crear nuevo médico
     */
    public function create($data) {
        // Validar si el numdoc_medico ya existe
        $sqlCheckDoc = "SELECT COUNT(*) as count FROM {$this->table} WHERE numdoc_medico = ?";
        $stmtCheckDoc = $this->conn->prepare($sqlCheckDoc);
        $stmtCheckDoc->bind_param('s', $data['numdoc_medico']);
        $stmtCheckDoc->execute();
        $resultDoc = $stmtCheckDoc->get_result();
        $rowDoc = $resultDoc->fetch_assoc();
        $stmtCheckDoc->close();
        
        if ($rowDoc['count'] > 0) {
            return "El número de documento ya está registrado.";
        }
        
        // Validar si el numcoleg_medico ya existe
        $sqlCheckColeg = "SELECT COUNT(*) as count FROM {$this->table} WHERE numcoleg_medico = ?";
        $stmtCheckColeg = $this->conn->prepare($sqlCheckColeg);
        $stmtCheckColeg->bind_param('s', $data['numcoleg_medico']);
        $stmtCheckColeg->execute();
        $resultColeg = $stmtCheckColeg->get_result();
        $rowColeg = $resultColeg->fetch_assoc();
        $stmtCheckColeg->close();
        
        if ($rowColeg['count'] > 0) {
            return "El número de colegiatura ya está registrado.";
        }
        
        // Insertar nuevo médico
        $sql = "INSERT INTO {$this->table} (
            tdoc_medico, numdoc_medico, fnac_medico, nom_medico, apepat_medico, 
            apemat_medico, nac_medico, lnac_medico, sex_medico, email_medico, 
            tel_medico, cel_medico, direc_medico, depart_medico, prov_medico, 
            dist_medico, esp_medico, tcoleg_medico, numcoleg_medico, 
            habcoleg_medico, status_medico
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $this->conn->prepare($sql);
        
        $stmt->bind_param(
            'isssssssssssiiiisssii',
            $data['tdoc_medico'],
            $data['numdoc_medico'],
            $data['fnac_medico'],
            $data['nom_medico'],
            $data['apepat_medico'],
            $data['apemat_medico'],
            $data['nac_medico'],
            $data['lnac_medico'],
            $data['sex_medico'],
            $data['email_medico'],
            $data['tel_medico'],
            $data['cel_medico'],
            $data['direc_medico'],
            $data['depart_medico'],
            $data['prov_medico'],
            $data['dist_medico'],
            $data['esp_medico'],
            $data['tcoleg_medico'],
            $data['numcoleg_medico'],
            $data['habcoleg_medico'],
            $data['status_medico']
        );
        
        $result = $stmt->execute();
        $stmt->close();
        
        return $result;
    }
    
    /**
     * Obtener todos los médicos
     */
    public function getAll() {
        $sql = "SELECT m.*, e.nom_especialidad 
                FROM {$this->table} m 
                LEFT JOIN tb_especialidades e ON m.esp_medico = e.id_especialidad 
                WHERE m.status_medico = 1 
                ORDER BY m.id_medico DESC";
        
        $result = $this->conn->query($sql);
        
        $medicos = [];
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $medicos[] = $row;
            }
        }
        
        return $medicos;
    }
    
    /**
     * Obtener médico por ID
     */
    public function getById($id) {
        $sql = "SELECT m.*, e.nom_especialidad 
                FROM {$this->table} m 
                LEFT JOIN tb_especialidades e ON m.esp_medico = e.id_especialidad 
                WHERE m.id_medico = ?";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        
        $result = $stmt->get_result();
        $medico = $result->fetch_assoc();
        $stmt->close();
        
        return $medico;
    }
    
    /**
     * Buscar médico por número de documento
     */
    public function getByDocument($numdoc) {
        $sql = "SELECT * FROM {$this->table} WHERE numdoc_medico = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('s', $numdoc);
        $stmt->execute();
        
        $result = $stmt->get_result();
        $medico = $result->fetch_assoc();
        $stmt->close();
        
        return $medico;
    }
    
    /**
     * Obtener médicos por especialidad
     */
    public function getByEspecialidad($idEspecialidad) {
        $sql = "SELECT * FROM {$this->table} 
                WHERE esp_medico = ? AND status_medico = 1 
                ORDER BY nom_medico, apepat_medico";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $idEspecialidad);
        $stmt->execute();
        
        $result = $stmt->get_result();
        $medicos = [];
        
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $medicos[] = $row;
            }
        }
        
        $stmt->close();
        return $medicos;
    }
    
    /**
     * Actualizar médico
     */
    public function update($id, $data) {
        $sql = "UPDATE {$this->table} SET 
            tdoc_medico = ?, numdoc_medico = ?, fnac_medico = ?, nom_medico = ?, 
            apepat_medico = ?, apemat_medico = ?, nac_medico = ?, lnac_medico = ?, 
            sex_medico = ?, email_medico = ?, tel_medico = ?, cel_medico = ?, 
            direc_medico = ?, depart_medico = ?, prov_medico = ?, dist_medico = ?, 
            esp_medico = ?, tcoleg_medico = ?, numcoleg_medico = ?, habcoleg_medico = ?
        WHERE id_medico = ?";
        
        $stmt = $this->conn->prepare($sql);
        
        $stmt->bind_param(
            'isssssssssssiisisssi',
            $data['tdoc_medico'],
            $data['numdoc_medico'],
            $data['fnac_medico'],
            $data['nom_medico'],
            $data['apepat_medico'],
            $data['apemat_medico'],
            $data['nac_medico'],
            $data['lnac_medico'],
            $data['sex_medico'],
            $data['email_medico'],
            $data['tel_medico'],
            $data['cel_medico'],
            $data['direc_medico'],
            $data['depart_medico'],
            $data['prov_medico'],
            $data['dist_medico'],
            $data['esp_medico'],
            $data['tcoleg_medico'],
            $data['numcoleg_medico'],
            $data['habcoleg_medico'],
            $id
        );
        
        $result = $stmt->execute();
        $stmt->close();
        
        return $result;
    }
    
    /**
     * Eliminar médico (lógico)
     */
    public function delete($id) {
        $sql = "UPDATE {$this->table} SET status_medico = 0 WHERE id_medico = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $id);
        
        $result = $stmt->execute();
        $stmt->close();
        
        return $result;
    }
}
