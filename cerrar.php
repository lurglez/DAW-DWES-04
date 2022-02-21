<?php

// destruccion de las variables de sesion
session_start();
unset($_SESSION['PHP_AUTH_USER']);
session_destroy();



echo "Se ha cerrado la sesión.";
?>
<a href="preferencias.php"><input type="button" value="Volver Inicio"></a>


