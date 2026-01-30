<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso al Sistema Clínico</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/css/stylelogin.css">
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <h1>Sistema Médico Integral</h1>
        </div>

        <form id="loginForm" autocomplete="off">
            <div class="form-group">
                <label for="inputUser"><span class="medical-icon">🩺</span> Usuario</label>
                <input type="text" id="inputUser" name="user" placeholder="Ingrese su usuario o email" autocomplete="username" required>
            </div>
            <div class="form-group">
                <label for="inputPass"><span class="medical-icon">🔒</span> Contraseña</label>
                <div class="password-container">
                    <input type="password" id="inputPass" name="pass" placeholder="Ingrese su contraseña" autocomplete="current-password" required>
                    <button type="button" class="toggle-password" id="togglePassword">👁️</button>
                </div>
            </div>
            <div id="loginError" style="color:red;margin-top:10px;"></div>
            <div class="remember-forgot">
                <div class="forgot-password">
                    <a href="#">¿Olvidó su contraseña?</a>
                </div>
            </div>
            <button type="button" class="login-button" id="btnLogin">Acceder al sistema</button>
        </form>

        <div class="login-footer">
            <p>¿Necesita ayuda? <a href="#">Contacte al soporte técnico</a></p>
        </div>
    </div>

        <script>
            window.BASE_URL = '<?php echo BASE_URL; ?>';
        </script>
        <script src="<?php echo BASE_URL; ?>/public/plugins/jquery/jquery.min.js"></script>
        <script src="<?php echo BASE_URL; ?>/public/js/login.js"></script>
</body>
</html>
