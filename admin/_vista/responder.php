<?php

require_once('../_modelo/conexion.php');
require_once('../_modelo/m_reclamaciones.php');

$reclamo = ObtenerIDReclamo();  // función que devuelve los reclamos por id

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Responder Reclamo #<?= $reclamo['id_reclamacion'] ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <style>
        .card-header {
            background-color: #f8f9fa;
            border-bottom: 2px solid #007bff;
        }
        .detail-label {
            font-weight: bold;
            color: #495057;
        }
    </style>
</head>
<body>

<div class="sidebar">
        <?php require_once('../_vista/MenuV.php'); ?>
    </div>

    <div class="container mt-4">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <div class="card shadow-lg">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="../_vista/panel_admin.php" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Volver
                            </a>
                            <h3 class="mb-0">Responder Reclamo #<?= $reclamo['id_reclamacion'] ?></h3>
                            
                            <div style="width: 85px"></div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <p class="detail-label">Fecha del Reclamo:</p>
                                <p><?= htmlspecialchars($reclamo['fecha_reclamo']) ?></p>
                                
                                <p class="detail-label">Tipo de Bien:</p>
                                <p><?= htmlspecialchars($reclamo['tipo_bien']) ?></p>
                                
                                <p class="detail-label">Monto Reclamado:</p>
                                <p>S/.<?= number_format($reclamo['monto_reclamado'], 2) ?></p>

                                <p class="detail-label">Correo del Usuario:</p>
                                <p><?= htmlspecialchars($reclamo['email_usuario']) ?></p>

                            </div>
                            
                            <div class="col-md-6">
                                <p class="detail-label">Nombre del Usuario:</p>
                                <p><?= htmlspecialchars($reclamo['nombre']) ?></p>

                                <p class="detail-label">Tipo de Reclamo:</p>
                                <p><?= htmlspecialchars($reclamo['tipo_reclamo']) ?></p>
                                
                                <p class="detail-label">Estado Actual:</p>
                                <?php
                                $estado = $reclamo['estado'];

                                $badgeClass = '';
                                switch ($estado) {
                                    case 'Pendiente':
                                        $badgeClass = 'bg-warning text-white'; // Amarillo
                                        break;
                                    case 'Respondido':
                                        $badgeClass = 'bg-success text-white'; // Verde
                                        break;
                                    default:
                                        $badgeClass = 'bg-secondary text-white'; // Gris
                                }
                                ?>
                                <span class="badge <?php echo $badgeClass; ?>">
                                    <?php echo htmlspecialchars($estado); ?>
                                </span>

                                <p class="detail-label">Celular de contacto:</p>
                                <p><?= htmlspecialchars($reclamo['cel_usuario']) ?></p>
                            </div>
                        </div>

                        <div class="mb-4">
                            <p class="detail-label">Descripción del Reclamo:</p>
                            <div class="card bg-light p-3">
                                <?= htmlspecialchars($reclamo['descripcion']) ?>
                            </div>
                        </div>

                        <?php if ($reclamo['respuesta']): ?>
                            <div class="alert alert-info mb-4">
                                <strong>Respuesta Anterior:</strong>
                                <?= htmlspecialchars($reclamo['respuesta']) ?>
                            </div>
                        <?php endif; ?>

                        <form action="../_controlador/enviar_respuesta.php" method="post">
                            <div class="form-group mb-3">
                                <label for="respuesta">Nueva Respuesta:</label>
                                <textarea 
                                    class="form-control" 
                                    name="respuesta" 
                                    id="respuesta" 
                                    rows="3" 
                                    placeholder="Escriba su respuesta detallada aquí"
                                    required
                                ></textarea>
                            </div>
                            
                            <input type="hidden" name="id_reclamo" value="<?= $reclamo['id_reclamacion'] ?>">
                            
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    Enviar Respuesta
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
