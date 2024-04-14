<!-- RESOURCES PAGE -->
<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<!-- main stylesheet-->
	<link rel="stylesheet" href="../styles/main.css" />
	<!-- index stylesheet -->
	<link rel="stylesheet" href="../styles/index.css" />
	<!-- main script -->
	<script src="../js/main.js"></script>
	<!-- font awesome icons -->
	<script src="https://kit.fontawesome.com/974e5c1fbe.js" crossorigin="anonymous"></script>
	<title>Recursos | CUMA</title>
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
		<a class="nav-button" type="button" href="<?= isset($_SESSION['loggedUserId']) ? '/php/login.php?logout=1' : '../login/' ?>">
			<i class="fa-solid fa-user" style="color: #ffffff;padding-right: 15px;"></i>
			<?= $_SESSION['loggedUserFirstname'] ?? 'Entrar' ?>
		</a>
	</nav>
	<main>
		<div style="background-color: #F0F0F0; border-right-color: black; border-right-style: solid; border-right-width: 2px;">
			<!-- ACCORDEON -->
			<div id="container">
				<section id="accordion">
					<div>
						<input type="checkbox" id="check-1" />
						<label for="check-1" class="open-sans-bold">ÁREA</label>
						<article class="open-sans-regular">
							<ul>
								<li>
									Área 1
								</li>
								<li>
									Área 2
								</li>
								<li>
									Área 3
								</li>
							</ul>
						</article>
					</div>
					<div>
						<input type="checkbox" id="check-2" />
						<label for="check-2" class="open-sans-bold">AÑO</label>
						<article class="open-sans-regular">
							<ul>
								<li>
									Año 1
								</li>
								<li>
									Año 2
								</li>
								<li>
									Año 3
								</li>
							</ul>
						</article>
					</div>
					<div>
						<input type="checkbox" id="check-3" />
						<label for="check-3" class="open-sans-bold">IDIOMA</label>
						<article class="open-sans-regular">
							<ul>
								<li>
									Idioma 1
								</li>
								<li>
									Idioma 2
								</li>
								<li>
									Idioma 3
								</li>
							</ul>
						</article>
					</div>
					<div>
						<input type="checkbox" id="check-4" />
						<label for="check-4" class="open-sans-bold">GRUPO CULTURAL</label>
						<article class="open-sans-regular">
							<ul>
								<li>
									Grupo 1
								</li>
								<li>
									Grupo 2
								</li>
							</ul>
						</article>
					</div>
					<div>
						<input type="checkbox" id="check-5" />
						<label for="check-5" class="open-sans-bold">TIPO DE RECURSO</label>
						<article class="open-sans-regular">
							<ul>
								<li>
									Tipo 1
								</li>
								<li>
									Tipo 2
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
				<h1 class="poiret-one-regular">Quizás te pueda interesar...</h1>
			</div>
			<h2 class="open-sans-bold">Recursos recientes</h2>
			<table>
				<tr>
					<td class="table-row-text">
						<a href="../entry/?id=1">
							<div>
								<h3 class="open-sans-regular">Título</h3>
								<p class="open-sans-light">Esta es una descripcion del recurso</p>
							</div>
						</a>
					</td>
					<td>
						<button disabled class="table-row-btn-area">Area</button>
					</td>
					<td>
						<button disabled class="table-row-btn-group">Grupo</button>
					</td>
					<td>
						<button disabled class="table-row-btn-year">Año</button>
					</td>
					<td>
						<button disabled class="table-row-btn-lang">Idioma</button>
					</td>
					<td>
						<button disabled class="table-row-btn-type">Tipo</button>
					</td>
				</tr>
				<tr>
					<td class="table-row-text">
						<a href="../entry/?id=1">
							<div>
								<h3 class="open-sans-regular">Título</h3>
								<p class="open-sans-light">Esta es una descripcion del recurso.</p>
							</div>
						</a>
					</td>
					<td>
						<button disabled class="table-row-btn-area">Area</button>
					</td>
					<td>
						<button disabled class="table-row-btn-group">Grupo</button>
					</td>
					<td>
						<button disabled class="table-row-btn-year">Año</button>
					</td>
					<td>
						<button disabled class="table-row-btn-lang">Idioma</button>
					</td>
					<td>
						<button disabled class="table-row-btn-type">Tipo</button>
					</td>
				</tr>
				<tr>
					<td class="table-row-text">
						<a href="../entry/?id=1">
							<div>
								<h3 class="open-sans-regular">Título</h3>
								<p class="open-sans-light">Esta es una descripcion del recurso.</p>
							</div>
						</a>
					</td>
					<td>
						<button disabled class="table-row-btn-area">Area</button>
					</td>
					<td>
						<button disabled class="table-row-btn-group">Grupo</button>
					</td>
					<td>
						<button disabled class="table-row-btn-year">Año</button>
					</td>
					<td>
						<button disabled class="table-row-btn-lang">Idioma</button>
					</td>
					<td>
						<button disabled class="table-row-btn-type">Tipo</button>
					</td>
				</tr>
				<tr>
					<td class="table-row-text">
						<a href="../entry/?id=1">
							<div>
								<h3 class="open-sans-regular">Título</h3>
								<p class="open-sans-light">Esta es una descripcion del recurso.</p>
							</div>
						</a>
					</td>
					<td>
						<button disabled class="table-row-btn-area">Area</button>
					</td>
					<td>
						<button disabled class="table-row-btn-group">Grupo</button>
					</td>
					<td>
						<button disabled class="table-row-btn-year">Año</button>
					</td>
					<td>
						<button disabled class="table-row-btn-lang">Idioma</button>
					</td>
					<td>
						<button disabled class="table-row-btn-type">Tipo</button>
					</td>
				</tr>
				<tr>
					<td class="table-row-text">
						<a href="../entry/?id=1">
							<div>
								<h3 class="open-sans-regular">Título</h3>
								<p class="open-sans-light">Esta es una descripcion del recurso.</p>
							</div>
						</a>
					</td>
					<td>
						<button disabled class="table-row-btn-area">Area</button>
					</td>
					<td>
						<button disabled class="table-row-btn-group">Grupo</button>
					</td>
					<td>
						<button disabled class="table-row-btn-year">Año</button>
					</td>
					<td>
						<button disabled class="table-row-btn-lang">Idioma</button>
					</td>
					<td>
						<button disabled class="table-row-btn-type">Tipo</button>
					</td>
				</tr>
			</table>
		</div>
	</main>
</body>

</html>