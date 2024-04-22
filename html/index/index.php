<!-- INDEX PAGE -->
<?php
session_start();
print_r($_SESSION);
print_r($_REQUEST);

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
	<title>Índice | CUMA</title>
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
						<label for="check-3" class="open-sans-bold">GRUPO CULTURAL</label>
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
						<input type="checkbox" id="check-4" />
						<label for="check-4" class="open-sans-bold">ESTADO MIGRATORIO</label>
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
				</section>
			</div>
		</div>
		<!-- CONTENT -->
		<div class="content">
			<?php
			if (isset($_SESSION['searchResults'])) {
			?>
			<h2 class="open-sans-bold">Resultados de la búsqueda</h2>
			<table>
				<?php
				foreach ($_SESSION['searchResults'] as $result) {
					$result = (object) $result;

					$result->nombre = mb_substr($result->nombre, 0, 50) . '...';
					$result->descripcion = mb_substr($result->descripcion, 0, 70) . '...';

					echo "
						<tr>
							<td class='table-row-text'>
								<a href='../entry/?id=$result->id_uam&ty=concept'>
									<div>
										<h3 class='open-sans-regular'>$result->nombre</h3>
										<p class='open-sans-light'>$result->descripcion</p>
									</div>
								</a>
							</td>
							<td>
								<button disabled class='table-row-btn-area'>$result->nombre_area</button>
							</td>
							<td>
								<button disabled class='table-row-btn-group'>$result->nombre_grupo</button>
							</td>
							<td>
								<button disabled class='table-row-btn-year'>$result->year</button>
							</td>
							<td>
								<button disabled class='table-row-btn-status'>$result->nombre_estado</button>
							</td>
						</tr>
					";
				}
				unset($_SESSION['searchResults']);
				?>
			</table>
			<?php
			}
			else {
			?>
			<div class="slogan">
				<h1 class="poiret-one-regular">Quizás te pueda interesar...</h1>
			</div>
			<h2 class="open-sans-bold">Entradas recientes</h2>
			<table>
				<tr>
					<td class="table-row-text">
						<a href="../entry/?id=0&ty=concept">
							<div>
								<h3 class="open-sans-regular">Título</h3>
								<p class="open-sans-light">Esta es una descripcion de la entrada</p>
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
						<button disabled class="table-row-btn-status">Estado</button>
					</td>
				</tr>
				<tr>
					<td class="table-row-text">
						<a href="../entry/?id=0&ty=concept">
							<div>
								<h3 class="open-sans-regular">Título</h3>
								<p class="open-sans-light">Esta es una descripcion de la entrada</p>
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
						<button disabled class="table-row-btn-status">Estado</button>
					</td>
				</tr>
				<tr>
					<td class="table-row-text">
						<a href="../entry/?id=0&ty=concept">
							<div>
								<h3 class="open-sans-regular">Título</h3>
								<p class="open-sans-light">Esta es una descripcion de la entrada</p>
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
						<button disabled class="table-row-btn-status">Estado</button>
					</td>
				</tr>
				<tr>
					<td class="table-row-text">
						<a href="../entry/?id=0&ty=concept">
							<div>
								<h3 class="open-sans-regular">Título</h3>
								<p class="open-sans-light">Esta es una descripcion de la entrada</p>
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
						<button disabled class="table-row-btn-status">Estado</button>
					</td>
				</tr>
				<tr>
					<td class="table-row-text">
						<a href="../entry/?id=0&ty=concept">
							<div>
								<h3 class="open-sans-regular">Título</h3>
								<p class="open-sans-light">Esta es una descripcion de la entrada</p>
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
						<button disabled class="table-row-btn-status">Estado</button>
					</td>
				</tr>
				<tr>
					<td class="table-row-text">
						<a href="../entry/?id=0&ty=concept">
							<div>
								<h3 class="open-sans-regular">Título</h3>
								<p class="open-sans-light">Esta es una descripcion de la entrada</p>
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
						<button disabled class="table-row-btn-status">Estado</button>
					</td>
				</tr>
			</table>
			<?php
			}
			?>
		</div>
	</main>
</body>

</html>