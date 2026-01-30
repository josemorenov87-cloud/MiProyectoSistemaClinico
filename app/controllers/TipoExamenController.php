<?php
namespace App\Controllers;

use App\Models\TipoExamen;

class TipoExamenController {
    private $model;

    public function __construct() {
        $this->model = new TipoExamen();
    }

    public function index() {
        header('Content-Type: application/json');
        $examenes = $this->model->getAll();
        echo json_encode(['success' => true, 'examenes' => $examenes]);
        exit;
    }

    public function show($id = null) {
        header('Content-Type: application/json');
        $id = $id ?? ($_GET['id'] ?? null);
        
        if (!$id) {
            echo json_encode(['success' => false, 'message' => 'ID requerido']);
            exit;
        }

        $examen = $this->model->getById($id);
        
        if ($examen) {
            echo json_encode(['success' => true, 'examen' => $examen]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Examen no encontrado']);
        }
        exit;
    }
}
