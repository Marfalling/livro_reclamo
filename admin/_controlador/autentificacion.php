<?php 
session_start();

// Obtener los datos del formulario de login
$user_admin = $_POST['user_admin'];
$password = $_POST['password'];

require("../_modelo/m_admin.php");

// Verificar las credenciales
$admin = VerificarAdmin($user_admin, $password);

// Si existe este usuario
if ($admin != NULL) 
{

    foreach($user_admin as $key => $value)
    {
        $id_admin = $value['id_admin'];
        $user_admin = $value['user_admin'];
        $password = $value['password'];
    }

    //crear variables de sesion que se van a mantener durante
    //todo el proceso del sistema
    $_SESSION['autentificado'] = TRUE;
    $_SESSION['id_session'] = $id_admin;
    $_SESSION['nom_session'] = $user_admin;

    echo "<script type='text/javascript'>window.location.href = '../_vista/MenuV.php';</script>";
    exit();

}
else
{
    header('location: ../_vista/index.php');
}
?>

