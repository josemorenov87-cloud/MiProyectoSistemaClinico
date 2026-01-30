<?php
/**
 * Punto de Entrada Principal del Sistema
 * Centro Clínico v2 - MVC Structure
 */

// Cargar configuraciones
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/config/database.php';

// Obtener la ruta solicitada
$requestUri = $_SERVER['REQUEST_URI'];
$scriptName = dirname($_SERVER['SCRIPT_NAME']);
$route = str_replace($scriptName, '', $requestUri);
$route = strtok($route, '?'); // Eliminar query string

// Rutas del sistema
$routes = [
    // Auth
    '/' => 'views/auth/login.php',
    '/login' => 'app/controllers/AuthController.php',
    '/logout' => 'app/controllers/AuthController.php',
    
    // Dashboard
    '/home' => 'views/dashboard/home.php',
    '/dashboard' => 'views/dashboard/home.php',
    // Legacy alias
    '/home.php' => 'views/dashboard/home.php',
    
    // Pacientes
    '/pacientes' => 'views/pacientes/index.php',
    '/pacientes/create' => 'views/pacientes/create.php',
    '/pacientes/store' => 'app/controllers/PacienteController.php',
    '/pacientes/edit' => 'views/pacientes/edit.php',
    '/pacientes/update' => 'app/controllers/PacienteController.php',
    
    // Médicos
    '/medicos' => 'views/medicos/index.php',
    '/medicos/create' => 'views/medicos/create.php',
    '/medicos/store' => 'app/controllers/MedicoController.php',
    '/horario-medico' => 'app/controllers/HorarioMedicoController.php',
    '/horario-medico.php' => 'app/controllers/HorarioMedicoController.php',
    '/horario-medico.php' => 'app/controllers/HorarioMedicoController.php',
    '/horario-medico/modal' => 'app/controllers/HorarioMedicoController.php',
    '/ver-cita-medico' => 'app/controllers/VerCitaMedicoController.php',
    '/ver-cita-medico.php' => 'app/controllers/VerCitaMedicoController.php',
    '/ver-cita-medico/listar' => 'app/controllers/VerCitaMedicoController.php',
    '/guardar-horario-medico' => 'app/controllers/HorarioMedicoController.php',
    '/listar-horarios-medico' => 'app/controllers/HorarioMedicoController.php',
    '/eliminar-horario-medico' => 'app/controllers/HorarioMedicoController.php',
    
    // Citas
    '/citas' => 'views/citas/index.php',
    '/citas/create' => 'views/citas/create.php',
    '/citas/store' => 'app/controllers/CitaController.php',
    '/citas/pre' => 'views/citas/pre.php',
    // Legacy alias
    '/agendarcitas.php' => 'views/citas/create.php',
    '/agendarcitaspre.php' => 'views/citas/pre.php',
    
    // Triaje
    '/triaje' => 'views/triaje/index.php',
    // Legacy alias
    '/triaje.php' => 'views/triaje/index.php',
    '/triaje/store' => 'app/controllers/TriajeController.php',
    '/triaje/hoy' => 'app/controllers/TriajeController.php',
    '/triaje/paciente' => 'app/controllers/TriajeController.php',
    
    // Atención Médica
    '/atencion/medica' => 'views/atencion/medica.php',
    '/atencion/ginecologica' => 'views/atencion/ginecologica.php',
    '/atencion/perinatal' => 'views/atencion/perinatal.php',
    '/atencion/psicologica' => 'views/atencion/psicologica.php',
    '/anamnesis' => 'views/atencion/anamnesis.php',
    // Legacy aliases
    '/atencionmedica.php' => 'views/atencion/medica.php',
    '/atencionginecologica.php' => 'views/atencion/ginecologica.php',
    '/atencionperinatal.php' => 'views/atencion/perinatal.php',
    '/atencionpsicologica.php' => 'views/atencion/psicologica.php',
    '/anamnesis.php' => 'views/atencion/anamnesis.php',
    '/atencion/store' => 'app/controllers/AtencionController.php',
    
    // AJAX / API
    '/api/departamentos' => 'app/controllers/UbigeoController.php',
    '/api/provincias' => 'app/controllers/UbigeoController.php',
    '/api/distritos' => 'app/controllers/UbigeoController.php',
    '/api/especialidades' => 'app/controllers/EspecialidadController.php',
    '/api/paciente' => 'app/controllers/PacienteController.php',
    '/api/cie10' => 'app/controllers/Cie10Controller.php',
    '/api/cita' => 'app/controllers/CitaController.php',
    '/api/tipexamen' => 'app/controllers/TipoExamenController.php',
    '/api/medicamento' => 'app/controllers/MedicamentoController.php',
    
    // Administración legacy aliases
    '/regmedicos.php' => 'views/medicos/create.php',
    '/regpacientes.php' => 'views/pacientes/create.php',
    '/regmedicamentos.php' => 'views/medicamentos/create.php',
    '/logout.php' => 'app/controllers/AuthController.php',
    
    // Legacy AJAX aliases
    '/ajax_departamentos.php' => 'app/controllers/UbigeoController.php',
    '/ajax_provincias.php' => 'app/controllers/UbigeoController.php',
    '/ajax_distritos.php' => 'app/controllers/UbigeoController.php',
    '/ajax_especialidades.php' => 'app/controllers/EspecialidadController.php',
    // Roles
    '/roles' => 'views/rol/roles.php',
    '/roles.php' => 'views/rol/roles.php',
    
    // Legacy controller aliases
    '/controller_paciente.php' => 'app/controllers/PacienteController.php',
    '/controller_medico.php' => 'app/controllers/MedicoController.php',
    // Registro atención médica procedural
    '/system/registrar_atencion' => 'system/controller_atencion.php',
    // ... otras rutas ...
];

// Determinar qué método llamar según la ruta
$method = 'index';
$action = $_GET['action'] ?? ($_POST['action'] ?? null);

// For auth routes, default to the proper method names
if ($route === '/login') {
    $method = 'login';
}
if ($route === '/logout' || $route === '/logout.php') {
    $method = 'logout';
}
// Rutas de Ubigeo
if ($route === '/api/departamentos') {
    $method = 'departamentos';
} elseif ($route === '/api/provincias') {
    $method = 'provincias';
} elseif ($route === '/api/distritos') {
    $method = 'distritos';
}
// Rutas de Triaje
if ($route === '/triaje/hoy') {
    $method = 'hoy';
} elseif ($route === '/triaje/paciente') {
    $method = 'paciente';
} elseif ($route === '/triaje/store') {
    $method = 'store';
}
// Rutas de API generales
if ($route === '/api/paciente' && $action) {
    $method = $action;
} elseif ($route === '/api/cie10' && $action) {
    $method = $action;
} elseif ($route === '/api/cita' && $action) {
    $method = $action;
} elseif ($route === '/api/especialidades') {
    $method = 'index';
}
// Rutas específicas de horario médico
if ($route === '/guardar-horario-medico') {
    $method = 'guardar';
} elseif ($route === '/listar-horarios-medico') {
    $method = 'listar';
} elseif ($route === '/eliminar-horario-medico') {
    $method = 'eliminar';
} elseif ($route === '/horario-medico/modal') {
    $method = 'cargarModal';
} elseif ($route === '/ver-cita-medico/listar') {
    $method = 'listar';
}
// Rutas POST generales
if (strpos($_SERVER['REQUEST_METHOD'], 'POST') === 0) {
    if ($action && (strpos($route, '/api/') === 0 || strpos($route, '/pacientes/') === 0 || strpos($route, '/medicos/') === 0)) {
        // Ya está definido por los condicionales anteriores
    } elseif ($route === '/pacientes/store' || $route === '/medicos/store' || $route === '/triaje/store' || $route === '/atencion/store') {
        $method = 'store';
    }
}

// Buscar ruta y cargar archivo
if (array_key_exists($route, $routes)) {
    $file = BASE_PATH . '/' . $routes[$route];
    if (file_exists($file)) {
        // Si es un controlador, instanciar y ejecutar método
        if (strpos($file, 'controllers') !== false && strpos($file, '.php') !== false) {
            $filename = basename($file, '.php');
            $classname = 'App\\Controllers\\' . $filename;
            $fallbackClass = $filename;
            require_once $file; // Asegura que la clase esté cargada
            if (class_exists($classname)) {
                $controller = new $classname();
            } elseif (class_exists($fallbackClass)) {
                $controller = new $fallbackClass();
            } else {
                http_response_code(500);
                echo "Error: Clase {$classname} no encontrada";
                exit;
            }

            if (method_exists($controller, $method)) {
                $controller->$method();
            } else {
                http_response_code(500);
                echo "Error: Método '{$method}' no encontrado";
            }
        } else {
            require $file;
        }
    } else {
        http_response_code(404);
        echo "Error 404: Archivo no encontrado: {$file}";
    }
} else {
    http_response_code(404);
    echo "Error 404: Ruta no encontrada: {$route}";
}


