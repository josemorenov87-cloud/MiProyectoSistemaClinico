<?php
namespace App\Controllers;

use App\Models\HorarioMedico;

class HorarioMedicoController {
    private $horarioMedico;

    public function __construct() {
        $this->horarioMedico = new HorarioMedico();
    }

    /**
     * Mostrar formulario de disponibilidad
     */
    public function index() {
        // Verificar autenticación usando AuthController
        AuthController::checkAuth();
        require BASE_PATH . '/views/medicos/horario.php';
    }

    /**
     * Cargar contenido del modal (solo formulario y tabla, sin HTML completo)
     */
    public function cargarModal() {
        AuthController::checkAuth();
        // Retornar solo el contenido sin headers HTML
        require BASE_PATH . '/views/medicos/horario.php';
        exit;
    }

    /**
     * Guardar nuevo horario o actualizar existente
     */
    public function guardar() {
        header('Content-Type: application/json');
        
        // Verificar autenticación sin redirección para AJAX
        if (empty($_SESSION['active'])) {
            echo json_encode(['success' => false, 'mensaje' => 'No autenticado']);
            exit;
        }

        // Obtener id del médico desde la sesión o base de datos
        $id_medico = $this->obtenerIdMedicoDelUsuario($_SESSION['idUser']);
        
        if (!$id_medico) {
            echo json_encode(['success' => false, 'mensaje' => 'Médico no encontrado']);
            exit;
        }

        $fecha = isset($_POST['fecha']) ? trim($_POST['fecha']) : '';
        $hora = isset($_POST['hora']) ? trim($_POST['hora']) : '';
        $hora_fin = isset($_POST['hora_fin']) ? trim($_POST['hora_fin']) : '';
        $estado = isset($_POST['estado']) ? intval($_POST['estado']) : 0;

        // Validaciones
        if (empty($fecha) || empty($hora) || empty($hora_fin)) {
            echo json_encode(['success' => false, 'mensaje' => 'Fecha, hora inicio y hora fin son requeridas']);
            exit;
        }

        // Validar que fecha sea válida
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $fecha)) {
            echo json_encode(['success' => false, 'mensaje' => 'Formato de fecha inválido']);
            exit;
        }

        // Validar que hora sea válida
        if (!preg_match('/^\d{2}:\d{2}$/', $hora)) {
            echo json_encode(['success' => false, 'mensaje' => 'Formato de hora inválido']);
            exit;
        }

        // Validar que hora_fin sea válida
        if (!preg_match('/^\d{2}:\d{2}$/', $hora_fin)) {
            echo json_encode(['success' => false, 'mensaje' => 'Formato de hora fin inválido']);
            exit;
        }

        // Guardar en base de datos
        $resultado = $this->horarioMedico->guardar($id_medico, $fecha, $hora, $hora_fin, $estado);

        if ($resultado) {
            echo json_encode(['success' => true, 'mensaje' => 'Horario guardado exitosamente']);
        } else {
            echo json_encode(['success' => false, 'mensaje' => 'Error al guardar el horario']);
        }
        exit;
    }

    /**
     * Listar horarios del médico autenticado
     */
    public function listar() {
        // Verificar autenticación sin redirección para AJAX
        if (empty($_SESSION['active'])) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'horarios' => [], 'mensaje' => 'No autenticado']);
            exit;
        }

        header('Content-Type: application/json');

        $id_medico = $this->obtenerIdMedicoDelUsuario($_SESSION['idUser']);
        
        if (!$id_medico) {
            echo json_encode(['success' => false, 'horarios' => [], 'mensaje' => 'Médico no encontrado']);
            exit;
        }

        $horarios = $this->horarioMedico->obtenerPorMedico($id_medico);
        echo json_encode(['success' => true, 'horarios' => $horarios]);
        exit;
    }

    /**
     * Eliminar un horario
     */
    public function eliminar() {
        header('Content-Type: application/json');
        
        // Verificar autenticación sin redirección para AJAX
        if (empty($_SESSION['active'])) {
            echo json_encode(['success' => false, 'mensaje' => 'No autenticado']);
            exit;
        }

        $id_horario = isset($_POST['id']) ? intval($_POST['id']) : 0;

        if ($id_horario <= 0) {
            echo json_encode(['success' => false, 'mensaje' => 'ID inválido']);
            exit;
        }

        // Verificar que el horario pertenezca al médico autenticado
        $id_medico = $this->obtenerIdMedicoDelUsuario($_SESSION['idUser']);
        $horario = $this->horarioMedico->obtenerPorId($id_horario);

        if (!$horario || $horario['id_med'] != $id_medico) {
            echo json_encode(['success' => false, 'mensaje' => 'No tienes permiso para eliminar este horario']);
            exit;
        }

        $resultado = $this->horarioMedico->eliminar($id_horario);

        if ($resultado) {
            echo json_encode(['success' => true, 'mensaje' => 'Horario eliminado exitosamente']);
        } else {
            echo json_encode(['success' => false, 'mensaje' => 'Error al eliminar el horario']);
        }
        exit;
    }

    /**
     * Obtener ID del médico a partir del DNI del usuario
     * Busca en tb_medicos donde numdoc_medico coincida con el dni del usuario logueado
     */
    private function obtenerIdMedicoDelUsuario($dni_usuario) {
        $conexion = getConnection();
        
        $query = "SELECT id_medico FROM tb_medicos WHERE numdoc_medico = ?";
        $stmt = $conexion->prepare($query);
        
        if (!$stmt) {
            error_log("Error preparando consulta obtenerIdMedicoDelUsuario: " . $conexion->error);
            return null;
        }
        
        $stmt->bind_param("s", $dni_usuario);
        $stmt->execute();
        $resultado = $stmt->get_result();
        
        if ($resultado->num_rows > 0) {
            $row = $resultado->fetch_assoc();
            return $row['id_medico'];
        }
        
        return null;
    }
}
