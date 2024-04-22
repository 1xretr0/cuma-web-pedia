<?php
require_once('middleware/concepts.php');
session_start();
// print_r($_SESSION);
// print_r($_REQUEST);
// die;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$entityBody = json_decode(file_get_contents('php://input'));
	if (!isset($entityBody)) {
		echo '{"error": true, "message": "Input json decode error"}';
		exit;
	}

	if (isset($entityBody->entryType) && isset($entityBody->fieldName)) {
		$result = updateConceptAreaDetailById(
			$entityBody->entryId,
			$entityBody->newValue
		);
	} else {
		$result = false;
	}

	if (!$result) {
		echo '{"error": true, "message": "Failed to update record"}';
		exit;
	}

	echo '{"error": false, "message": "' . $result . '"}';
	// echo '{"error": false, "message": "Successfull update"}';
	exit;
}