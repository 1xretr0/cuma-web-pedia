<?php
session_start();
print_r($_SESSION);
print_r($_REQUEST);

if (!isset($_SESSION['admin']) || !$_SESSION['admin']) {
	header('Location: ../');
	session_unset();
	exit();
}
?>
<!DOCTYPE html>
<html lang="es-MX">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<!-- main stylesheet-->
	<link rel="stylesheet" href="../styles/main.css" />
	<!-- home stylesheet -->
	<link rel="stylesheet" href="../styles/admin.css" />
	<!-- main script -->
	<script src="../js/main.js"></script>
	<!-- entry script -->
	<script src="../js/admin.js"></script>
	<!-- font awesome icons -->
	<script src="https://kit.fontawesome.com/974e5c1fbe.js" crossorigin="anonymous"></script>
	<title>Admin | CUMA</title>
</head>

<body>
	<!-- NAVBAR -->
	<nav class="topnav open-sans-regular">
		<div id="navbar-logo" class="logo">
			<h1 class="be-vietnam-pro-regular">CUMA</h1>
		</div>
		<a data-item-id="home" class="nav-item" href="../">Inicio</a>
		<a data-item-id="index" class="nav-item" href="../index/">Índice</a>
		<a data-item-id="resources" class="nav-item" href="../resources/">Recursos</a>
		<a data-item-id="admin" class="nav-item" href="../admin/" style="font-weight: 700;">Admin</a>
		<a class="nav-button" type="button" href="../php/login.php?logout=1">
			<?= isset($_SESSION['loggedUserId']) ? '<i class="fa-solid fa-right-from-bracket"></i> ' : '<i class="fa-solid fa-user" style="color: #ffffff;padding-right: 15px;"></i> ' ?>
			<?= $_SESSION['loggedUserFirstname'] ?>
		</a>
	</nav>
	<main>
		<div style="background-color: #F0F0F0; border-right-color: black; border-right-style: solid; border-right-width: 2px;">
			<!-- ACCORDEON -->
			<div id="container">
				<section id="accordion">
					<div>
						<input type="checkbox" id="check-1" />
						<label for="check-1" class="open-sans-bold">USUARIOS</label>
						<article class="open-sans-regular">
							<ul>
								<li id="create_user_li">
									Crear usuario
								</li>
								<li>
									Modificar usuarios
								</li>
							</ul>
						</article>
					</div>
					<div>
						<input type="checkbox" id="check-2" />
						<label for="check-2" class="open-sans-bold">RECURSOS</label>
						<article class="open-sans-regular">
							<ul>
								<li>
									Modificar recursos
								</li>
							</ul>
						</article>
					</div>
				</section>
			</div>
		</div>
		<!-- CONTENT -->
		<div class="content">
			<div class="slogan">
				<h1 class="poiret-one-regular">Escoge alguna opción del menu lateral...</h1>
			</div>
			<h2 id="create_user_h2" class="open-sans-bold" style="display: none;">Crear nuevo usuario</h2>
			<div id="create_user_form" style="display: none;">
				<form method="post" action="../php/admin.php">
					<input name="firstnames" class="open-sans-regular" placeholder="Nombre" type="text" maxlength="40" required>
					<br>
					<input name="lastnames" class="open-sans-regular" placeholder="Apellidos" type="text" maxlength="50" required>
					<br>
					<input name="email" class="open-sans-regular" placeholder="Correo electrónico" type="email" maxlength="40" required>
					<br>
					<input name="password" class="open-sans-regular" placeholder="Contraseña" type="password" minlength="8" maxlength="8" required>
					<br>
					<label for="admin_box" class="open-sans-regular">¿Es administrador?</label>
					<input name="admin" id="admin_box" type="checkbox" value="1">
					<br>
					<button class="open-sans-bold" type="submit">Enviar</button>
				</form>
			</div>
		</div>
	</main>
</body>

</html>