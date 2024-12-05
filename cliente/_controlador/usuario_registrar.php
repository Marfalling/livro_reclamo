<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Registro de Usuarios</title>
    </head>
    <body class="sb-nav-fixed">

  
        <div id="layoutSidenav">
            

            <div id="layoutSidenav_content">
                <main>
                <?php
                require("../_modelo/m_usuario.php");

                //de esta forma recojo los datos de mi formulario
                    //Si presiono en el botón registrar voy a recepecionar los datos que están
                    if (isset($_REQUEST['registrar']))
                    {
                        $tipo_documento = $_REQUEST['tipo_documento'];
                        $num_documento = $_REQUEST['num_documento'];
                        $nom = $_REQUEST['nom'];
                        $ape_paterno = $_REQUEST['ape_paterno'];
                        $ape_materno = $_REQUEST['ape_materno'];
                        $tipo_resp = $_REQUEST['tipo_resp'];
                        $dir = $_REQUEST['dir'];
                        $cel = $_REQUEST['cel'];
                        $email = $_REQUEST['email'];
                        
                        // Ahora puedo llamar la funcion RegistrarUsuario
                        $rpta = RegistrarUsuario($tipo_documento, $num_documento, $nom, $ape_paterno, $ape_materno, $tipo_resp, $dir, $cel, $email);
                    
                        if ($rpta) 
                        {
                            // Redirigir con el id del usuario recién creado
                           // header("Location: ../formBienContratado.php?id=".$rpta);
                           echo "<script type='text/javascript'>window.location.href = '../_vista/formBienContratado.php?id=" . $rpta . "';</script>";

                        } else {
                            echo "<p>Error al registrar el usuario. Intente nuevamente.</p>";
                        }
                    }
                    
                    require_once("../_complemento/vista/footer.php");
                ?>          
                </main>
                <footer class="py-4 bg-light mt-auto">
                <?php
                require_once("../_complemento/vista/footer.php");
                ?>
                </footer>
            </div>
        </div>

    </body>
</html>
