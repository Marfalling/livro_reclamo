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
    $sql = "SELECT r.*, u.nombre, u.cel_usuario, u.email_usuario 
            FROM reclamaciones r
            JOIN usuario u ON r.id_usuario = u.id_usuario
            WHERE id_reclamacion = ?";
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

function ObtenerReclamosPorFecha($fecha_inicio, $fecha_fin) {
    require('conexion.php');
    // Consulta para obtener los reclamos entre las fechas proporcionadas
    $sql = "SELECT r.*, u.nombre FROM reclamaciones r
    JOIN usuario u ON r.id_usuario = u.id_usuario
    WHERE r.fecha_reclamo BETWEEN ? AND ?";

    $stmt = $con->prepare($sql);
    $stmt->bind_param("ss", $fecha_inicio, $fecha_fin);
    $stmt->execute();
    $resultado = $stmt->get_result();

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

function actualizarRespuesta($id_reclamo, $respuesta) {
    require('conexion.php');

    // Prepara la consulta
    $sql = "UPDATE reclamaciones 
            SET respuesta = ?, estado = 'Respondido', fecha_respuesta = NOW() 
            WHERE id_reclamacion = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("si", $respuesta, $id_reclamo);
    
    // Ejecuta la consulta y retorna el resultado
    return $stmt->execute();
}



?>
