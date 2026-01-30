<?php 
    $alert = '';

    session_start();

    if (!empty($_SESSION['active'])) 
    {
        header('location: system/');

    }else{

    if(!empty($_POST))
    {
    if (empty($_POST['user']) || empty($_POST['pass'])) 
    {
        $alert = 'Ingrese su Usuario y Contraseña';
    }else{

        require_once "conexion.php";

        $user = mysqli_real_escape_string($conn ,$_POST['user']);
        $pass = md5(mysqli_real_escape_string($conn ,$_POST['pass']));

        $querylog = mysqli_query($conn ,"SELECT * FROM tb_users WHERE username = '$user' AND pass_user = '$pass'");
        mysqli_close($conn);
        $resultlog = mysqli_num_rows($querylog);

        if ($resultlog > 0)
        {
            $data = mysqli_fetch_array($querylog);
            $_SESSION['active']  = true;
            $_SESSION['idUser']  = $data['dni_user'];
            $_SESSION['nombre']  = $data['name_user'];
            $_SESSION['email']   = $data['email_user'];
            $_SESSION['usuario'] = $data['username'];
            $_SESSION['rol']     = $data['rol_user'];

            header('location: system/');
        }else{
            $alert = 'El usuario y/o la contraseña es incorrecta';
            session_destroy();
            }
        }
    }
}
?>