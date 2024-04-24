<!-- NEW CONCEPTS ENTRY PAGE -->
<?php
session_start();
// print_r($_SESSION);
// print_r($_REQUEST);

if (!isset($_SESSION['loggedUserId'])) {
	header('Location: ../index/');
	session_unset();
	exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<!-- main stylesheet-->
	<link rel="stylesheet" href="../styles/main.css" />
	<!-- index stylesheet -->
	<link rel="stylesheet" href="../styles/newentry.css" />
	<!-- main script -->
	<script src="../js/main.js"></script>
	<script src="../js/newentry.js"></script>
	<!-- font awesome icons -->
	<script src="https://kit.fontawesome.com/974e5c1fbe.js" crossorigin="anonymous"></script>
	<title>Nuevo | CUMA</title>
</head>

<body>
	<!-- NAVBAR -->
	<nav class="topnav open-sans-regular">
		<div id="navbar-logo" class="logo">
			<h1 class="be-vietnam-pro-regular">CUMA</h1>
		</div>
		<a data-item-id="home" class="nav-item" href="../">Inicio</a>
		<a data-item-id="index" class="nav-item" href="../index/" style="font-weight: 700;">Índice</a>
		<a data-item-id="resources" class="nav-item" href="../resources/">Recursos</a>
		<?= isset($_SESSION['admin']) && $_SESSION['admin'] ? '<a data-item-id="admin" class="nav-item" href="../admin/">Admin</a>' : '' ?>
		<a class="nav-button" type="button" href="<?= isset($_SESSION['loggedUserId']) ? '../php/login.php?logout=1' : '../login/' ?>">
			<?= isset($_SESSION['loggedUserId']) ? '<i class="fa-solid fa-right-from-bracket"></i> ' : '<i class="fa-solid fa-user" style="color: #ffffff;padding-right: 15px;"></i> ' ?>
			<?= $_SESSION['loggedUserFirstname'] ?? 'Entrar' ?>
		</a>
	</nav>
	<main>
		<div style="background-color: #F0F0F0; border-right-color: black; border-right-style: solid; border-right-width: 2px;">
			<!-- ACCORDEON -->
			<div id="container">
				<section id="accordion">
					<div>
						<input type="checkbox" id="" />
						<label id="back_label" for="" class="open-sans-bold">VOLVER <i class="fa-solid fa-angles-left"></i></label>
					</div>
				</section>
			</div>
		</div>
		<!-- CONTENT -->
		<div class="content">
			<h2 class="open-sans-bold">Crear nueva entrada</h2>
			<div>
				<form method="post" action="../php/entry.php" enctype="multipart/form-data">
					<input name="uam_name" class="open-sans-regular" placeholder="Nombre entrada" type="text" maxlength="40" required>
					<br>
					<textarea name="uam_description" class="open-sans-regular" placeholder="Descripcion" cols="30" rows="5" maxlength="100" required></textarea>
					<br>
					<input name="concept_name" class="open-sans-regular" placeholder="Nombre fundamento sanitario" type="text" maxlength="40" required>
					<br>
					<label for="concept_img_i" class="open-sans-regular">Cargue imagen relacionada: </label>
					<input id="concept_img_i" name="concept_img" class="open-sans-regular" type="file">
					<br>
					<button class="open-sans-bold" type="submit">Crear</button>
				</form>
			</div>
		</div>
	</main>
</body>

</html>