
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <h1 class="brand-link">
      <img src="img/clinica.png" alt="Clinica Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-bold">Centro Médico</span>
    </h1>  
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="img/jmoreno2.jpeg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">José Moreno</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
              with font-awesome or any other icon font library -->
          <li class="nav-header">PRINCIPAL</li>
          <li class="nav-item">
            <a href="home.php" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>Inicio</p>
            </a>            
          </li>
          <li class="nav-item">
            <a href="agendarcitaspre.php" class="nav-link">
              <i class="nav-icon fas fa-calendar-alt"></i>
              <p>Agendar Citas</p>
            </a>            
          </li>
          <li class="nav-item">
            <a href="triaje.php" class="nav-link">
              <i class="nav-icon fas fa-user-nurse"></i>
              <p>Triaje</p>
            </a>            
          </li>
          <li class="nav-item">
            <a href="atencionmedica.php" class="nav-link">
              <i class="nav-icon fas fa-stethoscope"></i>
              <p>Atención Medicina Gen.</p>
            </a>            
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link" data-toggle="modal" data-target="#modalHorarioMedico">
              <i class="nav-icon fas fa-clock"></i>
              <p>Horario del Médico</p>
            </a>            
          </li>
          <li class="nav-item">
            <a href="atencionginecologica.php" class="nav-link">
              <i class="nav-icon fas fa-venus"></i>
              <p>Atención Ginecologica</p>
            </a>            
          </li>

          <li class="nav-item">
            <a href="atencionperinatal.php" class="nav-link">
              <i class="nav-icon fas fa-baby"></i>
              <p>Atención Perinatal</p>
            </a>            
          </li>

          <li class="nav-item">  
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-brain"></i>
              <p>Atención Psicologica<i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="atencionpsicologica.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Atención Psicológica</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="anamnesis.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Anamnesis</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-header">ADMINISTRACIÓN</li>
          <li class="nav-item">
            <a href="regmedicos.php" class="nav-link">
              <i class="nav-icon fas fa-user-md"></i>
              <p>Registrar Medicos</p>
            </a>            
          </li>
          <li class="nav-item">
            <a href="regpacientes.php" class="nav-link">
              <i class="nav-icon fas fa-procedures"></i>
              <p>Registrar Pacientes</p>
            </a>            
          </li>
          <li class="nav-item">
            <a href="regmedicamentos.php" class="nav-link">
              <i class="nav-icon fas fa-pills"></i>
              <p>Registrar Medicamentos</p>
            </a>            
          </li>
          <li class="nav-header">CONFIGURACIÓN</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cog"></i>
              <p>Configuración</p>
            </a>            
          </li>
          <li class="nav-item">
            <a href="logout.php" class="nav-link">
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
