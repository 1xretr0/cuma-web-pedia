<?php

require_once('middleware/users.php');
session_start();
// print_r($_SESSION);
// print_r($_REQUEST);
// die;

// MANAGE INCOMING SIGNUP REQUESTS
if (
	$_SERVER['REQUEST_METHOD'] == 'POST' &&
	isset($_POST['firstnames']) &&
	isset($_POST['lastnames']) &&
	isset($_POST['email']) &&
	isset($_POST['password'])
) {
	unset($_SESSION['adminError']);
	unset($_SESSION['createdUser']);

	$userId = createNewUser(
		$_POST['firstnames'],
		$_POST['lastnames'],
		$_POST['email'],
		$_POST['password'],
		$_POST['admin'] ?? null
	);
	if (!$userId) {
		$_SESSION['adminError'] = 'Error al crear usuario nuevo.';
		header('Location: ../admin/');
		exit;
	}

	$userFirstname = getUsernameByUserId($userId);
	if (!$userFirstname) {
		$_SESSION['adminError'] = 'Error al crear usuario nuevo.';
		header('Location: ../admin/');
		exit;
	}

	$_SESSION['createdUser'] = true;
	header('Location: ../admin/');
	exit;
}
elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$entityBody = json_decode(file_get_contents('php://input'));
	if (!isset($entityBody)) {
		echo '{"error": true, "message": "Input json decode error"}';
		exit;
	}

	$result = updateUserById(
		$entityBody->userId,
		$entityBody->firstnames,
		$entityBody->lastnames,
		$entityBody->email,
		$entityBody->password,
		$entityBody->admin
	);
	if (!$result) {
		echo '{"error": true, "message": "Failed to update record"}';
		exit;
	}

	// echo '{"error": false, "message": "' . $result . '"}';
	echo '{"error": false, "message": "Successfull update"}';
	exit;
}
