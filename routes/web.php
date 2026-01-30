<?php
/**
 * Enrutador del Sistema
 * Gestiona las rutas y carga los controladores correspondientes
 */

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
    '/horario-medico' => 'views/medicos/horario.php',
    '/horario-medico.php' => 'views/medicos/horario.php',
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
        // Legacy controller aliases
        '/controller_paciente.php' => 'app/controllers/PacienteController.php',
        '/controller_medico.php' => 'app/controllers/MedicoController.php',
];

// Buscar ruta y cargar archivo
if (array_key_exists($route, $routes)) {
    $file = BASE_PATH . '/' . $routes[$route];
    if (file_exists($file)) {
        require $file;
    } else {
        http_response_code(404);
        echo "Error 404: Archivo no encontrado";
    }
} else {
    http_response_code(404);
    echo "Error 404: Ruta no encontrada";
}
