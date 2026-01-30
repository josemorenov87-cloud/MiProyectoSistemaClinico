<?php
require_once __DIR__ . '/../app/conexion.php';
class ModelPaciente {
    public function registrarPaciente($data) {
        $conn = conectar();
        $stmt = $conn->prepare("INSERT INTO tb_pacientes (
            tdoc_paciente, numdoc_paciente, nom_paciente, apepat_paciente, apemat_paciente, fnac_paciente, nac_paciente, lnac_paciente, sex_paciente, email_paciente, tel_paciente, cel_paciente, direc_paciente, depart_paciente, prov_paciente, dist_paciente, ocup_paciente, prof_paciente, nomce_paciente, telce_paciente, emailce_paciente, est_reg_paciente
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
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
        $conn->close();
        return $result;
    }
}
