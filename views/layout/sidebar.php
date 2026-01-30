
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo BASE_URL; ?>/home" class="brand-link">
        <img src="<?php echo BASE_URL; ?>/system/img/clinica.png" alt="Clinica Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-bold">Centro Médico</span>
    </a>
    
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?php echo BASE_URL; ?>/system/img/user-default.png" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?php echo $_SESSION['nombre'] ?? 'Usuario'; ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                
                <!-- Principal -->
                <li class="nav-header">PRINCIPAL</li>
                <li class="nav-item">
                    <a href="<?php echo BASE_URL; ?>/home" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Inicio</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo BASE_URL; ?>/citas/create" class="nav-link">
                        <i class="nav-icon fas fa-calendar-alt"></i>
                        <p>Agendar Citas</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo BASE_URL; ?>/triaje" class="nav-link">
                        <i class="nav-icon fas fa-user-nurse"></i>
                        <p>Triaje</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" data-toggle="modal" data-target="#modalHorarioMedico">
                        <i class="nav-icon fas fa-clock"></i>
                        <p>Horario del Médico</p>
                    </a>
                </li>
                
                <!-- Atención -->
                <li class="nav-header">ATENCIÓN MÉDICA</li>
                <li class="nav-item">
                    <a href="<?php echo BASE_URL; ?>/atencion/medica" class="nav-link">
                        <i class="nav-icon fas fa-stethoscope"></i>
                        <p>Medicina General</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo BASE_URL; ?>/atencion/ginecologica" class="nav-link">
                        <i class="nav-icon fas fa-venus"></i>
                        <p>Ginecológica</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo BASE_URL; ?>/atencion/perinatal" class="nav-link">
                        <i class="nav-icon fas fa-baby"></i>
                        <p>Perinatal</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-brain"></i>
                        <p>Psicológica<i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo BASE_URL; ?>/atencion/psicologica" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Atención Psicológica</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo BASE_URL; ?>/anamnesis" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Anamnesis</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Administración -->
                <li class="nav-header">ADMINISTRACIÓNnnn</li>
                <li class="nav-item">
                    <a href="<?php echo BASE_URL; ?>/medicos/create" class="nav-link">
                        <i class="nav-icon fas fa-user-md"></i>
                        <p>Registrar Médicos</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo BASE_URL; ?>/pacientes/create" class="nav-link">
                        <i class="nav-icon fas fa-procedures"></i>
                        <p>Registrar Pacientes</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo BASE_URL; ?>/medicamentos/create" class="nav-link">
                        <i class="nav-icon fas fa-pills"></i>
                        <p>Registrar Medicamentos</p>
                    </a>
                </li>
                
                <!-- Configuración -->
                <li class="nav-header">CONFIGURACIÓN</li>
                <li class="nav-item">
                    <a href="<?php echo BASE_URL; ?>/views/rol/roles.php" class="nav-link">
                        <i class="nav-icon fas fa-users-cog"></i>
                        <p>Roles</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo BASE_URL; ?>/configuracion" class="nav-link">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>Configuración</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo BASE_URL; ?>/logout?action=logout" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Cerrar Sesión</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
