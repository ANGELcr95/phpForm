<?php
session_start(); // puedo ver si la inicializacion existe  y compartir la infp entre las paginas
require 'database.php';
if (isset($_SESSION['user_id'])) { // si existe esta varible SESSION vamos a mandarlo a user_id dentro de nuestr sesion 
  $records = $conn->prepare('SELECT id, email, password FROM users WHERE id= :id'); // vamsoa aconusltar a la base de datos donde id sea igual aun parametro que voya pasarle
  $records->bindParam(':id', $_SESSION['user_id']); // vicular ese parametro id
  $records->execute();
  $results = $records->fetch(PDO::FETCH_ASSOC); // obtenr todos estos reultados y giradrlos ne la variable results
  $user = null;
  if(count($results)> 0){
    $user = $results;
  }
}
?>
<!-- este index es la la pagina donde pueede decdir logearse o no registarse -->
<!DOCTYPE html> 
<html lang="es">
  <head>
    <meta charset="utf-8"/>
    <title>Compras</title>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1,maximum-scale=1, minimum-scale=1">
    <link rel="stylesheet" href="https://fonts.google.com/">
    <link rel="stylesheet" href="./Styles/index.css">
  </head>
    
  <header>
    <div class="banner">
      <img src="./img/fondo_arentio_1.jpg" alt="Fondo de registro">
		</div> 
    <div class="contenedor">
      <?php 
        if(!empty($user)): 
        ?>
        <div class="picture">
        <img id ="picture" src="img/foto.png" alt="perfil" >
        </div>
        <div class="welcome">
        <br id="hola"> Welcome. <?= $user['email'] ?>
        <br> You are Sucessfully Logged In...
        </div>
        <a class="logout" href="logout.php">Logout</a>
        <?php else: ?>
        <h1> Please Login or SingUp</h1>
        <div class="index">
          <a href="login.php" >Login</a> or 
          <a href="singup.php" >SingUp</a>
        </div> 
      
      <?php endif; ?> 
     
    </div>
  </header>
</html>
