<?php
require_once('../_modelo/conexion.php');  // Subir un nivel para acceder a la raíz
// Ejemplo de consulta a la base de datos para obtener los reclamos

require_once('../_modelo/m_reclamaciones.php');
$reclamos = ObtenerReclamos();  // Suponiendo que tienes una función que devuelve los reclamos
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reclamos</title>
    <link rel="stylesheet" href="path/to/bootstrap.css"> <!-- Incluye Bootstrap -->
    <link rel="stylesheet" href="path/to/font-awesome.css"> <!-- Incluye Font Awesome si lo necesitas -->
    <style>
        /* Agregar estilo para el layout */
        .wrapper {
            display: flex;
            min-height: 100vh;
        }
        .sidebar {
            width: 250px;
            position: fixed;
            height: 100%;
            background-color: #343a40;
            color: white;
            
        }
        .content {
            margin-left: 250px; /* Para evitar que el contenido se sobreponga al sidebar */
            width: calc(100% - 250px);
            padding: 20px;
        }
        /* Agregar espacio a la tabla */
        .table {
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="wrapper">
    <!-- Sidebar -->
    <div class="sidebar">
        <?php require_once('../_vista/MenuV.php'); ?>
    </div>

    <!-- Contenido principal -->
    <div class="content">
        <div class="container-fluid px-4">
            <h1 class="mt-4">Reclamos</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Reclamos</li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Lista de Reclamos
                </div>
                <div class="card-body">
                    <table id="datatablesSimple" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">ID Reclamo</th>
                                <th class="text-center">ID Usuario</th>
                                <th class="text-center">Fecha Reclamo</th>
                                <th class="text-center">Hora Reclamo</th>
                                <th class="text-center">Estado</th>
                                <th class="text-center">Respuesta</th>
                                <th class="text-center">Fecha Respuesta</th>
                                <th class="text-center">Ver PDF</th>
                                <th class="text-center">Responder</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                            if (!empty($reclamos)) {
                                $n = 0;
                                foreach ($reclamos as $key => $value) {
                                    $n++;
                                    $id_reclamo = $value['id_reclamacion'];  
                                    $id_usuario = $value['id_usuario'];
                                    $fecha_reclamo = $value['fecha_reclamo'];
                                    $hora_reclamo = $value['hora_reclamo'];
                                    $estado = $value['estado'];
                                    $respuesta = $value['respuesta'];
                                    $fecha_respuesta = $value['fecha_respuesta'];
                                    

                                    // Asignar colores a los estados
                                    $badgeClass = '';
                                    switch ($estado) {
                                        case 'Respondido':
                                            $badgeClass = 'bg-success text-white'; // verde
                                            break;
                                        case 'Pendiente':
                                            $badgeClass = 'bg-warning text-white'; // amarillo
                                            break;
                                        default:
                                            $badgeClass = 'bg-secondary text-white'; // gris por defecto
                                    }
                        ?>
                            <tr>
                                <td class="text-center"><?php echo $n; ?></td>
                                <td class="text-center"><?php echo $id_reclamo; ?></td>
                                <td class="text-center"><?php echo $id_usuario; ?></td>
                                <td class="text-center"><?php echo $fecha_reclamo; ?></td>
                                <td class="text-center"><?php echo $hora_reclamo; ?></td>
                                <td class="text-center">
                                    <!-- Aquí agregamos el badge con la clase dinámica para el estado -->
                                    <span class="badge rounded-pill <?php echo $badgeClass; ?>"><?php echo $estado; ?></span>
                                </td>
                                <td class="text-center"><?php echo $respuesta; ?></td>
                                <td class="text-center"><?php echo $fecha_respuesta; ?></td>
                                <td class="text-center">
                                    <a href="/livro_reclamo/cliente/_vista/reclamo_pdf.php?id_usuario=<?php echo htmlspecialchars($value['id_usuario']); ?>" 
                                       class="btn btn-info btn-sm" 
                                       target="_blank">Ver PDF</a>
                                </td>
                                <td class="text-center">
                                  <a href="../_vista/responder.php?id_reclamo=<?php echo htmlspecialchars($value['id_reclamacion']); ?>" class="btn btn-primary btn-sm">Responder</a>
                                </td>
                            </tr>
                        <?php 
                                }
                            } else {
                                echo "<tr><td colspan='10'>No hay reclamos registrados.</td></tr>";
                            }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>