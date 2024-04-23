<?php

require_once(realpath(dirname(__FILE__) . "/..") . '/db/MySQLDAO.php');

function getAllStatesKeys() {
	$mysqlManager = new MySQLDAO();
	$result = $mysqlManager->executeSelect(
		$mysqlManager->STATES_TABLE,
		[$mysqlManager->STATES_KEY],
		null,
		true
	);

	if (!$result) {
		return [];
	}

	return $result;
}
