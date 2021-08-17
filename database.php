<!-- para poder conectar la base de datos -->
<!-- defnimos las siguinetes variables para poder conectar con el servidor previamente crando la tabla en phpmysql -->
<?php
$server = 'localhost'; //nombre de servidor
$username = 'root';
$password = '';
$database = 'php_login_database'; // nombre base de datos

try {
  // esta variable conn es para conectar a la base de datos Msql con las variables que creamos
    $conn = new PDO("mysql:host=$server;dbname=$database;",$username,$password); // aqui especificaos los nombres de la variables para conexion exitosa
} catch (PDOException $e_) { // nosmuetsre  atraves de PDO error
  // sila conexion es fallida debe salir el siguiente mensaje
  die('Connected failed: '.$e->getMessage());
}
?>
