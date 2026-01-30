<?php
require_once __DIR__ . '/../app/conexion.php'; // Ruta absoluta y correcta

if (!function_exists('conectar')) {
    function conectar() {
        $conn = new mysqli('127.0.0.1', 'root', '', 'centro_clinico', 3307);
        if ($conn->connect_error) {
            die('Error de conexión: ' . $conn->connect_error);
        }
        return $conn;
    }
}

class MedicoModel {
    public static function registrarMedico($data) {
            $conn = conectar();
            // Validar si el numdoc_medico ya existe
            $sql_check_doc = "SELECT COUNT(*) FROM tb_medicos WHERE numdoc_medico = ?";
            $stmt_check_doc = $conn->prepare($sql_check_doc);
            $stmt_check_doc->bind_param('s', $data['numdoc_medico']);
            $stmt_check_doc->execute();
            $stmt_check_doc->bind_result($count_doc);
            $stmt_check_doc->fetch();
            $stmt_check_doc->close();

            if ($count_doc > 0) {
                $conn->close();
                return "El número de documento ya está registrado.";
            }

            // Validar si el numcoleg_medico ya existe
            $sql_check_coleg = "SELECT COUNT(*) FROM tb_medicos WHERE numcoleg_medico = ?";
            $stmt_check_coleg = $conn->prepare($sql_check_coleg);
            $stmt_check_coleg->bind_param('s', $data['numcoleg_medico']);
            $stmt_check_coleg->execute();
            $stmt_check_coleg->bind_result($count_coleg);
            $stmt_check_coleg->fetch();
            $stmt_check_coleg->close();

            if ($count_coleg > 0) {
                $conn->close();
                return "El número de colegiatura ya está registrado.";
            }

            $sql = "INSERT INTO tb_medicos (
                tdoc_medico, numdoc_medico, fnac_medico, nom_medico, apepat_medico, apemat_medico, nac_medico, lnac_medico, sex_medico, email_medico, tel_medico, cel_medico, direc_medico, depart_medico, prov_medico, dist_medico, esp_medico, tcoleg_medico, numcoleg_medico, habcoleg_medico, status_medico
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param(
                'issssssssssssssssssis',
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
            $conn->close();
            return $result;
    }
}
