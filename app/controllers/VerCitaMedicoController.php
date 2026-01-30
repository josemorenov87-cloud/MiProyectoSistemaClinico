<?php
namespace App\Controllers;

use App\Models\CitaMedico;

class VerCitaMedicoController {
    private $citaMedico;

    public function __construct() {
        $this->citaMedico = new CitaMedico();
    }

    /**
     * Mostrar calendario de citas del médico
     */
    public function index() {
        AuthController::checkAuth();
        require BASE_PATH . '/views/medicos/vercitamedico.php';
    }

    /**
     * Listar citas del médico autenticado (JSON)
     */
    public function listar() {
        header('Content-Type: application/json');

        if (empty($_SESSION['active'])) {
            echo json_encode(['success' => false, 'citas' => [], 'mensaje' => 'No autenticado']);
            exit;
        }

        $id_medico = $this->obtenerIdMedicoDelUsuario($_SESSION['idUser']);

        if (!$id_medico) {
            echo json_encode(['success' => false, 'citas' => [], 'mensaje' => 'No se encontró el médico asociado']);
            exit;
        }

        $citas = $this->citaMedico->listarPorMedico($id_medico);
        echo json_encode(['success' => true, 'citas' => $citas]);
        exit;
    }

    /**
     * Obtener ID del médico a partir del DNI del usuario
     */
    private function obtenerIdMedicoDelUsuario($dni_usuario) {
        $conexion = getConnection();

        $query = "SELECT id_medico FROM tb_medicos WHERE numdoc_medico = ?";
        $stmt = $conexion->prepare($query);

        if (!$stmt) {
            error_log('Error preparando consulta obtenerIdMedicoDelUsuario: ' . $conexion->error);
            return null;
        }

        $stmt->bind_param('s', $dni_usuario);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado && $resultado->num_rows > 0) {
            $row = $resultado->fetch_assoc();
            return $row['id_medico'];
        }

        return null;
    }
}
