<?php
require_once('middleware/concepts.php');
require_once('middleware/resources.php');
session_start();
// print_r($_SESSION);
// print_r($_REQUEST);
// die;

// MANAGE INCOMING SEARCH REQUESTS
if (
	$_SERVER['REQUEST_METHOD'] == 'POST' &&
	isset($_POST['query']) &&
	isset($_POST['filter'])
) {
	unset($_SESSION['searchError']);
	unset($_SESSION['searchResults']);

	if ($_POST['filter'] === 'resources') {
		$results = searchResourcesByName($_POST['query']);
	}
	else {
		$results = searchConceptsByName($_POST['query']);
	}
	// print_r($results);
	// die;

	if (!$results) {
		$_SESSION['searchError'] = 'No se encontraron coincidencias :(';
		header('Location: ../');
		exit;
	}

	$_SESSION['searchResults'] = $results;

	if ($_POST['filter'] === 'resources')
		header('Location: ../resources/');
	else
		header('Location: ../index/');

	exit;
}
