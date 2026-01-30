<?php

namespace App\Controllers;

use App\Models\Cita;

class CitaController
{
    private $cita;

    public function __construct()
    {
        $this->cita = new Cita();
    }

    /**
     * Busca citas por número de documento del paciente
     * GET /api/cita?action=buscarPorDocumento&numdoc=<dni>
     */
    public function buscarPorDocumento()
    {
        header('Content-Type: application/json');
        
        if (!isset($_GET['numdoc']) || empty($_GET['numdoc'])) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Documento requerido']);
            return;
        }

        $numdoc = trim($_GET['numdoc']);
        $citas = $this->cita->buscarPorDocumento($numdoc);

        if ($citas) {
            echo json_encode([
                'success' => true,
                'citas' => $citas
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'No hay citas registradas',
                'citas' => []
            ]);
        }
    }

    /**
     * Busca una cita específica por ID
     * GET /api/cita?action=buscarPorId&id=<id_cita>
     */
    public function buscarPorId()
    {
        header('Content-Type: application/json');
        
        if (!isset($_GET['id']) || empty($_GET['id'])) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'ID requerido']);
            return;
        }

        $id = intval($_GET['id']);
        $cita = $this->cita->getById($id);

        if ($cita) {
            echo json_encode([
                'success' => true,
                'cita' => $cita
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Cita no encontrada'
            ]);
        }
    }
}
