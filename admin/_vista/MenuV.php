<?php
session_start();
// Verifica si el usuario está autenticado
if (!$_SESSION['autentificado']){
    // Si no está autenticado, redirige al login
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background: #f4f6f9;
        }
        #sidebar {
            min-height: 100vh;
            background: linear-gradient(to right, #4a5568, #2d3748);
            color: #fff;
            position: fixed;
            width: 250px;
            transition: width 0.3s;
            box-shadow: 0 15px 50px rgba(0,0,0,0.1);
        }
        #sidebar .sidebar-header {
            background: rgba(255,255,255,0.1);
            padding: 20px;
            text-align: center;
        }
        #sidebar .sidebar-header .user-profile {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 10px;
        }
        #sidebar .sidebar-header .user-profile .user-icon {
            font-size: 3rem;
            color: rgba(255,255,255,0.7);
            margin-bottom: 10px;
        }
        #sidebar .sidebar-header .user-profile .user-name {
            font-size: 1.2rem;
            font-weight: bold;
            color: #fff;
        }
        #sidebar .sidebar-header .user-profile .user-role {
            font-size: 0.9rem;
            color: rgba(255,255,255,0.6);
        }
        #sidebar .nav-link {
            color: rgba(255,255,255,0.7);
            transition: all 0.3s ease;
            padding: 12px 15px;
            border-radius: 5px;
            display: flex;
            align-items: center;
        }
        #sidebar .nav-link:hover {
            color: #fff;
            background: rgba(255,255,255,0.1);
            transform: translateY(-2px);
        }
        #sidebar .sb-sidenav-menu-heading {
            font-size: 0.9rem;
            color: rgba(255,255,255,0.5);
            margin: 15px 0 10px;
            padding: 0 15px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        #sidebar .logout-btn {
            position: absolute;
            bottom: 20px;
            left: 0;
            right: 0;
            padding: 0 15px;
        }
        #sidebar .logout-btn .nav-link {
            background: #dc3545;
            color: white;
            justify-content: center;
            transition: all 0.3s ease;
        }
        #sidebar .logout-btn .nav-link:hover {
            background: #c82333;
            transform: translateY(-3px);
        }
        .collapse-icon {
            margin-left: auto;
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <div class="user-profile">
                    <i class="fas fa-user-circle user-icon"></i>
                    <div class="user-name">
                        <?php echo $_SESSION['nom_session']; 
                        ?>
                    </div>
                    <div class="user-role">Administrador</div>
                </div>
            </div>
            <hr class="bg-white my-0 opacity-25">
            <div class="nav flex-column p-3">
                <div class="sb-sidenav-menu-heading">Gestión de Reclamos</div>

                <!-- Reclamos -->
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#listaReclamos" aria-expanded="false">
                    <i class="fas fa-clipboard-list mr-3"></i> 
                    Reclamos
                    <i class="fas fa-angle-down collapse-icon"></i>
                </a>
                <div class="collapse" id="listaReclamos">
                    <nav class="nav flex-column ml-3">
                        <a class="nav-link" href="../_vista/panel_admin.php" id="listado-link">Listado</a>
                    </nav>
                </div>
            </div>

            <!-- Botón de Cierre de Sesión -->
            <div class="logout-btn">
                <a href="../_controlador/logout.php" class="nav-link">
                    <i class="fas fa-sign-out-alt mr-2"></i> Cerrar Sesión
                </a>
            </div>
        </nav>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>