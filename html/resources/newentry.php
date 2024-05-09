<!-- NEW RESOURCES ENTRY PAGE -->
<?php
session_start();
// print_r($_SESSION);
// print_r($_REQUEST);

if (!isset($_SESSION['loggedUserId'])) {
	header('Location: ../resources/');
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
		<a data-item-id="index" class="nav-item" href="../index/">Índice</a>
		<a data-item-id="resources" class="nav-item" href="../resources/" style="font-weight: 700;">Recursos</a>
		<?= isset($_SESSION['admin']) && $_SESSION['admin'] ? '<a data-item-id="admin" class="nav-item" href="../admin/">Admin</a>' : '' ?>
		<a class=" nav-button" type="button" href="<?= isset($_SESSION['loggedUserId']) ? '../php/login.php?logout=1' : '../login/' ?>">
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
			<h2 class="open-sans-bold">Crear nuevo recurso</h2>
			<div>
				<form method="post" action="../php/resource.php" enctype="multipart/form-data">
					<input name="res_name" class="open-sans-regular" placeholder="Nombre recurso" type="text" maxlength="40" required>
					<br>
					<textarea name="res_description" class="open-sans-regular" placeholder="Descripción" cols="30" rows="5" maxlength="100" required></textarea>
					<br>
					<textarea name="res_content" class="open-sans-regular" placeholder="Contenido" cols="30" rows="5" required></textarea>
					<br>
					<input name="res_url" class="open-sans-regular" placeholder="Url relacionada" type="url" maxlength="70" required>
					<br>
					<label for="res_type_select" class="open-sans-regular">Seleccione tipo de recurso: </label>
					<select id="res_type_select" name="res_type" class="open-sans-regular">
						<option value="" selected disabled hidden autocomplete="off" required>-</option>
						<option value="1">Artículo web</option>
						<option value="2">Video web</option>
					</select>
					<br>
					<label for="res_type_select" class="open-sans-regular">Seleccione idioma del recurso: </label>
					<select id="res_lang_select" name="res_lang" class="open-sans-regular" autocomplete="off" required>
						<option value="" selected disabled hidden>-</option>
						<option value="1">Español</option>
						<option value="2">Inglés</option>
					</select>
					<br>
					<label for="res_img_i" class="open-sans-regular">Cargue imagen relacionada: </label>
					<input id="res_img_i" name="res_img" type="file">
					<br>
					<button class="open-sans-bold" type="submit">Crear</button>
				</form>
			</div>
		</div>
	</main>
</body>

</html>