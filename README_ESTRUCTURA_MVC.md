# SISTEMA CLÍNICO V2.0 - DOCUMENTACIÓN DE ARQUITECTURA MVC

## 📁 Nueva Estructura de Carpetas

```
www.sistemaclinico2.com/
│
├── index.php                    # Punto de entrada principal
│
├── config/                      # Configuraciones del sistema
│   ├── database.php            # Configuración de base de datos
│   └── config.php              # Configuraciones generales (rutas, sesión, etc.)
│
├── routes/                      # Enrutamiento
│   └── web.php                 # Definición de rutas del sistema
│
├── app/                         # Lógica de la aplicación
│   ├── controllers/            # Controladores (lógica de negocio)
│   │   ├── AuthController.php
│   │   ├── PacienteController.php
│   │   ├── MedicoController.php
│   │   ├── CitaController.php
│   │   ├── TriajeController.php
│   │   ├── AtencionController.php
│   │   └── UbigeoController.php
│   │
│   ├── models/                 # Modelos (interacción con BD)
│   │   ├── Paciente.php
│   │   ├── Medico.php
│   │   ├── Cita.php
│   │   ├── Triaje.php
│   │   └── Atencion.php
│   │
│   └── helpers/                # Funciones auxiliares
│       ├── Session.php
│       └── Validator.php
│
├── views/                       # Vistas (presentación)
│   ├── layout/                 # Plantillas base
│   │   ├── header.php
│   │   ├── sidebar.php
│   │   └── footer.php
│   │
│   ├── auth/                   # Autenticación
│   │   └── login.php
│   │
│   ├── dashboard/              # Dashboard
│   │   └── home.php
│   │
│   ├── pacientes/              # Pacientes
│   │   ├── index.php
│   │   ├── create.php
│   │   └── edit.php
│   │
│   ├── medicos/                # Médicos
│   │   ├── index.php
│   │   ├── create.php
│   │   └── edit.php
│   │
│   ├── citas/                  # Citas
│   │   ├── index.php
│   │   └── create.php
│   │
│   ├── triaje/                 # Triaje
│   │   └── index.php
│   │
│   └── atencion/               # Atención médica
│       ├── medica.php
│       ├── ginecologica.php
│       ├── perinatal.php
│       └── psicologica.php
│
├── public/                      # Archivos públicos (accesibles desde navegador)
│   ├── css/
│   ├── js/
│   ├── img/
│   ├── plugins/                # Plugins AdminLTE, jQuery, etc.
│   └── dist/                   # Distribución AdminLTE
│
└── db/                          # Scripts de base de datos (backups, migrations)

```

---

## 🔧 Archivos de Configuración

### 1. `config/database.php`
Gestiona la conexión a la base de datos:
- Define constantes: `DB_HOST`, `DB_USER`, `DB_PASS`, `DB_NAME`, `DB_PORT`
- Función `getConnection()`: retorna conexión mysqli
- Función `conectar()`: alias para compatibilidad

### 2. `config/config.php`
Configuraciones generales del sistema:
- Rutas: `BASE_PATH`, `APP_PATH`, `VIEWS_PATH`, `PUBLIC_PATH`
- URLs: `BASE_URL`, `PUBLIC_URL`
- Sesión: `SESSION_NAME`, `SESSION_LIFETIME`
- Zona horaria y manejo de errores

### 3. `routes/web.php`
Enrutador del sistema:
- Define array asociativo de rutas
- Mapea URLs a controladores o vistas
- Maneja errores 404

---

## 🎯 Controladores (app/controllers/)

### Estructura de un Controlador
```php
<?php
require_once __DIR__ . '/../models/NombreModelo.php';

class NombreController {
    private $model;
    
    public function __construct() {
        $this->model = new NombreModelo();
    }
    
    public function store() {
        // Lógica para crear
    }
    
    public function index() {
        // Lógica para listar
    }
    
    public function show($id) {
        // Lógica para mostrar uno
    }
    
    public function update() {
        // Lógica para actualizar
    }
}
```

### Controladores Creados:
1. **AuthController** - Login, logout, verificación de sesión
2. **PacienteController** - CRUD de pacientes
3. **MedicoController** - CRUD de médicos
4. **UbigeoController** - API para departamentos, provincias, distritos

---

## 📊 Modelos (app/models/)

### Estructura de un Modelo
```php
<?php
class NombreModelo {
    private $conn;
    private $table = 'nombre_tabla';
    
    public function __construct() {
        $this->conn = getConnection();
    }
    
    public function create($data) {
        // Insertar en BD
    }
    
    public function getAll() {
        // Obtener todos
    }
    
    public function getById($id) {
        // Obtener por ID
    }
    
    public function update($id, $data) {
        // Actualizar
    }
    
    public function delete($id) {
        // Eliminar (lógico)
    }
}
```

### Modelos Creados:
1. **Paciente** - Gestión de tabla `tb_pacientes`
2. **Medico** - Gestión de tabla `tb_medicos`

---

## 🎨 Vistas (views/)

### Estructura de una Vista
```php
<?php
// Configuración
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../app/controllers/AuthController.php';

AuthController::checkAuth(); // Verificar autenticación

$pageTitle = 'Título de la Página';
$additionalCSS = ['url/a/css/adicional.css'];

// Header y Sidebar
include __DIR__ . '/../layout/header.php';
include __DIR__ . '/../layout/sidebar.php';
?>

<!-- Content Wrapper -->
<div class="content-wrapper">
    <!-- Contenido aquí -->
</div>

<?php
// Footer
$additionalJS = ['url/a/js/adicional.js'];
include __DIR__ . '/../layout/footer.php';
?>
```

---

## 🚀 Cómo Usar la Nueva Estructura

### 1. Acceder al Sistema
```
http://localhost/www.sistemaclinico2.com/
```

### 2. Rutas Disponibles
- `/` - Login
- `/home` - Dashboard principal
- `/pacientes/create` - Registro de pacientes
- `/medicos/create` - Registro de médicos
- `/citas/create` - Agendar citas
- `/triaje` - Triaje
- `/atencion/medica` - Atención médica general
- `/logout?action=logout` - Cerrar sesión

### 3. API AJAX (UbigeoController)
```javascript
// Obtener departamentos
GET /api/departamentos?action=departamentos

// Obtener provincias
GET /api/provincias?action=provincias&id_departamento=1

// Obtener distritos
GET /api/distritos?action=distritos&id_provincia=1
```

---

## 📝 Migración de Archivos Antiguos

### Archivos Migrados:
- ✅ `app/conexion.php` → `config/database.php`
- ✅ `system/controller_paciente.php` → `app/controllers/PacienteController.php`
- ✅ `system/controller_medico.php` → `app/controllers/MedicoController.php`
- ✅ `system/model_paciente.php` → `app/models/Paciente.php`
- ✅ `system/model_medico.php` → `app/models/Medico.php`
- ✅ `app/login.php` → `app/controllers/AuthController.php`
- ✅ `system/includes/sidebar.php` → `views/layout/sidebar.php`
- ✅ `system/regpacientes.php` → `views/pacientes/create.php`

### Pendientes de Migrar:
- 🔄 `system/regmedicos.php` → `views/medicos/create.php`
- 🔄 `system/agendarcitas.php` → `views/citas/create.php`
- 🔄 `system/triaje.php` → `views/triaje/index.php`
- 🔄 `system/atencionmedica.php` → `views/atencion/medica.php`
- 🔄 `system/atencionginecologica.php` → `views/atencion/ginecologica.php`
- 🔄 `system/atencionperinatal.php` → `views/atencion/perinatal.php`
- 🔄 `system/atencionpsicologica.php` → `views/atencion/psicologica.php`
- 🔄 `system/anamnesis.php` → `views/atencion/anamnesis.php`
- 🔄 `system/home.php` → `views/dashboard/home.php`

---

## 🔐 Seguridad

### Verificación de Autenticación
```php
// En cualquier vista
AuthController::checkAuth(); // Verifica si está logueado

// Verificar rol específico
AuthController::checkRole(['admin', 'medico']); // Solo admin o médico
```

### Variables de Sesión Disponibles
- `$_SESSION['active']` - true si está autenticado
- `$_SESSION['idUser']` - DNI del usuario
- `$_SESSION['nombre']` - Nombre completo
- `$_SESSION['email']` - Email
- `$_SESSION['usuario']` - Username
- `$_SESSION['rol']` - Rol del usuario

---

## 📌 Constantes Disponibles

```php
// Rutas del sistema
BASE_PATH       // c:\xampp\htdocs\www.sistemaclinico2.com
APP_PATH        // c:\xampp\htdocs\www.sistemaclinico2.com\app
VIEWS_PATH      // c:\xampp\htdocs\www.sistemaclinico2.com\views
PUBLIC_PATH     // c:\xampp\htdocs\www.sistemaclinico2.com\public
CONFIG_PATH     // c:\xampp\htdocs\www.sistemaclinico2.com\config

// URLs
BASE_URL        // http://localhost/www.sistemaclinico2.com
PUBLIC_URL      // http://localhost/www.sistemaclinico2.com/public

// Base de datos
DB_HOST         // 127.0.0.1
DB_USER         // root
DB_PASS         // (vacío)
DB_NAME         // centro_clinico_v2
DB_PORT         // 3307
```

---

## 🎓 Buenas Prácticas

1. **Separación de Responsabilidades**:
   - Controladores: Lógica de negocio
   - Modelos: Acceso a datos
   - Vistas: Presentación

2. **Uso de Rutas**:
   - Siempre usar `BASE_URL` para enlaces
   - Nunca hardcodear rutas absolutas

3. **Seguridad**:
   - Verificar autenticación en cada vista
   - Usar prepared statements en modelos
   - Validar y sanitizar datos de entrada

4. **Nomenclatura**:
   - Controladores: `NombreController.php`
   - Modelos: `Nombre.php`
   - Vistas: nombres descriptivos en lowercase

---

## 📚 Próximos Pasos

1. Migrar las vistas restantes del folder `system/`
2. Crear controladores adicionales (Cita, Triaje, Atencion)
3. Implementar modelos faltantes
4. Actualizar rutas en `routes/web.php`
5. Probar todas las funcionalidades
6. Eliminar archivos antiguos de `system/` (hacer backup primero)

---

## ⚙️ Comandos Útiles

### Iniciar XAMPP
```powershell
# Iniciar Apache
net start Apache2.4

# Iniciar MySQL
net start MySQL
```

### Acceso a la Base de Datos
- phpMyAdmin: http://localhost/phpmyadmin
- Base de datos: `centro_clinico_v2`
- Puerto MySQL: 3307

---

**Autor**: Sistema Clínico v2.0  
**Fecha**: 2024  
**Versión**: 2.0.0
