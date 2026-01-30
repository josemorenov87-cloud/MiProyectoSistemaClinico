<?php
/**
 * Modelo Paciente
 * Gestiona todas las operaciones de base de datos para pacientes
 */

namespace App\Models;

class Paciente {
    
    private $conn;
    private $table = 'tb_pacientes';
    
    public function __construct() {
        global $mysqli;
        $this->conn = $mysqli;
    }
    
    /**
     * Crear nuevo paciente
     */
    public function create($data) {
        $sql = "INSERT INTO {$this->table} (
            tdoc_paciente, numdoc_paciente, nom_paciente, apepat_paciente, 
            apemat_paciente, fnac_paciente, nac_paciente, lnac_paciente, 
            sex_paciente, email_paciente, tel_paciente, cel_paciente, 
            direc_paciente, depart_paciente, prov_paciente, dist_paciente, 
            ocup_paciente, prof_paciente, nomce_paciente, telce_paciente, 
            emailce_paciente, est_reg_paciente
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $this->conn->prepare($sql);
        
        $stmt->bind_param(
            'ssssssssssssssssssssis',
            $data['tdoc_paciente'],
            $data['numdoc_paciente'],
            $data['nom_paciente'],
            $data['apepat_paciente'],
            $data['apemat_paciente'],
            $data['fnac_paciente'],
            $data['nac_paciente'],
            $data['lnac_paciente'],
            $data['sex_paciente'],
            $data['email_paciente'],
            $data['tel_paciente'],
            $data['cel_paciente'],
            $data['direc_paciente'],
            $data['depart_paciente'],
            $data['prov_paciente'],
            $data['dist_paciente'],
            $data['ocup_paciente'],
            $data['prof_paciente'],
            $data['nomce_paciente'],
            $data['telce_paciente'],
            $data['emailce_paciente'],
            $data['est_reg_paciente']
        );
        
        $result = $stmt->execute();
        $stmt->close();
        
        return $result;
    }
    
    /**
     * Obtener todos los pacientes
     */
    public function getAll() {
        $sql = "SELECT * FROM {$this->table} ORDER BY id_paciente DESC";
        $result = $this->conn->query($sql);
        
        $pacientes = [];
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $pacientes[] = $row;
            }
        }
        
        return $pacientes;
    }
    
    /**
     * Obtener paciente por ID
     */
    public function getById($id) {
        $sql = "SELECT * FROM {$this->table} WHERE id_paciente = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        
        $result = $stmt->get_result();
        $paciente = $result->fetch_assoc();
        $stmt->close();
        
        return $paciente;
    }
    
    /**
     * Buscar paciente por número de documento
     */
    public function getByDocument($numdoc) {
        $sql = "SELECT * FROM {$this->table} WHERE numdoc_paciente = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('s', $numdoc);
        $stmt->execute();
        
        $result = $stmt->get_result();
        $paciente = $result->fetch_assoc();
        $stmt->close();
        
        return $paciente;
    }
    
    /**
     * Actualizar paciente
     */
    public function update($id, $data) {
        $sql = "UPDATE {$this->table} SET 
            tdoc_paciente = ?, numdoc_paciente = ?, nom_paciente = ?, 
            apepat_paciente = ?, apemat_paciente = ?, fnac_paciente = ?, 
            nac_paciente = ?, lnac_paciente = ?, sex_paciente = ?, 
            email_paciente = ?, tel_paciente = ?, cel_paciente = ?, 
            direc_paciente = ?, depart_paciente = ?, prov_paciente = ?, 
            dist_paciente = ?, ocup_paciente = ?, prof_paciente = ?, 
            nomce_paciente = ?, telce_paciente = ?, emailce_paciente = ?
        WHERE id_paciente = ?";
        
        $stmt = $this->conn->prepare($sql);
        
        $stmt->bind_param(
            'sssssssssssssssssssssi',
            $data['tdoc_paciente'],
            $data['numdoc_paciente'],
            $data['nom_paciente'],
            $data['apepat_paciente'],
            $data['apemat_paciente'],
            $data['fnac_paciente'],
            $data['nac_paciente'],
            $data['lnac_paciente'],
            $data['sex_paciente'],
            $data['email_paciente'],
            $data['tel_paciente'],
            $data['cel_paciente'],
            $data['direc_paciente'],
            $data['depart_paciente'],
            $data['prov_paciente'],
            $data['dist_paciente'],
            $data['ocup_paciente'],
            $data['prof_paciente'],
            $data['nomce_paciente'],
            $data['telce_paciente'],
            $data['emailce_paciente'],
            $id
        );
        
        $result = $stmt->execute();
        $stmt->close();
        
        return $result;
    }
    
    /**
     * Eliminar paciente (lógico)
     */
    public function delete($id) {
        $sql = "UPDATE {$this->table} SET est_reg_paciente = 0 WHERE id_paciente = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $id);
        
        $result = $stmt->execute();
        $stmt->close();
        
        return $result;
    }

    /**
     * Obtener historial existente por paciente o documento
     */
    public function getHistorialByPaciente(?int $idPaciente, ?string $numdoc) {
        if (empty($idPaciente) && empty($numdoc)) {
            return null;
        }

        $sql = "SELECT * FROM tb_historial_paciente WHERE 1=0";
        $params = [];
        $types = '';

        if (!empty($idPaciente)) {
            $sql .= " OR id_paciente = ?";
            $params[] = $idPaciente;
            $types .= 'i';
        }
        if (!empty($numdoc)) {
            $sql .= " OR numdoc_paciente = ?";
            $params[] = $numdoc;
            $types .= 's';
        }
        $sql .= " ORDER BY id_historial_pac DESC LIMIT 1";

        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            return null;
        }

        if (!empty($params)) {
            $stmt->bind_param($types, ...$params);
        }

        $stmt->execute();
        $result = $stmt->get_result();
        $historial = $result ? $result->fetch_assoc() : null;
        $stmt->close();

        return $historial;
    }
}
