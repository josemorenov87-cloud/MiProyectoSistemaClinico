<?php
// Sidebar para la sección de horarios del médico
?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="<?php echo BASE_URL; ?>/home.php" class="brand-link">
        <img src="<?php echo BASE_URL; ?>/img/clinica.png" alt="Clínica Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">SistemaClínico</span>
    </a>

    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?php echo BASE_URL; ?>/img/jmoreno2.jpeg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?php echo isset($_SESSION['nombre_usuario']) ? $_SESSION['nombre_usuario'] : 'Médico'; ?></a>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="<?php echo BASE_URL; ?>/home.php" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Inicio</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?php echo BASE_URL; ?>/horario-medico" class="nav-link active">
                        <i class="nav-icon fas fa-clock"></i>
                        <p>Mi Disponibilidad</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?php echo BASE_URL; ?>/logout.php" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Salir</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
