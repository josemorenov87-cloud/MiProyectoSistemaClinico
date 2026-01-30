<?php
require_once 'model_paciente.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $model = new ModelPaciente();
    $result = $model->registrarPaciente([
        'tdoc_paciente' => $_POST['tipo_doc'] ?? '',
        'numdoc_paciente' => $_POST['nro_doc'] ?? '',
        'nom_paciente' => $_POST['nombres'] ?? '',
        'apepat_paciente' => $_POST['apellido_paterno'] ?? '',
        'apemat_paciente' => $_POST['apellido_materno'] ?? '',
        'fnac_paciente' => $_POST['fecha_nac'] ?? '',
        'nac_paciente' => $_POST['nacionalidad'] ?? '',
        'lnac_paciente' => $_POST['lugar_nacimiento'] ?? '',
        'sex_paciente' => $_POST['sexo'] ?? '',
        'email_paciente' => $_POST['correo'] ?? '',
        'tel_paciente' => $_POST['telefono_fijo'] ?? '',
        'cel_paciente' => $_POST['celular'] ?? '',
        'direc_paciente' => $_POST['direccion'] ?? '',
        'depart_paciente' => $_POST['departamento_id'] ?? '',
        'prov_paciente' => $_POST['provincia_id'] ?? '',
        'dist_paciente' => $_POST['distrito_id'] ?? '',
        'ocup_paciente' => $_POST['ocupacion'] ?? '',
        'prof_paciente' => $_POST['profesion'] ?? '',
        'nomce_paciente' => $_POST['contacto_nombre'] ?? '',
        'telce_paciente' => $_POST['contacto_telefono'] ?? '',
        'emailce_paciente' => $_POST['contacto_correo'] ?? '',
        'est_reg_paciente' => 2
    ]);

    if ($result) {
        echo json_encode(['success' => true, 'message' => 'Paciente registrado correctamente']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al registrar paciente']);
    }
    exit;
}
