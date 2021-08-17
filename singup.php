<!-- archivo de registro -->
<!-- archivo para poder cragar buestros datos -->
<?php
 
require 'database.php';  //aqui traigo la base de datos a esta hoja de php con e
$message = null;// varibale global de acuerdo a loq ue de el if despues ejecutar el estaiment con que objetivo depsues mandarlo al html

if (!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['confirm_password'] && $_POST['confirm_password'] == $_POST['password'])) { // condicional si las input no estan vacias ejecutar el siguiente codigo
    $sql = "INSERT INTO users (email, password, confirm_password) VALUES (:email, :password, :confirm_password)"; // para insertar datos ne sql de la tabla users con los parametros em y passwrod qeu son extraidos de name de los input correpondintes
    $stmt = $conn->prepare($sql); //ejecustar por metodo prepare hacer una consulta de sql y es a esta definida en la variable arriba sql
    $stmt->bindParam(':email',$_POST['email']); // vincular parametros con el nombre de la variable especificada
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // vamos a guardar enun avariable el metodo post en la columna coincidiente del nombre donde declaramos en la base de datos pero es columan va a estar  encriptada
    $stmt->bindParam(':password', $password);
    $confirm_password = password_hash($_POST['confirm_password'], PASSWORD_BCRYPT); // pasar el dato pero cifrado sin saber las contrasenas
    $stmt->bindParam(':confirm_password', $confirm_password);
    

    if($stmt->execute()) { // si ejecutamos todo bien enviar el mensaje de abajo y ha sido creado
        $message = 'Successfully created new user';
    }
} 
else {
		$message = 'Enter the data';
}
	
?> 

<!-- pagina de registro de usuario -->
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Compras</title>
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1,maximum-scale=1, minimum-scale=1">
        <link rel="stylesheet" href="./Styles/singup.css">
		<link rel="stylesheet" href="./Styles/conditions.css">
    </head>
    
    <header>
		<div class="banner">
			<img src="./img/fondo_arentio_1.jpg" alt="Fondo de registro">
		</div> 

		<div class="contenedor">
			<?php if(!empty($message)) : ?> 
				<p class="message"><?=$message ?></p>
			<?php endif; ?>
     
			<h1>SingUp</h1>
			<span><a href="index.php">Index</a> or <a href="login.php">Login</a></span>
			<div class="general">
				<div class="alterno">
					<!-- el action envia losa tos a la direccion que se especifique en ella -->
					<form action="singup.php" method="post" id="formulario" > 

						<!-- correo inpu -->
						<div class="formulario__grupo" id="grupo__email">
							<!-- <label for="usuario" class= "formulario__label">Correo Electrónico</label> -->
							<div class="formulario__grupo-input">
								<input type="text" id="usuario" class="formulario__input" name="email" placeholder="Enter your email" >
								<i class="formulario__validacion-estado fas fa-times-circle"></i>
							</div>
							<p class="formulario__input-error">El correo solo puede contener letras, numeros, puntos, guiones y guion bajo.</p>
						</div>

						<!-- password input -->
						<div class="formulario__grupo" id="grupo__password">
							<!-- <label for="password1" class="formulario__label">Contraseña</label> -->
							<div class="formulario__grupo-input">
								<input type="password" id="password1"  class="formulario__input" name="password" placeholder="Enter your password" >
								<i class="formulario__validacion-estado fas fa-times-circle"></i>
								<img id ="eye" src="img/show.png" alt="Visualizacion" >
							</div>
							<p class="formulario__input-error">La contraseña tiene que ser de 4 a 12 dígitos.</p>
						</div>
			
						<!-- confirm password  -->
						<div class="formulario__grupo" id="grupo__confirm_password">
							<!-- <label for="password2" class="formulario__label">Repetir Contraseña</label> -->
							<div class="formulario__grupo-input">
								<input type="password" id="password2" class="formulario__input" name="confirm_password" placeholder="Confirm your password" >
								<i class="formulario__validacion-estado fas fa-times-circle"></i>
								<img id ="eye2" src="img/show.png" alt="Visualizacion" >
							</div>
							<p class="formulario__input-error">Ambas contraseñas deben ser iguales.</p>
						</div>

						<div class="formulario__grupo" id="grupo__condiciones">
							<!-- <div class="formulario__grupo-input">  -->
								<input type="checkbox" id="condiciones" name ="condiciones"  >
								<button id="conditions">Terminos y condiciones</button> 
								<i class="formulario__validacion-estado fas fa-times-circle"></i>
							<!-- </div> -->
							<p class="formulario__input-error">Debe aceptar terminos y condiciones</p>
						</div>
						
						<!-- send input -->
						<input type="submit" id="into" value="SingUp" >
					</form> 
				</div>
			</div>

			<div>
				<div id="modal_container" class="modal-container">
				<div class="modal">
					<h2>Es una prueba de Acepto Condiciones</h2>
					<p>
					Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque assumenda dignissimos illo explicabo natus quia repellat, praesentium voluptatibus harum ipsam dolorem cumque labore sunt dicta consectetur, nesciunt maiores delectus maxime?
					</p>
					<button id="close">Cerrar</button>
				</div>
				</div>
			</div>
		</div>
		<script src="js.js"></script>
		<script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
	</header> 
</html>

