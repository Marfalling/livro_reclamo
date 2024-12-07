<?php
// Incluye la conexión a la base de datos
include('../_modelo/conexion.php');
require_once('../_modelo/m_reclamaciones.php');

// Verifica si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtiene los datos enviados desde el formulario
    $id_reclamo = isset($_POST['id_reclamo']) ? $_POST['id_reclamo'] : null;
    $respuesta = isset($_POST['respuesta']) ? $_POST['respuesta'] : null;

    // Verifica que ambos campos tengan valores
    if ($id_reclamo && $respuesta) {
        // Llama a la función `actualizarRespuesta` del modelo
        $resultado = actualizarRespuesta($id_reclamo, $respuesta);

        // Comprueba si la actualización fue exitosa
        if ($resultado) {
            // Redirige al panel de administrador
            echo "<script type='text/javascript'>window.location.href = '../_vista/panel_admin.php';</script>";
            exit();
        } else {
            echo "Error al actualizar la respuesta.";
        }
    } else {
        echo "Por favor ingresa una respuesta válida.";
    }
}

?>
