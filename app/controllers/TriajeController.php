<?php

namespace App\Controllers;

use App\Models\Triaje;

class TriajeController
{
    private $triaje;

    public function __construct()
    {
        $this->triaje = new Triaje();
    }

    /**
     * Guarda un nuevo registro de triaje
     * POST /triaje/store
     */
    public function store()
    {
        header('Content-Type: application/json');

        // Verificar que sea POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(['success' => false, 'message' => 'Método no permitido']);
            return;
        }

        // Obtener datos del formulario
        $data = [
            'id_cita' => $_POST['id_cita'] ?? null,
            'numdoc_paciente' => $_POST['numdoc_paciente'] ?? '',
            'temp' => $_POST['temp'] ?? null,
            'presion' => $_POST['presion'] ?? '',
            'spo2' => $_POST['spo2'] ?? null,
            'pulso' => $_POST['pulso'] ?? null,
            'talla' => $_POST['talla'] ?? null,
            'peso' => $_POST['peso'] ?? null,
            'imc' => $_POST['imc'] ?? null,
            'imc_interp' => $_POST['imc_interp'] ?? '',
            'alergias' => $_POST['alergias'] ?? '',
        ];

        // Validar datos requeridos
        if (empty($data['numdoc_paciente'])) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Documento del paciente requerido']);
            return;
        }

        // Guardar en BD
        $result = $this->triaje->guardar($data);

        if ($result['success']) {
            http_response_code(201);
            echo json_encode($result);
        } else {
            http_response_code(500);
            echo json_encode($result);
        }
    }

    /**
     * Obtiene un triaje por ID
     * GET /triaje/show?id=<id>
     */
    public function show()
    {
        header('Content-Type: application/json');

        if (!isset($_GET['id'])) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'ID requerido']);
            return;
        }

        $id = intval($_GET['id']);
        $triaje = $this->triaje->getById($id);

        if ($triaje) {
            echo json_encode(['success' => true, 'triaje' => $triaje]);
        } else {
            http_response_code(404);
            echo json_encode(['success' => false, 'message' => 'Triaje no encontrado']);
        }
    }

    /**
     * Obtiene todos los triajes de un paciente
     * GET /triaje/paciente?numdoc=<dni>
     */
    public function paciente()
    {
        header('Content-Type: application/json');

        if (!isset($_GET['numdoc'])) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Documento requerido']);
            return;
        }

        $numdoc = trim($_GET['numdoc']);
        $triajes = $this->triaje->getTriajesPaciente($numdoc);

        if ($triajes) {
            echo json_encode(['success' => true, 'triajes' => $triajes]);
        } else {
            http_response_code(404);
            echo json_encode(['success' => false, 'message' => 'No hay triajes registrados para este paciente']);
        }
    }

    /**
     * Obtiene el triaje del día de hoy para un paciente
     * GET /triaje/hoy?numdoc=<dni>
     */
    public function hoy()
    {
        header('Content-Type: application/json');

        if (!isset($_GET['numdoc'])) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Documento requerido']);
            return;
        }

        $numdoc = trim($_GET['numdoc']);
        $triaje = $this->triaje->getTriajeHoy($numdoc);

        if ($triaje) {
            echo json_encode(['success' => true, 'triaje' => $triaje]);
        } else {
            http_response_code(404);
            echo json_encode(['success' => false, 'message' => 'No hay triaje registrado para hoy']);
        }
    }
}
