<?php

require_once('middleware/main.php');
session_start();

function isUserLogged() {
	return isset($_SESSION['loggedUserId']);
}

if (
	$_SERVER['REQUEST_METHOD'] == 'POST' &&
	$_SERVER['HTTP_REFERER'] == 'http://localhost/login/' &&
	isset($_POST['username']) && isset($_POST['password'])
) {
	$userId = getUserIdByCredentials($_POST['username'], $_POST['password']);
	if (!$userId) {
		$_SESSION['loginError'] = 'Usuario y/o contraseña incorrectos. Intente de nuevo.';
		header('Location: /login/');
		exit;
	}

	$_SESSION['loggedUserId'] = $userId['id_usuario'];
	header('Location: /');
	exit;
}
