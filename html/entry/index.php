<!-- HOME -->
<?php

require_once('../php/middleware/concepts.php');
require_once('../php/middleware/resources.php');
session_start();

// print_r($_SESSION);
// print_r($_REQUEST);
// die;

if (!isset($_GET['id']) || !isset($_GET['ty'])) {
	header('Location: ' . $_SERVER['HTTP_REFERER']);
	exit;
}

// validate dummy element id
if ($_GET['id'] === '0' && $_GET['ty'] === 'concept') {
	$data = array(
		'id_uam' => '0',
		'title' => 'Título Fundamento',
		'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut lorem ipsum, varius sit amet tempus eget, pellentesque et dolor. Phasellus ultrices, magna nec tincidunt suscipit, magna magna rutrum dolor, eu placerat turpis ex vulputate sapien. Phasellus non justo turpis. In consequat risus sed mi pulvinar, non lacinia ante varius. Vivamus ut velit mi. Morbi nulla lorem, tincidunt sed felis lacinia, fermentum sagittis lacus.',
		'nombre_area' => 'Nombre del área geográfica',
		'nombre_grupo' => 'Nombre del grupo cultural',
		'year' => '1999',
		'nombre_estado' => 'Nombre del estado migratorio',
		'image' => '330x250.png'
	);
} elseif ($_GET['id'] === '0' && $_GET['ty'] === 'resource') {
	$data = array(
		'id_recurso' => '0',
		'title' => 'Título Recurso',
		'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut lorem ipsum, varius sit amet tempus eget, pellentesque et dolor. Phasellus ultrices, magna nec tincidunt suscipit, magna magna rutrum dolor, eu placerat turpis ex vulputate sapien. Phasellus non justo turpis. In consequat risus sed mi pulvinar, non lacinia ante varius. Vivamus ut velit mi. Morbi nulla lorem, tincidunt sed felis lacinia, fermentum sagittis lacus.',
		'content' => 'Vestibulum sed pellentesque dolor, quis suscipit lorem. Praesent efficitur urna mollis malesuada congue. Proin dapibus ornare orci ut dictum. Nullam ac dolor vel lorem rutrum viverra. Cras ut mi elementum, ultrices nulla in, rhoncus dui. Suspendisse potenti. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam pulvinar gravida lorem, sit amet malesuada purus tristique nec. Curabitur quis neque sit amet elit feugiat varius. Nullam varius massa lorem, ac semper ipsum condimentum pretium. Vivamus bibendum dui eu porta varius. Mauris at odio sagittis, posuere dui nec, maximus nunc. Donec placerat libero vel ex fringilla, in accumsan elit cursus. Ut non lobortis velit. Nam ut purus tortor. Duis finibus nibh erat, sed egestas velit finibus a. Nunc nec auctor sem. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut lorem ipsum, varius sit amet tempus eget, pellentesque et dolor. Phasellus ultrices, magna nec tincidunt suscipit, magna magna rutrum dolor, eu placerat turpis ex vulputate sapien. Phasellus non justo turpis. In consequat risus sed mi pulvinar, non lacinia ante varius. Vivamus ut velit mi. Morbi nulla lorem, tincidunt sed felis lacinia, fermentum sagittis lacus. Vestibulum sed pellentesque dolor, quis suscipit lorem. Praesent efficitur urna mollis malesuada congue. Proin dapibus ornare orci ut dictum. Nullam ac dolor vel lorem rutrum viverra. Cras ut mi elementum, ultrices nulla in, rhoncus dui. Suspendisse potenti. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam pulvinar gravida lorem, sit amet malesuada purus tristique nec.',
		'image' => '330x250.png',
		'conceptsJson' => '[{"conceptId": 0, "conceptName": "Nombre del fundamento"},{"conceptId": 0, "conceptName": "Nombre del fundamento"}]'
	);
} else {
	$data = $_GET['ty'] === 'concept'
		? getConceptDataById($_GET['id']) : getResourceDataById($_GET['id']);
}
// print_r($data);
// die;

// validate data fetch error
if (!$data) {
	header('Location: ' . $_SERVER['HTTP_REFERER']);
	exit;
}

// cast to object for easier concatenation
$data = (object) $data;
// print_r($data);
// die;

?>
<!DOCTYPE html>
<html lang="es-MX">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<!-- main stylesheet-->
	<link rel="stylesheet" href="../styles/main.css" />
	<!-- home stylesheet -->
	<link rel="stylesheet" href="../styles/entry.css" />
	<!-- main script -->
	<script src="../js/main.js"></script>
	<!-- entry script -->
	<script src="../js/entry.js"></script>
	<!-- font awesome icons -->
	<script src="https://kit.fontawesome.com/974e5c1fbe.js" crossorigin="anonymous"></script>
	<title>Entrada | CUMA</title>
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
						<label id="back_label" for="" class="open-sans-bold">VOLVER <i class="fa-solid fa-angles-left"></i></label>
					</div>
					<div>
						<label id="contents_label" for="" class="open-sans-bold">CONTENIDOS</label>
					</div>
					<div>
						<label for="check-2" class="open-sans-bold">TÍTULO</label>
					</div>
					<div>
						<label for="check-3" class="open-sans-bold">DESCRIPCIÓN</label>
					</div>
					<?php if ($_GET['ty'] === 'resource') { ?>
						<div>
							<label for="check-4" class="open-sans-bold">CONTENIDO</label>
						</div>
					<?php } ?>
				</section>
			</div>
		</div>
		<!-- CONTENT -->
		<div class="content">
			<h2 class="poiret-one-regular"><?= $data->title ?></h2>
			<p class="open-sans-regular">
				<?= $data->description ? "$data->description <br><br>" : "" ?>
				<?= isset($data->content) ? $data->content : '' ?>
			</p>
		</div>
		<!-- DETAILS PANEL -->
		<div class="details">
			<?= $data->image ? "<img src='../img/$data->image'>" : '' ?>
			<div>
				<?php
				if ($_GET['ty'] === 'concept') {
				?>
					<h3 class="open-sans-bold">Área <?= isset($_SESSION['admin']) ? "<i id='area_name' class='fa-solid fa-pen-to-square edit-button'></i>" : '' ?></h3>
					<p id='p-area_name' class="open-sans-light"><?= $data->nombre_area ?? '-' ?></p>
					<h3 class="open-sans-bold">Grupo Cultural <?= isset($_SESSION['admin']) ? "<i id='group_name' class='fa-solid fa-pen-to-square edit-button'></i>" : '' ?></h3>
					<p id='p-group_name' class="open-sans-light"><?= $data->nombre_grupo ?? '-' ?></p>
					<h3 class="open-sans-bold">Año <?= isset($_SESSION['admin']) ? "<i id='year' class='fa-solid fa-pen-to-square edit-button'></i>" : '' ?></h3>
					<p id='p-year' class="open-sans-light"><?= $data->year ?? '-' ?></p>
					<h3 class="open-sans-bold">Estado Migratorio <?= isset($_SESSION['admin']) ? "<i id='state_name' class='fa-solid fa-pen-to-square edit-button'></i>" : '' ?></h3>
					<p id='p-state_name' class="open-sans-light"><?= $data->nombre_estado ?? '-' ?></p>
				<?php
				} else {
					$conceptsJson = $data->conceptsJson ? json_decode($data->conceptsJson) : array();
					$conceptsPs = '';
					foreach ($conceptsJson as $concept) {
						$conceptsPs .= "<p class='open-sans-light'>$concept->conceptName</p>";
					}
				?>
					<h3 class="open-sans-bold">Fundamentos relacionados</h3>
					<?= $conceptsPs ?>
				<?php
				}
				?>
			</div>
		</div>
	</main>
</body>

</html>