# 🏥 GUÍA RÁPIDA - SISTEMA CLÍNICO V2.0

## 📋 ¿QUÉ SE HA HECHO?

Se ha reorganizado completamente el proyecto siguiendo el **patrón MVC (Modelo-Vista-Controlador)** para una mejor estructura, mantenibilidad y escalabilidad.

---

## 🗂️ ANTES vs DESPUÉS

### ❌ ANTES (Desordenado)
```
system/
  ├── controller_medico.php
  ├── controller_paciente.php
  ├── model_medico.php
  ├── model_paciente.php
  ├── regpacientes.php
  ├── regmedicos.php
  ├── agendarcitas.php
  ├── triaje.php
  ├── ajax_departamentos.php
  ├── ajax_provincias.php
  ├── web.php
  ├── home.php
  └── ... (todo mezclado)
```

### ✅ DESPUÉS (Organizado)
```
www.sistemaclinico2.com/
├── index.php               ← Punto de entrada
├── config/                 ← Configuraciones
│   ├── database.php
│   └── config.php
├── routes/                 ← Rutas
│   └── web.php
├── app/                    ← Lógica
│   ├── controllers/        ← Controladores
│   │   ├── AuthController.php
│   │   ├── PacienteController.php
│   │   ├── MedicoController.php
│   │   └── UbigeoController.php
│   └── models/             ← Modelos
│       ├── Paciente.php
│       └── Medico.php
└── views/                  ← Vistas
    ├── layout/             ← Plantillas base
    │   ├── header.php
    │   ├── sidebar.php
    │   └── footer.php
    ├── auth/
    │   └── login.php
    ├── pacientes/
    │   └── create.php
    └── medicos/
        └── create.php
```

---

## 🎯 COMPONENTES PRINCIPALES

### 1️⃣ **index.php** (Punto de Entrada)
```php
// Carga configuraciones
require 'config/config.php';
require 'config/database.php';

// Carga el enrutador
require 'routes/web.php';
```

### 2️⃣ **config/database.php** (Conexión a BD)
```php
// Define constantes
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'centro_clinico_v2');
define('DB_PORT', 3307);

// Función de conexión
function getConnection() { ... }
```

### 3️⃣ **config/config.php** (Configuración General)
```php
// Rutas del sistema
define('BASE_PATH', dirname(__DIR__));
define('BASE_URL', 'http://localhost/www.sistemaclinico2.com');
define('PUBLIC_URL', BASE_URL . '/public');
```

### 4️⃣ **routes/web.php** (Enrutador)
```php
$routes = [
    '/' => 'views/auth/login.php',
    '/home' => 'views/dashboard/home.php',
    '/pacientes/create' => 'views/pacientes/create.php',
    '/pacientes/store' => 'app/controllers/PacienteController.php',
    // ... más rutas
];
```

### 5️⃣ **Controladores** (app/controllers/)
Manejan la lógica de negocio:
```php
class PacienteController {
    private $model;
    
    public function store() {
        // Recibe datos del formulario
        // Valida
        // Llama al modelo
        // Retorna respuesta
    }
}
```

### 6️⃣ **Modelos** (app/models/)
Interactúan con la base de datos:
```php
class Paciente {
    private $conn;
    
    public function create($data) {
        // Prepara consulta SQL
        // Ejecuta INSERT
        // Retorna resultado
    }
}
```

### 7️⃣ **Vistas** (views/)
Presentan la información al usuario:
```php
<?php
// Verifica autenticación
AuthController::checkAuth();

// Carga header y sidebar
include 'layout/header.php';
include 'layout/sidebar.php';
?>

<!-- Contenido HTML -->
<div class="content-wrapper">
    <!-- Formulario o listado -->
</div>

<?php
// Carga footer
include 'layout/footer.php';
?>
```

---

## 🚀 CÓMO FUNCIONA EL FLUJO

```
1. Usuario accede → http://localhost/www.sistemaclinico2.com/pacientes/create

2. index.php recibe la petición
   ↓
3. Carga config/config.php y config/database.php
   ↓
4. routes/web.php busca la ruta en el array $routes
   ↓
5. Encuentra: '/pacientes/create' => 'views/pacientes/create.php'
   ↓
6. Carga views/pacientes/create.php
   ↓
7. La vista incluye header.php y sidebar.php
   ↓
8. Muestra el formulario al usuario
   ↓
9. Usuario llena el formulario y da clic en "Registrar"
   ↓
10. JavaScript envía los datos vía AJAX a /pacientes/store
    ↓
11. routes/web.php encuentra: '/pacientes/store' => 'app/controllers/PacienteController.php'
    ↓
12. PacienteController recibe los datos
    ↓
13. Llama a $model->create($data)
    ↓
14. El modelo Paciente ejecuta INSERT en la BD
    ↓
15. Retorna JSON con éxito o error
    ↓
16. JavaScript muestra mensaje al usuario
```

---

## 📂 ARCHIVOS CREADOS

### ✅ Configuración
- [x] `config/database.php` - Conexión a BD
- [x] `config/config.php` - Configuración general
- [x] `routes/web.php` - Enrutador
- [x] `.htaccess` - Reescritura de URLs

### ✅ Controladores
- [x] `app/controllers/AuthController.php` - Login/Logout
- [x] `app/controllers/PacienteController.php` - Gestión de pacientes
- [x] `app/controllers/MedicoController.php` - Gestión de médicos
- [x] `app/controllers/UbigeoController.php` - API de ubicaciones

### ✅ Modelos
- [x] `app/models/Paciente.php` - Modelo de pacientes
- [x] `app/models/Medico.php` - Modelo de médicos

### ✅ Vistas - Layout
- [x] `views/layout/header.php` - Encabezado común
- [x] `views/layout/sidebar.php` - Menú lateral
- [x] `views/layout/footer.php` - Pie de página

### ✅ Vistas - Páginas
- [x] `views/auth/login.php` - Página de login
- [x] `views/pacientes/create.php` - Registro de pacientes

### ✅ Documentación
- [x] `README_ESTRUCTURA_MVC.md` - Documentación completa
- [x] `GUIA_RAPIDA.md` - Esta guía

---

## 🔗 RUTAS DISPONIBLES

| URL | Descripción | Archivo |
|-----|-------------|---------|
| `/` | Login | `views/auth/login.php` |
| `/login` | Procesar login | `AuthController.php` |
| `/logout?action=logout` | Cerrar sesión | `AuthController.php` |
| `/home` | Dashboard | `views/dashboard/home.php` |
| `/pacientes/create` | Formulario pacientes | `views/pacientes/create.php` |
| `/pacientes/store` | Guardar paciente | `PacienteController.php` |
| `/medicos/create` | Formulario médicos | `views/medicos/create.php` |
| `/medicos/store` | Guardar médico | `MedicoController.php` |
| `/api/departamentos` | API Departamentos | `UbigeoController.php` |
| `/api/provincias` | API Provincias | `UbigeoController.php` |
| `/api/distritos` | API Distritos | `UbigeoController.php` |

---

## 🛠️ CÓMO EMPEZAR A USAR

### 1. Accede al sistema:
```
http://localhost/www.sistemaclinico2.com/
```

### 2. Inicia sesión con tus credenciales

### 3. Navega por el menú:
- **Registrar Pacientes** → `/pacientes/create`
- **Registrar Médicos** → `/medicos/create`
- Etc.

---

## 📝 PRÓXIMOS PASOS

### 🔄 Tareas Pendientes:

1. **Migrar vistas restantes:**
   - `system/regmedicos.php` → `views/medicos/create.php`
   - `system/home.php` → `views/dashboard/home.php`
   - `system/agendarcitas.php` → `views/citas/create.php`
   - `system/triaje.php` → `views/triaje/index.php`
   - `system/atencionmedica.php` → `views/atencion/medica.php`
   - Etc.

2. **Crear controladores faltantes:**
   - CitaController.php
   - TriajeController.php
   - AtencionController.php

3. **Crear modelos faltantes:**
   - Cita.php
   - Triaje.php
   - Atencion.php

4. **Actualizar rutas en `routes/web.php`**

5. **Probar todas las funcionalidades**

6. **Backup y eliminar carpeta `system/` antigua**

---

## 💡 VENTAJAS DE LA NUEVA ESTRUCTURA

### ✅ Separación de Responsabilidades
- **Modelos**: Solo hablan con la BD
- **Controladores**: Solo lógica de negocio
- **Vistas**: Solo presentación

### ✅ Reutilización de Código
- Layout compartido (header, sidebar, footer)
- Un solo archivo de configuración
- Funciones helpers centralizadas

### ✅ Mantenibilidad
- Fácil encontrar archivos
- Código más limpio
- Menos duplicación

### ✅ Escalabilidad
- Agregar nuevos módulos es más fácil
- Estructura clara para nuevos desarrolladores
- Mejor para trabajo en equipo

### ✅ Seguridad
- Protección de carpetas sensibles (.htaccess)
- Verificación de autenticación centralizada
- Prepared statements en todos los modelos

---

## 📞 SOPORTE

Si necesitas ayuda o tienes dudas sobre la nueva estructura, revisa:
1. Este archivo (`GUIA_RAPIDA.md`)
2. Documentación completa (`README_ESTRUCTURA_MVC.md`)
3. Comentarios en el código

---

**¡Listo para usar! 🚀**

La base del sistema está organizada. Ahora puedes continuar migrando las vistas restantes siguiendo los ejemplos creados.
