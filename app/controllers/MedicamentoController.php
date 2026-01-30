<?php
namespace App\Controllers;

use App\Models\Medicamento;

class MedicamentoController {
    private $model;

    public function __construct() {
        $this->model = new Medicamento();
    }

    public function index() {
        header('Content-Type: application/json');
        $medicamentos = $this->model->getAll();
        echo json_encode(['success' => true, 'medicamentos' => $medicamentos]);
        exit;
    }

    public function show($id = null) {
        header('Content-Type: application/json');
        $id = $id ?? ($_GET['id'] ?? null);
        
        if (!$id) {
            echo json_encode(['success' => false, 'message' => 'ID requerido']);
            exit;
        }

        $medicamento = $this->model->getById($id);
        
        if ($medicamento) {
            echo json_encode(['success' => true, 'medicamento' => $medicamento]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Medicamento no encontrado']);
        }
        exit;
    }
}
