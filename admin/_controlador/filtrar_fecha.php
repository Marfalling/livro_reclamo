<?php
// Incluye la conexión a la base de datos
include('../_modelo/conexion.php');
require_once('../_modelo/m_reclamaciones.php');

// Establecer la zona horaria
date_default_timezone_set('America/Lima');

// Fechas predeterminadas
$fecha_actual = date('Y-m-d');
$fecha_30_dias_antes = date('Y-m-d', strtotime('-30 days'));


if (isset($_POST['buscar'])) {
    // Obtener las fechas desde el formulario (manejo seguro)
    $fecha_inicio = $_POST['fecha_inicio'] ?? '';
    $fecha_fin = $_POST['fecha_fin'] ?? '';

    // Validar si las fechas están vacías
    if (empty($fecha_inicio)) {
        $fecha_inicio = $fecha_30_dias_antes;
    }

    if (empty($fecha_fin)) {
        $fecha_fin = $fecha_actual;
    }

    // Llamar a la función para obtener los reclamos según el rango de fechas
    $reclamos = ObtenerReclamosPorFecha($fecha_inicio, $fecha_fin);
} else {
    // Si no se ha enviado el formulario, usar las fechas predeterminadas
    $fecha_inicio = $fecha_30_dias_antes;
    $fecha_fin = $fecha_actual;

    // Llamar a la función para obtener los reclamos según el rango de fechas predeterminados
    $reclamos = ObtenerReclamosPorFecha($fecha_inicio, $fecha_fin);
}


?>
