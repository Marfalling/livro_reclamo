<?php 
session_start();
session_unset();
session_destroy();
header('location: ../_vista/index.php');
exit();
?>