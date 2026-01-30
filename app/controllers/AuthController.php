<?php
namespace App\Controllers;
/**
 * Controlador de Autenticación
 * Maneja login, logout y sesiones de usuario
 */

class AuthController {
    
    private $conn;
    
    public function __construct() {
        $this->conn = getConnection();
    }
    
    /**
     * Procesar login
     */
    public function login() {
        $alert = '';
        $isAjax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
        
        if (!empty($_SESSION['active'])) {
            if ($isAjax) {
                echo json_encode(['status' => 'OK', 'redirect' => BASE_URL . '/home']);
                exit;
            } else {
                header('Location: ' . BASE_URL . '/home');
                exit;
            }
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (empty($_POST['user']) || empty($_POST['pass'])) {
                if ($isAjax) {
                    echo json_encode(['status' => 'ERROR', 'message' => 'Ingrese usuario y contraseña']);
                    exit;
                } else {
                    $alert = 'Ingrese su Usuario y Contraseña';
                }
            } else {
                $user = mysqli_real_escape_string($this->conn, $_POST['user']);
                $pass = mysqli_real_escape_string($this->conn, $_POST['pass']);
                // Permitir login por username o email
                $sql = "SELECT * FROM tb_users WHERE (username = ? OR email_user = ?) AND pass_user = ?";
                $stmt = $this->conn->prepare($sql);
                $stmt->bind_param('sss', $user, $user, $pass);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result && $result->num_rows > 0) {
                    $data = $result->fetch_assoc();
                    $_SESSION['active']  = true;
                    $_SESSION['idUser']  = $data['dni_user'];
                    $_SESSION['nombre']  = $data['name_user'];
                    $_SESSION['email']   = $data['email_user'];
                    $_SESSION['usuario'] = $data['username'];
                    $_SESSION['rol']     = $data['rol_user'];
                    $stmt->close();
                    if ($isAjax) {
                        echo json_encode(['status' => 'OK', 'redirect' => BASE_URL . '/home']);
                        exit;
                    } else {
                        header('Location: ' . BASE_URL . '/home');
                        exit;
                    }
                } else {
                    if ($isAjax) {
                        echo json_encode(['status' => 'ERROR', 'message' => 'Usuario o contraseña incorrectos']);
                        exit;
                    } else {
                        $alert = 'El usuario y/o la contraseña es incorrecta';
                        session_destroy();
                    }
                }
                $stmt->close();
            }
        }
        return $alert;
    }
    
    /**
     * Cerrar sesión
     */
    public function logout() {
        session_destroy();
        header('Location: ' . BASE_URL . '/');
        exit;
    }
    
    /**
     * Verificar si el usuario está autenticado
     */
    public static function checkAuth() {
        if (empty($_SESSION['active'])) {
            header('Location: ' . BASE_URL . '/');
            exit;
        }
    }
    
    /**
     * Verificar rol de usuario
     */
    public static function checkRole($rolesPermitidos = []) {
        self::checkAuth();
        
        if (!empty($rolesPermitidos) && !in_array($_SESSION['rol'], $rolesPermitidos)) {
            header('Location: ' . BASE_URL . '/home');
            exit;
        }
    }
}

// (Eliminado: bloque procedural para ejecución directa)
