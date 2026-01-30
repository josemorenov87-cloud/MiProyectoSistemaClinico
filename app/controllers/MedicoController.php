<?php
/**
 * Controlador de Médicos
 * Maneja todas las operaciones CRUD de médicos
 */

namespace App\Controllers;

use App\Models\Medico;

class MedicoController {
    
    private $model;
    
    public function __construct() {
        $this->model = new Medico();
    }
    
    /**
     * Registrar nuevo médico
     */
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'tdoc_medico'     => $_POST['tdoc_medico'] ?? '',
                'numdoc_medico'   => $_POST['numdoc_medico'] ?? '',
                'fnac_medico'     => $_POST['fnac_medico'] ?? '',
                'nom_medico'      => $_POST['nom_medico'] ?? '',
                'apepat_medico'   => $_POST['apepat_medico'] ?? '',
                'apemat_medico'   => $_POST['apemat_medico'] ?? '',
                'nac_medico'      => $_POST['nac_medico'] ?? '',
                'lnac_medico'     => $_POST['lnac_medico'] ?? '',
                'sex_medico'      => $_POST['sex_medico'] ?? '',
                'email_medico'    => $_POST['email_medico'] ?? '',
                'tel_medico'      => $_POST['tel_medico'] ?? '',
                'cel_medico'      => $_POST['cel_medico'] ?? '',
                'direc_medico'    => $_POST['direc_medico'] ?? '',
                'depart_medico'   => intval($_POST['depart_medico'] ?? 0),
                'prov_medico'     => intval($_POST['prov_medico'] ?? 0),
                'dist_medico'     => intval($_POST['dist_medico'] ?? 0),
                'esp_medico'      => intval($_POST['esp_medico'] ?? 0),
                'tcoleg_medico'   => $_POST['tcoleg_medico'] ?? '',
                'numcoleg_medico' => $_POST['numcoleg_medico'] ?? '',
                'habcoleg_medico' => $_POST['habcoleg_medico'] ?? '',
                'status_medico'   => 1
            ];
            
            $result = $this->model->create($data);
            
            if ($result === true) {
                header('Location: ' . BASE_URL . '/views/medicos/create.php?success=1');
                exit;
            } else {
                header('Location: ' . BASE_URL . '/views/medicos/create.php?error=' . urlencode($result));
                exit;
            }
        }
    }
    
    /**
     * Listar todos los médicos
     */
    public function index() {
        $medicos = $this->model->getAll();
        return $medicos;
    }
    
    /**
     * Obtener un médico por ID
     */
    public function show($id) {
        $medico = $this->model->getById($id);
        return $medico;
    }
    
    /**
     * Actualizar médico
     */
    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id_medico'] ?? 0;
            $data = [
                'tdoc_medico'     => $_POST['tdoc_medico'] ?? '',
                'numdoc_medico'   => $_POST['numdoc_medico'] ?? '',
                'fnac_medico'     => $_POST['fnac_medico'] ?? '',
                'nom_medico'      => $_POST['nom_medico'] ?? '',
                'apepat_medico'   => $_POST['apepat_medico'] ?? '',
                'apemat_medico'   => $_POST['apemat_medico'] ?? '',
                'nac_medico'      => $_POST['nac_medico'] ?? '',
                'lnac_medico'     => $_POST['lnac_medico'] ?? '',
                'sex_medico'      => $_POST['sex_medico'] ?? '',
                'email_medico'    => $_POST['email_medico'] ?? '',
                'tel_medico'      => $_POST['tel_medico'] ?? '',
                'cel_medico'      => $_POST['cel_medico'] ?? '',
                'direc_medico'    => $_POST['direc_medico'] ?? '',
                'depart_medico'   => intval($_POST['depart_medico'] ?? 0),
                'prov_medico'     => intval($_POST['prov_medico'] ?? 0),
                'dist_medico'     => intval($_POST['dist_medico'] ?? 0),
                'esp_medico'      => intval($_POST['esp_medico'] ?? 0),
                'tcoleg_medico'   => $_POST['tcoleg_medico'] ?? '',
                'numcoleg_medico' => $_POST['numcoleg_medico'] ?? '',
                'habcoleg_medico' => $_POST['habcoleg_medico'] ?? ''
            ];
            
            $result = $this->model->update($id, $data);
            
            if ($result) {
                echo json_encode(['success' => true, 'message' => 'Médico actualizado correctamente']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Error al actualizar médico']);
            }
            exit;
        }
    }
}

// Instanciar y ejecutar acción según la ruta
if (isset($_GET['action'])) {
    $controller = new MedicoController();
    $action = $_GET['action'];
    
    if (method_exists($controller, $action)) {
        $controller->$action();
    }
} else {
    // Por defecto, registrar (compatibilidad con código antiguo)
    $controller = new MedicoController();
    $controller->store();
}
