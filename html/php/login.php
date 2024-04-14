<?php

require_once('middleware/main.php');
session_start();

// MANAGE INCOMING LOGIN REQUESTS
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

	session_unset();
	$_SESSION['loggedUserId'] = $userId['id_usuario'];
	header('Location: /');
	exit;
}
// MANAGE INCOMING SIGNUP REQUESTS
elseif (
	$_SERVER['REQUEST_METHOD'] == 'POST' &&
	$_SERVER['HTTP_REFERER'] == 'http://localhost/login/' &&
	isset($_POST['firstnames']) &&
	isset($_POST['lastnames']) &&
	isset($_POST['email']) &&
	isset($_POST['password'])
) {
	$userId = createNewUser(
		$_POST['firstnames'],
		$_POST['lastnames'],
		$_POST['email'],
		$_POST['password']
	);
}
// MANAGE INCOMING LOGOUT REQUESTS
elseif (
	$_SERVER['REQUEST_METHOD'] == 'GET' &&
	isset($_GET['logout'])
) {
	unset($_SESSION['loggedUserId']);
	header('Location: /');
	exit;
}
