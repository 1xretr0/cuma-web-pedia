<?php

require_once('middleware/users.php');
session_start();

// MANAGE INCOMING SIGNUP REQUESTS
if (
	$_SERVER['REQUEST_METHOD'] == 'POST' &&
	isset($_POST['firstnames']) &&
	isset($_POST['lastnames']) &&
	isset($_POST['email']) &&
	isset($_POST['password'])
) {
	session_unset();

	$userId = createNewUser(
		$_POST['firstnames'],
		$_POST['lastnames'],
		$_POST['email'],
		$_POST['password']
	);
	if (!$userId) {
		$_SESSION['loginError'] = 'Error al crear usuario nuevo.';
		header('Location: ../login/');
		exit;
	}

	$userFirstname = getUsernameByUserId($userId);
	if (!$userFirstname) {
		$_SESSION['loginError'] = 'Error al crear usuario nuevo.';
		header('Location: ../login/');
		exit;
	}

	$_SESSION['loggedUserId'] = $userId;
	$_SESSION['loggedUserFirstname'] = $userFirstname[0][0];
	header('Location: ../');
	exit;
}
// MANAGE INCOMING LOGIN REQUESTS
elseif (
	$_SERVER['REQUEST_METHOD'] == 'POST' &&
	isset($_POST['username']) && isset($_POST['password'])
) {
	session_unset();

	$userData = getUserDataByCredentials($_POST['username'], $_POST['password']);
	if (!$userData) {
		$_SESSION['loginError'] = 'Usuario y/o contraseña incorrectos. Intente de nuevo.';
		header('Location: ../login/');
		exit;
	}

	// session_unset();
	$_SESSION['loggedUserId'] = $userData[0]['id_usuario'];
	$_SESSION['loggedUserFirstname'] = $userData[0]['nombres_personales_usuario'];
	$_SESSION['admin'] = $userData[0]['administrador'];
	header('Location: ../');
	exit;
}
// MANAGE INCOMING LOGOUT REQUESTS
elseif (
	$_SERVER['REQUEST_METHOD'] == 'GET' &&
	isset($_GET['logout'])
) {
	session_unset();
	header('Location: ../');
	exit;
}
