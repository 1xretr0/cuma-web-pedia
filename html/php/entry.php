<?php
require_once('middleware/concepts.php');
session_start();
// print_r($_SESSION);
// print_r($_REQUEST);
// die;

// NEW CONCEPT ENTRY
if (
	$_SERVER['REQUEST_METHOD'] == 'POST' &&
	isset($_POST['uam_name']) &&
	isset($_POST['uam_description']) &&
	isset($_POST['concept_name'])
) {
	unset($_SESSION['fileUploadError']);
	unset($_SESSION['createdEntry']);
	unset($_SESSION['createdEntryError']);

	if (isset($_FILES['concept_img'])) {
		$target_dir = "../img/";
		$target_file = $target_dir . basename($_FILES["concept_img"]["name"]);
		$uploadOk = 1;

		// print_r($target_file);
		// die;

		if (file_exists($target_file)) {
			// echo "Sorry, file already exists.";
			// print_r('file exists');
			// die;
			$uploadOk = 0;
		}

		if ($uploadOk == 0) {
			$_SESSION['fileUploadError'] = 'Error al cargar imagen.';
			header('Location: ../index/newentry.php');
			exit;
		} else {
			if (move_uploaded_file($_FILES["concept_img"]["tmp_name"], $target_file)) {
				$fileName = basename($_FILES["concept_img"]["name"]);
			} else {
				$_SESSION['fileUploadError'] = 'Error al guardar imagen.';
				header('Location: ../index/newentry.php');
				exit;
			}
		}
	}

	// print_r($_POST['uam_name']);
	// die;

	$result = insertNewConcept(
		$_POST['uam_name'],
		$_POST['uam_description'],
		$_POST['concept_name'],
		isset($fileName) ? $fileName : null
	);
	// print_r($result);
	// die;
	if (!$result) {
		$_SESSION['createdEntryError'] = 'Error al crear registro';
		header('Location: ../index/');
		exit;
	}

	$_SESSION['createdEntry'] = true;
	header('Location: ../index/');
	exit;
}
// UPDATE ENTRY DETAILS
else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$entityBody = json_decode(file_get_contents('php://input'));
	if (!isset($entityBody)) {
		echo '{"error": true, "message": "Input json decode error"}';
		exit;
	}

	if (
		!isset($entityBody->entryType) ||
		!isset($entityBody->entryId) ||
		!isset($entityBody->fieldName) ||
		!isset($entityBody->newValue) ||
		$entityBody->entryId == '0'
	) {
		echo '{"error": true, "message": "Missing required parameters"}';
		exit;
	}

	// switch case for $entityBody->fieldName
	switch ($entityBody->fieldName) {
		case 'area_name':
			$result = updateConceptAreaDetailById($entityBody->entryId, $entityBody->newValue);
			break;
		default:
			$result = true;
			break;
	}

	if (!$result) {
		echo '{"error": true, "message": "Failed to update record"}';
		exit;
	}

	// echo '{"error": false, "message": "' . $result . '"}';
	echo '{"error": false, "message": "Successfull update"}';
	exit;
}