<!-- LOGIN -->
<?php

include_once(realpath(dirname(__FILE__) . "/..") . '/php/login.php');
session_start();
// DEBUG
// print_r($_SESSION);
// print_r($_REQUEST);

if (isset($_SESSION['loggedUserId'])) {
	header('Location: ../');
	exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<!-- main stylesheet-->
	<link rel="stylesheet" href="../styles/main.css" />
	<!-- stylesheet-->
	<link rel="stylesheet" href="../styles/login.css" />
	<!-- script -->
	<script src="../js/login.js"></script>
	<title>Acceso | CUMA</title>
</head>

<body class="login-bg">
	<div class="center">
		<section id="login-form" style="display: block;">
			<!-- LOGIN -->
			<div class="form-1">
				<div class="group">
					<div class="logo">
						<h1 class="be-vietnam-pro-regular">CUMA</h1>
					</div>
					<h2 class="open-sans-light">Bienvenido</h2>
					<p class="open-sans-regular">
						Ingresa tus credenciales para acceder con tu cuenta.
					</p>
				</div>
			</div>
			<div class="form-2">
				<form method="post" action="../php/login.php">
					<input name="username" class="open-sans-regular" placeholder="Correo electrónico" type="email" maxlength="50" required>
					<input name="password" class="open-sans-regular" placeholder="Contraseña" type="password" maxlength="8" required>
					<?=
						isset($_SESSION['loginError']) ?
						"<p class='form-error open-sans-bold'>" . $_SESSION['loginError'] . "</p>"
					:
						''
					?>
					<button class="open-sans-bold" type="submit">Enviar</button>
					<div>
						<p class="open-sans-regular" style="margin-top: 30px;">
							Si aún no tienes cuenta, regístrate <a onclick="switchLoginFormSection('register-form', 'login-form')">aquí.</a>
						</p>
					</div>
				</form>
			</div>
		</section>
		<!-- REGISTER FORM -->
		<section id="register-form" style="display: none;">
			<div class="form-1">
				<div class="group">
					<div class="logo">
						<h1 class="be-vietnam-pro-regular">CUMA</h1>
					</div>
					<h2 class="open-sans-light">Bienvenido</h2>
					<p class="open-sans-regular">
						Ingresa tus datos personales para crear tu cuenta.
					</p>
				</div>
			</div>
			<div class="form-2">
				<form method="post" action="../php/login.php">
					<input name="firstnames" class="open-sans-regular" placeholder="Nombre" type="text" maxlength="40" required>
					<input name="lastnames" class="open-sans-regular" placeholder="Apellidos" type="text" maxlength="50" required>
					<input name="email" class="open-sans-regular" placeholder="Correo electrónico" type="email" maxlength="40" required>
					<input name="password" class="open-sans-regular" placeholder="Contraseña" type="password" minlength="8" maxlength="8" required>
					<button class="open-sans-bold" type="submit">Enviar</button>
					<div>
						<p class="open-sans-regular" style="margin-top: 30px;">
							Si ya tienes cuenta, <a onclick="switchLoginFormSection('login-form', 'register-form')">inicia sesión.</a>
						</p>
					</div>
				</form>
			</div>
		</section>
	</div>
</body>

</html>