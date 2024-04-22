<!-- HOME -->
<?php
include_once('php/middleware/resources.php');
session_start();

// DEBUG
// print_r($_SESSION);
// print_r($_REQUEST);

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<!-- main stylesheet-->
	<link rel="stylesheet" href="styles/main.css" />
	<!-- home stylesheet -->
	<link rel="stylesheet" href="styles/home.css" />
	<!-- main script -->
	<script src="js/main.js"></script>
	<!-- home script -->
	<script src="js/home.js"></script>
	<!-- font awesome icons -->
	<script src="https://kit.fontawesome.com/974e5c1fbe.js" crossorigin="anonymous"></script>
	<title>Inicio | CUMA</title>
</head>

<body>
	<!-- NAVBAR -->
	<nav class="topnav open-sans-regular">
		<div id="navbar-logo" class="logo">
			<h1 class="be-vietnam-pro-regular">CUMA</h1>
		</div>
		<a data-item-id="about" class="nav-item" href="#about">Acerca de</a>
		<a data-item-id="index" class="nav-item" href="index/">Índice</a>
		<a data-item-id="resources" class="nav-item" href="resources/">Recursos</a>
		<?= isset($_SESSION['admin']) && $_SESSION['admin'] ? '<a data-item-id="admin" class="nav-item" href="admin/">Admin</a>' : '' ?>
		<a class="nav-button" type="button" href="<?= isset($_SESSION['loggedUserId']) ? 'php/login.php?logout=1' : 'login/' ?>">
			<?= isset($_SESSION['loggedUserId']) ? '<i class="fa-solid fa-right-from-bracket"></i> ' : '<i class="fa-solid fa-user" style="color: #ffffff;padding-right: 15px;"></i> ' ?>
			<?= $_SESSION['loggedUserFirstname'] ?? 'Entrar' ?>
		</a>
	</nav>
	<main>
		<div class="slogan">
			<h1 class="poiret-one-regular">Construyendo puentes entre la <span>salud</span> y la <span>diversidad cultural.</span></h1>
		</div>
		<!-- SEARCH BAR -->
		<div class="outer-search-bar">
			<select name="filter" form="search-form" class="open-sans-bold">
				<option value="concepts" selected>Fundamentos</option>
				<option value="resources">Recursos</option>
			</select>
			<div class="inner-search-bar open-sans-regular">
				<form id="search-form" action="./php/home.php" method="post">
					<input type="search" placeholder="<?php if (isset($_SESSION['searchError'])) {
															echo $_SESSION['searchError'];
															unset($_SESSION['searchError']);
														} else echo 'Busca aquí...'; ?>" name="query" required>
					<button type="submit"><i class="fa-solid fa-magnifying-glass" style="font-size: 30px; color: black;"></i></button>
				</form>
			</div>
		</div>
		<!-- CAROUSEL -->
		<div class="carousel">
			<div class="carousel-view">
				<button id="prev-btn" class="prev-btn">
					<svg viewBox="0 0 512 512" width="20" title="chevron-circle-left">
						<path d="M256 504C119 504 8 393 8 256S119 8 256 8s248 111 248 248-111 248-248 248zM142.1 273l135.5 135.5c9.4 9.4 24.6 9.4 33.9 0l17-17c9.4-9.4 9.4-24.6 0-33.9L226.9 256l101.6-101.6c9.4-9.4 9.4-24.6 0-33.9l-17-17c-9.4-9.4-24.6-9.4-33.9 0L142.1 239c-9.4 9.4-9.4 24.6 0 34z" />
					</svg>
				</button>
				<div id="item-list" class="item-list">
					<?php
					$data = getHomeCarrouselData();
					// print_r($data);
					foreach ($data as $item) {
						$item = (object) $item;
						$image = $item->image ? "<img id='item' class='item' src='img/$item->image'/>" : '';

						echo "
								<a href='entry/?id=$item->id&ty=$item->type'>
									<span>
										$image
										<p class='open-sans-bold'>$item->name</p>
									</span>
								</a>
							";
					}
					?>
					<span>
						<img id="item" class="item" src="img/305x205.png" />
						<p class="open-sans-bold">¿Por qué no puedo dormir?</p>
					</span>
					<span>
						<img id="item" class="item" src="img/305x205.png" />
						<p class="open-sans-bold">Inmunidad de rebaño</p>
					</span>
					<span>
						<img id="item" class="item" src="img/305x205.png" />
						<p class="open-sans-bold">Estrés y salud</p>
					</span>
					<a href='#'>
						<span>
							<p class='open-sans-bold'>El sistema endocrino</p>
						</span>
					</a>
				</div>
				<button id="next-btn" class="next-btn">
					<svg viewBox="0 0 512 512" width="20" title="chevron-circle-right">
						<path d="M256 8c137 0 248 111 248 248S393 504 256 504 8 393 8 256 119 8 256 8zm113.9 231L234.4 103.5c-9.4-9.4-24.6-9.4-33.9 0l-17 17c-9.4 9.4-9.4 24.6 0 33.9L285.1 256 183.5 357.6c-9.4 9.4-9.4 24.6 0 33.9l17 17c9.4 9.4 24.6 9.4 33.9 0L369.9 273c9.4-9.4 9.4-24.6 0-34z" />
					</svg>
				</button>
			</div>
		</div>
		<!-- DISCOVER -->
		<div class="discover">
			<a href="#about">
				<h2 class="open-sans-light">Descubre más</h2>
				<i class="fa-solid fa-angles-down" style="font-size: 40px;"></i>
			</a>
		</div>
		<br>
		<!-- ABOUT -->
		<div id="about" class="about">
			<div class="about-text">
				<h1 class="poiret-one-regular">¿Qué es CUMA?</h1>
				<p class="open-sans-regular">
					CUMA es el proyecto dedicado a la creación de una enciclopedia estructurada de costumbres, creencias e interpretaciones culturales en materia de salud.<br><br>Buscamos abordar las complejidades de la relación entre la salud y la diversidad cultural, ofreciendo un espacio donde investigadores, profesionales de la salud y la comunidad puedan explorar y comprender mejor las diferencias culturales en el ámbito de la atención médica.
				</p>
			</div>
			<div>
				<img src="img/572x395.png">
			</div>
		</div>
		<div class="about">
			<div class="about-image">
				<img src="img/572x395.png">
			</div>
			<div class="about-text" style="text-align: right;">
				<h1 class="poiret-one-regular">Enciclopedia</h1>
				<p class="open-sans-regular">
					En esta página web podrás acceder a un compendio de conceptos, términos y recursos como artículos, libros, ensayos y anotaciones médicas que se agrupan por épocas, grupos y hechos culturales.
				</p>
			</div>
		</div>
	</main>
	<footer class="open-sans-regular">
		<div>
			<p>Síguenos <i class="fa-brands fa-github"></i> <i class="fa-brands fa-instagram"></i></p>
		</div>
		<div>
			<p>Puebla, México. <i class="fa-solid fa-location-dot"></i></p>
		</div>
		<div>
			<p>CUMA 2024. Todos los derechos reservados.</p>
		</div>
		<div>
			<p>retr0 <i class="fa-brands fa-github"></i></p>
		</div>
	</footer>
</body>

</html>