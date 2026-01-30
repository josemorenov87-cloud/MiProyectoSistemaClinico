<?php
namespace App\Models;

require_once __DIR__ . '/../conexion.php';

class PacienteHelper {
    public static function getIdPacientePorDocumento($numdoc) {
        global $mysqli;
        $stmt = $mysqli->prepare("SELECT id_paciente FROM tb_pacientes WHERE numdoc_paciente = ? LIMIT 1");
        $stmt->bind_param('s', $numdoc);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            return $row['id_paciente'];
        }
        return null;
    }
}
