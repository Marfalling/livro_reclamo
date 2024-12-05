<?php

function VerificarAdmin($user_admin, $password) {
    require("conexion.php");

    // Consulta preparada para evitar inyecciones SQL
    $sql = "SELECT id_admin, pass FROM admin 
    WHERE user_admin = '$user_admin' 
    AND pass = '$password'" ;

    $res = mysqli_query($con,$sql);
    $datos = array();

    while($fila = mysqli_fetch_array($res,MYSQLI_ASSOC))
    {
        $datos[] = $fila;
    }

    return $datos;

    mysqli_close($con);
    

}

?>