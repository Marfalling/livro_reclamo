<?php

function RegistrarReclamo($id_usuario, $tipo_bien, $monto_reclamado, $descripcion, $tipo_reclamo, $detalle_reclamo, $pedido, $menor_edad, $fecha_reclamo,$hora_reclamo, $fecha_respuesta) {

    require("conexion.php");



    $fecha_reclamo = date('Y-m-d');

    $sql = "INSERT INTO reclamaciones (id_usuario, tipo_bien, monto_reclamado, descripcion, tipo_reclamo, detalle_reclamo, pedido, menor_edad, fecha_reclamo, hora_reclamo, fecha_respuesta) 

            VALUES ('$id_usuario', '$tipo_bien', '$monto_reclamado', '$descripcion', '$tipo_reclamo', '$detalle_reclamo', '$pedido', '$menor_edad', '$fecha_reclamo', '$hora_reclamo', '$fecha_respuesta')";

    

    $res = mysqli_query($con, $sql);



    // Obtiene id de la reclamacion recién creada

    $id_reclamacion = mysqli_insert_id($con);



    mysqli_close($con);



    if ($res) {

        return $id_reclamacion; // Retorna el ID de la reclamación

    } else {

        return "Error: " . mysqli_error($con);

    }

}

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


?>
