<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Gestión de Roles</title>
  <link rel="icon" href="../img/clinica.png" type="image/png">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="../public/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="../public/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="../public/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="../public/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <link rel="stylesheet" href="../public/plugins/toastr/toastr.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
  </nav>

  <?php include 'includes/sidebar.php' ?>

  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Gestión de Roles</h1>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title mb-0">Usuarios y Roles</h3>
                <div class="card-tools">
                  <button class="btn btn-success btn-sm" id="btnAbrirCrearUsuario"><i class="fas fa-user-plus"></i> Crear Usuario</button>
                  <button class="btn btn-primary btn-sm" id="btnAbrirCrearRol"><i class="fas fa-plus"></i> Crear Rol</button>
                  <button class="btn btn-warning btn-sm" id="btnAbrirAsignarAcceso"><i class="fas fa-key"></i> Asignar Acceso</button>
                </div>
                              <!-- Modal Asignar Acceso a Roles -->
                              <div class="modal fade" id="modalAsignarAcceso" tabindex="-1" role="dialog" aria-labelledby="modalAsignarAccesoLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="modalAsignarAccesoLabel">Asignar Acceso a Roles</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                      <table class="table table-bordered" id="tablaRolesAcceso">
                                        <thead>
                                          <tr>
                                            <th>Rol</th>
                                            <th>Acción</th>
                                          </tr>
                                        </thead>
                                        <tbody></tbody>
                                      </table>
                                    </div>
                                  </div>
                                </div>
                              </div>

                              <!-- Modal Menús por Rol -->
                              <div class="modal fade" id="modalMenusRol" tabindex="-1" role="dialog" aria-labelledby="modalMenusRolLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                  <form id="formMenusRol">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="modalMenusRolLabel">Asignar Menús al Rol: <span id="nombreRolMenus"></span></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body" id="contenedorMenusRol">
                                        <!-- Aquí se cargan los menús con checkboxes vía AJAX -->
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                      </div>
                                    </div>
                                  </form>
                                </div>
                              </div>
              </div>
              <div class="card-body">
                <table id="tablaUsuarios" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>DNI</th>
                      <th>Usuario</th>
                      <th>Nombre</th>
                      <th>Email</th>
                      <th>Roles</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody></tbody>
                </table>

                <!-- Modal Asignar Roles -->
                <div class="modal fade" id="modalAsignarRol" tabindex="-1" role="dialog" aria-labelledby="modalAsignarRolLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="modalAsignarRolLabel">Asignar Roles</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <input type="hidden" id="dniUsuarioSeleccionado">
                        <div class="form-group">
                          <label for="selectRol">Roles</label>
                          <select id="selectRol" class="form-control select2" style="width: 100%;" multiple></select>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" id="btnGuardarRol">Guardar</button>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Modal Crear Rol -->
                <div class="modal fade" id="modalCrearRol" tabindex="-1" role="dialog" aria-labelledby="modalCrearRolLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="modalCrearRolLabel">Crear Rol</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="form-group">
                          <label for="inputNombreRol">Nombre del Rol</label>
                          <input type="text" class="form-control" id="inputNombreRol" placeholder="Ej: Administrador" />
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" id="btnGuardarNuevoRol">Guardar Rol</button>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Modal Crear Usuario -->
                <div class="modal fade" id="modalCrearUsuario" tabindex="-1" role="dialog" aria-labelledby="modalCrearUsuarioLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="modalCrearUsuarioLabel">Crear Usuario</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="inputDni">DNI</label>
                            <input type="text" class="form-control" id="inputDni" maxlength="15" />
                          </div>
                          <div class="form-group col-md-6">
                            <label for="inputUsuario">Usuario</label>
                            <input type="text" class="form-control" id="inputUsuario" />
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="inputNombre">Nombre</label>
                            <input type="text" class="form-control" id="inputNombre" />
                          </div>
                          <div class="form-group col-md-6">
                            <label for="inputEmail">Email</label>
                            <input type="email" class="form-control" id="inputEmail" />
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="inputPass">Contraseña</label>
                            <input type="password" class="form-control" id="inputPass" />
                          </div>
                          <div class="form-group col-md-6">
                            <label for="selectRolesNuevoUsuario">Rol</label>
                            <select id="selectRolesNuevoUsuario" class="form-control select2" style="width: 100%;">
                              <option value="">Seleccione un rol</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" id="btnGuardarNuevoUsuario">Guardar Usuario</button>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Modal Editar Usuario -->
                <div class="modal fade" id="modalEditarUsuario" tabindex="-1" role="dialog" aria-labelledby="modalEditarUsuarioLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="modalEditarUsuarioLabel">Editar Usuario</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <input type="hidden" id="editDni">
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="editUsuario">Usuario</label>
                            <input type="text" class="form-control" id="editUsuario" />
                          </div>
                          <div class="form-group col-md-6">
                            <label for="editNombre">Nombre</label>
                            <input type="text" class="form-control" id="editNombre" />
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="editEmail">Email</label>
                            <input type="email" class="form-control" id="editEmail" />
                          </div>
                          <div class="form-group col-md-6">
                            <label for="editPass">Nueva Contraseña (opcional)</label>
                            <input type="password" class="form-control" id="editPass" placeholder="Dejar vacío para mantener" />
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" id="btnActualizarUsuario">Actualizar</button>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <footer class="main-footer">
    <div class="float-right d-none d-sm-inline"></div>
    <strong>Copyright &copy; 2025.</strong> Todos los derechos reservados.
  </footer>
  <aside class="control-sidebar control-sidebar-dark"></aside>
</div>

<script src="../public/plugins/jquery/jquery.min.js"></script>
<script src="../public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../public/plugins/select2/js/select2.full.min.js"></script>
<script src="../public/plugins/toastr/toastr.min.js"></script>
<script src="../public/dist/js/adminlte.min.js"></script>

<script>
$(function() {
  $('.select2').select2({ theme: 'bootstrap4' });
  cargarUsuarios();
  cargarRoles();

  $('#tablaUsuarios').on('click', '.btn-asignar', function() {
    const dni = $(this).data('dni');
    $('#dniUsuarioSeleccionado').val(dni);
    precargarRolesUsuario(dni);
    $('#modalAsignarRol').modal('show');
  });

  $('#btnGuardarRol').on('click', function() {
    const dni = $('#dniUsuarioSeleccionado').val();
    const roles = $('#selectRol').val();
    if (!dni || !roles || roles.length === 0) {
      toastr.error('Seleccione usuario y al menos un rol');
      return;
    }
    $.ajax({
      url: 'api/asignar-roles.php',
      method: 'POST',
      data: { dni_user: dni, id_roles: roles },
    })
    .done(function(resp) {
      toastr.success('Roles asignados');
      $('#modalAsignarRol').modal('hide');
      cargarUsuarios();
    })
    .fail(function() { toastr.error('Error al asignar roles'); });
  });

  // Botón para abrir modal de asignar acceso
  $('#btnAbrirAsignarAcceso').on('click', function() {
    cargarTablaRolesAcceso();
    $('#modalAsignarAcceso').modal('show');
  });

  // Cargar tabla de roles en el modal de acceso
  function cargarTablaRolesAcceso() {
    $.getJSON('api/listar-roles.php', function(data) {
      const roles = data.roles || data;
      const tbody = $('#tablaRolesAcceso tbody');
      tbody.empty();
      roles.forEach(function(rol) {
        tbody.append(`<tr>
          <td>${rol.nom_rol}</td>
          <td><button class='btn btn-primary btnDarAccesoMenus' data-id='${rol.id_rol}' data-nombre='${rol.nom_rol}'><i class='fas fa-check-square'></i> Dar Acceso</button></td>
        </tr>`);
      });
    });
  }

  // Abrir modal de menús para un rol
  $('#tablaRolesAcceso').on('click', '.btnDarAccesoMenus', function() {
    var idRol = $(this).data('id');
    var nombreRol = $(this).data('nombre');
    $('#nombreRolMenus').text(nombreRol);
    $('#formMenusRol').data('idrol', idRol);
    cargarMenusConChecks(idRol);
    $('#modalMenusRol').modal('show');
  });

  // Cargar menús y checks para el rol
  function cargarMenusConChecks(idRol) {
    $.getJSON('api/listar-menus.php', function(menus) {
      $.getJSON('api/listar-roles-menus.php?id_rol=' + idRol, function(permisos) {
        // Agrupar menús por parent_id
        let grupos = {};
        menus.forEach(function(menu) {
          let grupo = menu.parent_id ? menus.find(m => m.id_menu == menu.parent_id)?.nombre_menu : 'Menús Principales';
          if (!grupo) grupo = 'Menús Principales';
          if (!grupos[grupo]) grupos[grupo] = [];
          grupos[grupo].push(menu);
        });
        let html = '<table class="table table-bordered"><thead><tr><th>Menú</th><th>Acceso</th></tr></thead><tbody>';
        Object.keys(grupos).forEach(function(grupo) {
          html += `<tr><th colspan='2' style='background:#f4f6f9'>${grupo}</th></tr>`;
          grupos[grupo].forEach(function(menu) {
            const checked = permisos.includes(menu.id_menu.toString()) ? 'checked' : '';
            html += `<tr><td>${menu.nombre_menu}</td><td><input type='checkbox' class='chkMenuRol' value='${menu.id_menu}' ${checked}></td></tr>`;
          });
        });
        html += '</tbody></table>';
        $('#contenedorMenusRol').html(html);
      });
    });
  }

  // Al marcar/desmarcar un menú
  $('#formMenusRol').on('change', '.chkMenuRol', function() {
    var idRol = $('#formMenusRol').data('idrol');
    var idMenu = $(this).val();
    var acceso = $(this).is(':checked') ? 1 : 0;
    $.post('api/actualizar-rol-menu.php', {
      id_rol: idRol,
      id_menu: idMenu,
      acceso: acceso
    }, function(resp) {
      if (acceso) {
        toastr.success('¡Acceso guardado con éxito!');
      } else {
        toastr.success('¡Acceso eliminado con éxito!');
      }
    });
  });

  $('#btnAbrirCrearRol').on('click', function(){
    $('#inputNombreRol').val('');
    $('#modalCrearRol').modal('show');
  });

  $('#btnGuardarNuevoRol').on('click', function(){
    const nombre = $('#inputNombreRol').val().trim();
    if (!nombre) { toastr.error('Ingrese un nombre de rol'); return; }
    $.post('api/crear-rol.php', { nom_rol: nombre })
      .done(function(resp){
        toastr.success('Rol creado');
        $('#modalCrearRol').modal('hide');
        cargarRoles();
      })
      .fail(function(){ toastr.error('Error al crear rol'); });
  });

  $('#btnAbrirCrearUsuario').on('click', function(){
    $('#inputDni, #inputUsuario, #inputNombre, #inputEmail, #inputPass').val('');
    cargarRolesEn('#selectRolesNuevoUsuario');
    $('#modalCrearUsuario').modal('show');
  });

  $('#btnGuardarNuevoUsuario').on('click', function(){
    const dni = $('#inputDni').val().trim();
    const usuario = $('#inputUsuario').val().trim();
    const nombre = $('#inputNombre').val().trim();
    const email = $('#inputEmail').val().trim();
    const pass = $('#inputPass').val();
    const rol = $('#selectRolesNuevoUsuario').val();
    if (!dni || !usuario || !nombre || !email || !pass || !rol) {
      toastr.error('Complete todos los campos');
      return;
    }
    $.ajax({
      url: 'api/crear-usuario.php',
      method: 'POST',
      data: { dni_user: dni, user_user: usuario, name_user: nombre, email_user: email, pass_user: pass, id_rol: rol },
    })
    .done(function(resp){
      toastr.success('Usuario creado');
      $('#modalCrearUsuario').modal('hide');
      cargarUsuarios();
    })
    .fail(function(){ toastr.error('Error al crear usuario'); });
  });

  $('#tablaUsuarios').on('click', '.btn-editar', function() {
    const dni = $(this).data('dni');
    const usuario = $(this).data('usuario');
    const nombre = $(this).data('nombre');
    const email = $(this).data('email');
    $('#editDni').val(dni);
    $('#editUsuario').val(usuario);
    $('#editNombre').val(nombre);
    $('#editEmail').val(email);
    $('#editPass').val('');
    $('#modalEditarUsuario').modal('show');
  });

  $('#btnActualizarUsuario').on('click', function() {
    const dni = $('#editDni').val();
    const usuario = $('#editUsuario').val().trim();
    const nombre = $('#editNombre').val().trim();
    const email = $('#editEmail').val().trim();
    const pass = $('#editPass').val();
    if (!usuario || !nombre || !email) {
      toastr.error('Complete los campos requeridos');
      return;
    }
    $.ajax({
      url: 'api/editar-usuario.php',
      method: 'POST',
      data: { dni_user: dni, user_user: usuario, name_user: nombre, email_user: email, pass_user: pass },
    })
    .done(function(resp){
      toastr.success('Usuario actualizado');
      $('#modalEditarUsuario').modal('hide');
      cargarUsuarios();
    })
    .fail(function(){ toastr.error('Error al actualizar usuario'); });
  });

  $('#tablaUsuarios').on('click', '.btn-eliminar', function() {
    const dni = $(this).data('dni');
    const nombre = $(this).data('nombre');
    if (!confirm(`¿Está seguro de eliminar al usuario ${nombre}?`)) return;
    $.ajax({
      url: 'api/eliminar-usuario.php',
      method: 'POST',
      data: { dni_user: dni },
    })
    .done(function(resp){
      toastr.success('Usuario eliminado');
      cargarUsuarios();
    })
    .fail(function(){ toastr.error('Error al eliminar usuario'); });
  });
});

function cargarUsuarios() {
  $.getJSON('api/listar-usuarios.php', function(data) {
    const tbody = $('#tablaUsuarios tbody');
    tbody.empty();
    if (!data || data.length === 0) {
      tbody.append('<tr><td colspan="6" class="text-center text-muted">No hay usuarios registrados</td></tr>');
      return;
    }
    data.forEach(function(u) {
      const roles = u.roles || '';
      const fila = `<tr>
        <td>${u.dni_user}</td>
        <td>${u.user_user || ''}</td>
        <td>${u.name_user || ''}</td>
        <td>${u.email_user || ''}</td>
        <td>${roles}</td>
        <td>
          <button class="btn btn-sm btn-primary btn-asignar" data-dni="${u.dni_user}"><i class="fas fa-user-shield"></i></button>
          <button class="btn btn-sm btn-warning btn-editar" data-dni="${u.dni_user}" data-usuario="${u.user_user || ''}" data-nombre="${u.name_user || ''}" data-email="${u.email_user || ''}"><i class="fas fa-edit"></i></button>
          <button class="btn btn-sm btn-danger btn-eliminar" data-dni="${u.dni_user}" data-nombre="${u.name_user || ''}"><i class="fas fa-trash"></i></button>
        </td>
      </tr>`;
      tbody.append(fila);
    });
  });
}

function cargarRoles() {
  $.getJSON('api/listar-roles.php', function(data) {
    const select = $('#selectRol');
    select.empty();
    const roles = data.roles || data;
    roles.forEach(function(r) {
      select.append(`<option value="${r.id_rol}">${r.nom_rol}</option>`);
    });
  });
}

function cargarRolesEn(selector) {
  $.getJSON('api/listar-roles.php', function(data) {
    const select = $(selector);
    select.empty();
    select.append('<option value="">Seleccione un rol</option>');
    const roles = data.roles || data;
    roles.forEach(function(r) {
      select.append(`<option value="${r.id_rol}">${r.nom_rol}</option>`);
    });
  });
}

function precargarRolesUsuario(dni) {
  $.getJSON('api/listar-usuarios.php', function(data){
    const user = data.find(u => u.dni_user === dni);
    if (user && user.roles_ids) {
      const ids = user.roles_ids.split(',').filter(Boolean);
      $('#selectRol').val(ids).trigger('change');
    } else {
      $('#selectRol').val(null).trigger('change');
    }
  });
}
</script>

</body>
</html>
