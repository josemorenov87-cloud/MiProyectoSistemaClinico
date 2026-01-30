<?php
/**
 * Controlador de Pacientes
 * Maneja todas las operaciones CRUD de pacientes
 */

namespace App\Controllers;

use App\Models\Paciente;

class PacienteController {
    
    private $model;
    
    public function __construct() {
        $this->model = new Paciente();
    }
    
    /**
     * Registrar nuevo paciente
     */
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
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
            ];
            
            $result = $this->model->create($data);
            
            if ($result) {
                echo json_encode(['success' => true, 'message' => 'Paciente registrado correctamente']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Error al registrar paciente']);
            }
            exit;
        }
    }
    
    /**
     * Listar todos los pacientes
     */
    public function index() {
        $pacientes = $this->model->getAll();
        return $pacientes;
    }
    
    /**
     * Obtener un paciente por ID
     */
    public function show($id) {
        $paciente = $this->model->getById($id);
        return $paciente;
    }
    
    /**
     * Actualizar paciente
     */
    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id_paciente'] ?? 0;
            $data = [
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
                'emailce_paciente' => $_POST['contacto_correo'] ?? ''
            ];
            
            $result = $this->model->update($id, $data);
            
            if ($result) {
                echo json_encode(['success' => true, 'message' => 'Paciente actualizado correctamente']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Error al actualizar paciente']);
            }
            exit;
        }
    }

    /**
     * Buscar por documento y devolver datos + código de historia
     */
    public function buscarPorDocumento() {
        header('Content-Type: application/json');

        $numdoc = $_GET['numdoc'] ?? '';
        if (empty($numdoc)) {
            echo json_encode(['success' => false, 'message' => 'numdoc requerido']);
            exit;
        }

        $paciente = $this->model->getByDocument($numdoc);
        if (!$paciente) {
            echo json_encode(['success' => false, 'message' => 'Paciente no encontrado']);
            exit;
        }

        $historial = $this->model->getHistorialByPaciente($paciente['id_paciente'] ?? null, $paciente['numdoc_paciente'] ?? null);
        $codigoHistorial = $historial['codigo_historial'] ?? ('HC-' . ($paciente['numdoc_paciente'] ?? $numdoc));

        $nombreCompleto = trim(($paciente['nom_paciente'] ?? '') . ' ' . ($paciente['apepat_paciente'] ?? '') . ' ' . ($paciente['apemat_paciente'] ?? ''));
        $edad = $this->calcularEdad($paciente['fnac_paciente'] ?? null);

        echo json_encode([
            'success' => true,
            'paciente' => [
                'id_paciente' => $paciente['id_paciente'] ?? null,
                'numdoc_paciente' => $paciente['numdoc_paciente'] ?? $numdoc,
                'nombre_completo' => preg_replace('/\s+/', ' ', trim($nombreCompleto)),
                'fnac_paciente' => $paciente['fnac_paciente'] ?? null,
                'edad' => $edad,
                'codigo_historial' => $codigoHistorial,
                'sexo' => $paciente['sex_paciente'] ?? null,
            ]
        ]);
        exit;
    }

    private function calcularEdad(?string $fecha): ?int {
        if (empty($fecha)) {
            return null;
        }
        $nacimiento = date_create($fecha);
        $hoy = date_create('today');
        if (!$nacimiento) {
            return null;
        }
        $diff = date_diff($nacimiento, $hoy);
        return (int)$diff->y;
    }
}

// Instanciar y ejecutar acción según la ruta (solo si se invoca directamente)
if (!defined('BASE_PATH')) {
    if (isset($_GET['action'])) {
        $controller = new PacienteController();
        $action = $_GET['action'];
        
        if (method_exists($controller, $action)) {
            $controller->$action();
        }
    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $controller = new PacienteController();
        $controller->store();
    }
}
