<?php
session_start();

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
		<div>
			<!-- ACCORDEON -->
			<div id="container">
				<section id="accordion">
					<div>
						<input type="checkbox" id="check-1" />
						<label for="check-1" class="open-sans-bold">USUARIOS</label>
						<article class="open-sans-regular">
							<ul>
								<li id="create_user">
									Crear usuario
								</li>
								<li id="modify_user">
									Modificar usuario
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
		</div>
		<!-- DETAILS PANEL -->
		<div class="details">
			<img src="../img/330x250.png">
			<div>
				<h3 class="open-sans-bold">Área</h3>
				<p class="open-sans-light">Nombre del área</p>
				<h3 class="open-sans-bold">Grupo Cultural</h3>
				<p class="open-sans-light">Nombre del grupo cultural</p>
				<h3 class="open-sans-bold">Época</h3>
				<p class="open-sans-light">Fecha o nombre de la época</p>
				<h3 class="open-sans-bold">Estado Migratorio</h3>
				<p class="open-sans-light">Nombre del estado migratorio</p>
			</div>
		</div>
	</main>
</body>

</html>