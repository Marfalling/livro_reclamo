<?php

function ObtenerReclamos() {
    
    require('conexion.php');  // Incluir conexion.php para acceder a $con

    // Consulta para obtener los reclamos
    $sql = "SELECT * FROM reclamaciones";
    $resultado = mysqli_query($con, $sql);  // Usamos $con aquí también

    // Verificar si hay resultados
    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $reclamos = [];
        while ($fila = mysqli_fetch_assoc($resultado)) {
            $reclamos[] = $fila;
        }
        return $reclamos;
    } else {
        return []; // Si no hay resultados, retornar un array vacío
    }
}

function ObtenerIDReclamo()
{
    require('conexion.php');

    $id_reclamo = $_GET['id_reclamo'];

    // Consulta para obtener los detalles del reclamo
    $sql = "SELECT * FROM reclamaciones WHERE id_reclamacion = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $id_reclamo);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $reclamo = $resultado->fetch_assoc(); // Obtener un único registro

    // Verificar si se obtuvo el reclamo
    if (!$reclamo) {
        echo "Reclamo no encontrado.";
        exit();
    }

    return $reclamo;
}


?>
