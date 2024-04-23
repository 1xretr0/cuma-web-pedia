<?php

require_once(realpath(dirname(__FILE__) . "/..") . '/db/MySQLDAO.php');

function getAllAreasData() {
	$mysqlManager = new MySQLDAO();
	$result = $mysqlManager->executeSelect(
		$mysqlManager->AREAS_TABLE,
		null,
		null,
		true
	);

	if (!$result) {
		return [];
	}

	return $result;
}
