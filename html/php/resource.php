<?php
require_once('middleware/resources.php');
session_start();
// print_r($_SESSION);
// print_r($_REQUEST);
// die;
// NEW RESOURCE ENTRY
if (
$_SERVER['REQUEST_METHOD'] == 'POST' &&
isset($_POST['res_name']) &&
isset($_POST['res_description']) &&
isset($_POST['res_content']) &&
isset($_POST['res_url']) &&
isset($_POST['res_type']) &&
isset($_POST['res_lang'])
) {
	unset($_SESSION['fileUploadError']);
	unset($_SESSION['createdEntry']);
	unset($_SESSION['createdEntryError']);

	if (isset($_FILES['res_img'])) {
		$target_dir = "../img/";
		$target_file = $target_dir . basename($_FILES["res_img"]["name"]);
		$uploadOk = 1;

		if (file_exists($target_file)) {
			// echo "Sorry, file already exists.";
			// print_r('file exists');
			// die;
			$uploadOk = 0;
		}

		if ($uploadOk == 0) {
			$_SESSION['fileUploadError'] = 'Error al cargar imagen.';
			header('Location: ../resources/newentry.php');
			exit;
		} else {
			if (move_uploaded_file($_FILES["res_img"]["tmp_name"], $target_file)) {
				$fileName = basename($_FILES["res_img"]["name"]);
			} else {
				$_SESSION['fileUploadError'] = 'Error al guardar imagen.';
				header('Location: ../resources/newentry.php');
				exit;
			}
		}
	}

	// insert new resource
	$result = insertNewResource(
		$_POST['res_name'],
		$_POST['res_description'],
		$_POST['res_content'],
		$_POST['res_url'],
		$_POST['res_type'],
		$_POST['res_lang'],
		isset($fileName) ? $fileName : null
	);

	if (!$result) {
		$_SESSION['createdEntryError'] = 'Error al crear registro';
		header('Location: ../resources/');
		exit;
	}

	$_SESSION['createdEntry'] = true;
	header('Location: ../resources/');
	exit;
}