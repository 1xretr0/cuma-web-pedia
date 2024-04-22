<?php
session_start();
// print_r($_SESSION);
// print_r($_REQUEST);

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
	<link rel="stylesheet" href="../styles/admin/resourcesmod.css" />
	<!-- main script -->
	<script src="../js/main.js"></script>
	<!-- entry script -->
	<script src="../js/admin/resourcesmod.js"></script>
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
									<a href="./">Crear usuario</a>
								</li>
								<li id="modify_users_li">
									<a href="./usersmod.php">Modificar usuarios</a>
								</li>
							</ul>
						</article>
					</div>
					<div>
						<input type="checkbox" id="check-2" checked />
						<label for="check-2" class="open-sans-bold">RECURSOS</label>
						<article class="open-sans-regular">
							<ul>
								<li id="modify_resources_li">
									<a href="./resourcesmod.php">Modificar recursos</a>
								</li>
							</ul>
						</article>
					</div>
				</section>
			</div>
		</div>
		<!-- CONTENT -->
		<div class="content">
			<h2 class="open-sans-bold">Modificar recursos</h2>
			<?php
			require_once('../php/middleware/resources.php');
			$resourcesData = getAllResources();
			if ($resourcesData) {
			?>
				<table>
					<thead class="open-sans-bold">
						<th>Título</th>
						<th>Imagen</th>
						<th>Url</th>
						<th>Tipo</th>
						<th>Idioma</th>
						<th><i class="fa-solid fa-ellipsis-vertical"></i></th>
					</thead>
					<tbody class="open-sans-regular">
						<?php
						foreach ($resourcesData as $resource) {
							$resource = (object) $resource;

							echo "
							<tr>
								<td id='title'>$resource->titulo_recurso</td>
								<td id='image'>$resource->imagen</td>
								<td id='url'>$resource->url_recurso</td>
								<td id='type'>$resource->id_tipo_recurso</td>
								<td id='lang'>$resource->idioma</td>
								<td id='options_td' colspan='2'>
									<i id='mod_res_$resource->id_recurso' class='fa-solid fa-pen-to-square edit-button'></i> <i id='del_res_$resource->id_recurso' class='fa-solid fa-trash delete-button' style='color: red;'></i>
								</td>
							</tr>
						";
						}
						?>
					</tbody>
				</table>
			<?php
			}
			?>
		</div>
	</main>
</body>

</html>