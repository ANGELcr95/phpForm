<!-- archivo para poder deslogearm de la sesion  -->
<?php
session_start();

session_unset();

session_destroy();

header("Location: index.php")
?>