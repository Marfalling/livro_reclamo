<?php
// Incluye la conexión a la base de datos
include('../_modelo/conexion.php');
require_once('../_modelo/m_reclamaciones.php');

// Verificar si se envió un criterio de búsqueda
$criterio = $_POST['criterio'] ?? ''; // Si no existe, asignar una cadena vacía

// Verificar si se envió el formulario de búsqueda
if (isset($_POST['buscar'])) {
    if (!empty($criterio)) {
        // Llamar a la función para buscar reclamos según el criterio
        $reclamos = ObtenerReclamosPorNombreOID($criterio);
    } else {
        // Si no hay criterio, obtén todos los reclamos
        $reclamos = ObtenerReclamosPorFecha($fecha_inicio, $fecha_fin);
    }
} else {
    // Si no se ha enviado el formulario, obtén todos los reclamos
    $reclamos = ObtenerReclamosPorFecha($fecha_inicio, $fecha_fin);
}
?>
