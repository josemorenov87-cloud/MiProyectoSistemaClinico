<?php
require_once 'model_medico.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'tdoc_medico'     => $_POST['tdoc_medico'],
        'numdoc_medico'   => $_POST['numdoc_medico'],
        'fnac_medico'     => $_POST['fnac_medico'],
        'nom_medico'      => $_POST['nom_medico'],
        'apepat_medico'   => $_POST['apepat_medico'],
        'apemat_medico'   => $_POST['apemat_medico'],
        'nac_medico'      => $_POST['nac_medico'],
        'lnac_medico'     => $_POST['lnac_medico'],
        'sex_medico'      => $_POST['sex_medico'],
        'email_medico'    => $_POST['email_medico'],
        'tel_medico'      => $_POST['tel_medico'],
        'cel_medico'      => $_POST['cel_medico'],
        'direc_medico'    => $_POST['direc_medico'],
        'depart_medico'   => intval($_POST['depart_medico']),
        'prov_medico'     => intval($_POST['prov_medico']),
        'dist_medico'     => intval($_POST['dist_medico']),
        'esp_medico'      => intval($_POST['esp_medico']),
        'tcoleg_medico'   => $_POST['tcoleg_medico'],
        'numcoleg_medico' => $_POST['numcoleg_medico'],
        'habcoleg_medico' => $_POST['habcoleg_medico'],
        'status_medico'   => 1
    ];
    $result = MedicoModel::registrarMedico($data);
    if ($result) {
        header('Location: regmedicos.php?success=1');
        exit;
    } else {
        header('Location: regmedicos.php?error=1');
        exit;
    }
}
