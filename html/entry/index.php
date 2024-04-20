<!-- HOME -->
<?php
session_start();

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
		<a data-item-id="index" class="nav-item" href="../index/" style="font-weight: 700;">Índice</a>
		<a data-item-id="resources" class="nav-item" href="../resources/">Recursos</a>
		<?= isset($_SESSION['admin']) && $_SESSION['admin'] ? '<a data-item-id="admin" class="nav-item" href="../admin/">Admin</a>' : '' ?>
		<a class="nav-button" type="button" href="<?= isset($_SESSION['loggedUserId']) ? '../php/login.php?logout=1' : '../login/' ?>">
			<?= isset($_SESSION['loggedUserId']) ? '<i class="fa-solid fa-right-from-bracket"></i> ' : '<i class="fa-solid fa-user" style="color: #ffffff;padding-right: 15px;"></i> ' ?>
			<?= $_SESSION['loggedUserFirstname'] ?? 'Entrar' ?>
		</a>
	</nav>
	<main>
		<div>
			<!-- ACCORDEON -->
			<div id="container">
				<section id="accordion">
					<div>
						<input type="checkbox" id="" />
						<label id="back_label" for="" class="open-sans-bold">VOLVER <i class="fa-solid fa-angles-left"></i></label>
					</div>
					<div>
						<label id="contents_label" for="" class="open-sans-bold">CONTENIDOS</label>
					</div>
					<div>
						<input type="checkbox" id="check-2" />
						<label for="check-2" class="open-sans-bold">SECCIÓN</label>
						<article class="open-sans-regular">
							<ul>
								<li>
									Subsección
								</li>
								<li>
									Subsección
								</li>
								<li>
									Subsección
								</li>
							</ul>
						</article>
					</div>
					<div>
						<input type="checkbox" id="check-3" />
						<label for="check-3" class="open-sans-bold">SECCIÓN</label>
						<article class="open-sans-regular">
							<ul>
								<li>
									Subsección
								</li>
								<li>
									Subsección
								</li>
							</ul>
						</article>
					</div>
				</section>
			</div>
		</div>
		<!-- CONTENT -->
		<div class="content">
			<h2 class="poiret-one-regular">Título Entrada</h2>
			<p class="open-sans-regular">
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut lorem ipsum, varius sit amet tempus eget, pellentesque et dolor. Phasellus ultrices, magna nec tincidunt suscipit, magna magna rutrum dolor, eu placerat turpis ex vulputate sapien. Phasellus non justo turpis. In consequat risus sed mi pulvinar, non lacinia ante varius. Vivamus ut velit mi. Morbi nulla lorem, tincidunt sed felis lacinia, fermentum sagittis lacus. Vestibulum sed pellentesque dolor, quis suscipit lorem. Praesent efficitur urna mollis malesuada congue. Proin dapibus ornare orci ut dictum. Nullam ac dolor vel lorem rutrum viverra. Cras ut mi elementum, ultrices nulla in, rhoncus dui. Suspendisse potenti. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam pulvinar gravida lorem, sit amet malesuada purus tristique nec. Curabitur quis neque sit amet elit feugiat varius. Nullam varius massa lorem, ac semper ipsum condimentum pretium.
				Vivamus bibendum dui eu porta varius. Mauris at odio sagittis, posuere dui nec, maximus nunc. Donec placerat libero vel ex fringilla, in accumsan elit cursus. Ut non lobortis velit. Nam ut purus tortor. Duis finibus nibh erat, sed egestas velit finibus a. Nunc nec auctor sem.
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut lorem ipsum, varius sit amet tempus eget, pellentesque et dolor. Phasellus ultrices, magna nec tincidunt suscipit, magna magna rutrum dolor, eu placerat turpis ex vulputate sapien. Phasellus non justo turpis. In consequat risus sed mi pulvinar, non lacinia ante varius. Vivamus ut velit mi. Morbi nulla lorem, tincidunt sed felis lacinia, fermentum sagittis lacus. Vestibulum sed pellentesque dolor, quis suscipit lorem. Praesent efficitur urna mollis malesuada congue. Proin dapibus ornare orci ut dictum. Nullam ac dolor vel lorem rutrum viverra. Cras ut mi elementum, ultrices nulla in, rhoncus dui. Suspendisse potenti. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam pulvinar gravida lorem, sit amet malesuada purus tristique nec. Curabitur quis neque sit amet elit feugiat varius. Nullam varius massa lorem, ac semper ipsum condimentum pretium.
				Vivamus bibendum dui eu porta varius. Mauris at odio sagittis, posuere dui nec, maximus nunc. Donec placerat libero vel ex fringilla, in accumsan elit cursus. Ut non lobortis velit. Nam ut purus tortor. Duis finibus nibh erat, sed egestas velit finibus a. Nunc nec auctor sem.
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut lorem ipsum, varius sit amet tempus eget, pellentesque et dolor. Phasellus ultrices, magna nec tincidunt suscipit, magna magna rutrum dolor, eu placerat turpis ex vulputate sapien. Phasellus non justo turpis. In consequat risus sed mi pulvinar, non lacinia ante varius. Vivamus ut velit mi. Morbi nulla lorem, tincidunt sed felis lacinia, fermentum sagittis lacus. Vestibulum sed pellentesque dolor, quis suscipit lorem. Praesent efficitur urna mollis malesuada congue. Proin dapibus ornare orci ut dictum. Nullam ac dolor vel lorem rutrum viverra. Cras ut mi elementum, ultrices nulla in, rhoncus dui. Suspendisse potenti. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam pulvinar gravida lorem, sit amet malesuada purus tristique nec. Curabitur quis neque sit amet elit feugiat varius. Nullam varius massa lorem, ac semper ipsum condimentum pretium.
				Vivamus bibendum dui eu porta varius. Mauris at odio sagittis, posuere dui nec, maximus nunc. Donec placerat libero vel ex fringilla, in accumsan elit cursus. Ut non lobortis velit. Nam ut purus tortor. Duis finibus nibh erat, sed egestas velit finibus a. Nunc nec auctor sem.
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut lorem ipsum, varius sit amet tempus eget, pellentesque et dolor. Phasellus ultrices, magna nec tincidunt suscipit, magna magna rutrum dolor, eu placerat turpis ex vulputate sapien. Phasellus non justo turpis. In consequat risus sed mi pulvinar, non lacinia ante varius. Vivamus ut velit mi. Morbi nulla lorem, tincidunt sed felis lacinia, fermentum sagittis lacus. Vestibulum sed pellentesque dolor, quis suscipit lorem. Praesent efficitur urna mollis malesuada congue. Proin dapibus ornare orci ut dictum. Nullam ac dolor vel lorem rutrum viverra. Cras ut mi elementum, ultrices nulla in, rhoncus dui. Suspendisse potenti. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam pulvinar gravida lorem, sit amet malesuada purus tristique nec. Curabitur quis neque sit amet elit feugiat varius. Nullam varius massa lorem, ac semper ipsum condimentum pretium.
				Vivamus bibendum dui eu porta varius. Mauris at odio sagittis, posuere dui nec, maximus nunc. Donec placerat libero vel ex fringilla, in accumsan elit cursus. Ut non lobortis velit. Nam ut purus tortor. Duis finibus nibh erat, sed egestas velit finibus a. Nunc nec auctor sem.
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut lorem ipsum, varius sit amet tempus eget, pellentesque et dolor. Phasellus ultrices, magna nec tincidunt suscipit, magna magna rutrum dolor, eu placerat turpis ex vulputate sapien. Phasellus non justo turpis. In consequat risus sed mi pulvinar, non lacinia ante varius. Vivamus ut velit mi. Morbi nulla lorem, tincidunt sed felis lacinia, fermentum sagittis lacus. Vestibulum sed pellentesque dolor, quis suscipit lorem. Praesent efficitur urna mollis malesuada congue. Proin dapibus ornare orci ut dictum. Nullam ac dolor vel lorem rutrum viverra. Cras ut mi elementum, ultrices nulla in, rhoncus dui. Suspendisse potenti. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam pulvinar gravida lorem, sit amet malesuada purus tristique nec. Curabitur quis neque sit amet elit feugiat varius. Nullam varius massa lorem, ac semper ipsum condimentum pretium.
				Vivamus bibendum dui eu porta varius. Mauris at odio sagittis, posuere dui nec, maximus nunc. Donec placerat libero vel ex fringilla, in accumsan elit cursus. Ut non lobortis velit. Nam ut purus tortor. Duis finibus nibh erat, sed egestas velit finibus a. Nunc nec auctor sem.
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut lorem ipsum, varius sit amet tempus eget, pellentesque et dolor. Phasellus ultrices, magna nec tincidunt suscipit, magna magna rutrum dolor, eu placerat turpis ex vulputate sapien. Phasellus non justo turpis. In consequat risus sed mi pulvinar, non lacinia ante varius. Vivamus ut velit mi. Morbi nulla lorem, tincidunt sed felis lacinia, fermentum sagittis lacus. Vestibulum sed pellentesque dolor, quis suscipit lorem. Praesent efficitur urna mollis malesuada congue. Proin dapibus ornare orci ut dictum. Nullam ac dolor vel lorem rutrum viverra. Cras ut mi elementum, ultrices nulla in, rhoncus dui. Suspendisse potenti. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam pulvinar gravida lorem, sit amet malesuada purus tristique nec. Curabitur quis neque sit amet elit feugiat varius. Nullam varius massa lorem, ac semper ipsum condimentum pretium.
				Vivamus bibendum dui eu porta varius. Mauris at odio sagittis, posuere dui nec, maximus nunc. Donec placerat libero vel ex fringilla, in accumsan elit cursus. Ut non lobortis velit. Nam ut purus tortor. Duis finibus nibh erat, sed egestas velit finibus a. Nunc nec auctor sem.
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut lorem ipsum, varius sit amet tempus eget, pellentesque et dolor. Phasellus ultrices, magna nec tincidunt suscipit, magna magna rutrum dolor, eu placerat turpis ex vulputate sapien. Phasellus non justo turpis. In consequat risus sed mi pulvinar, non lacinia ante varius. Vivamus ut velit mi. Morbi nulla lorem, tincidunt sed felis lacinia, fermentum sagittis lacus. Vestibulum sed pellentesque dolor, quis suscipit lorem. Praesent efficitur urna mollis malesuada congue. Proin dapibus ornare orci ut dictum. Nullam ac dolor vel lorem rutrum viverra. Cras ut mi elementum, ultrices nulla in, rhoncus dui. Suspendisse potenti. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam pulvinar gravida lorem, sit amet malesuada purus tristique nec. Curabitur quis neque sit amet elit feugiat varius. Nullam varius massa lorem, ac semper ipsum condimentum pretium.
				Vivamus bibendum dui eu porta varius. Mauris at odio sagittis, posuere dui nec, maximus nunc. Donec placerat libero vel ex fringilla, in accumsan elit cursus. Ut non lobortis velit. Nam ut purus tortor. Duis finibus nibh erat, sed egestas velit finibus a. Nunc nec auctor sem.
			</p>
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