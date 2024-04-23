<?php

require_once(realpath(dirname(__FILE__) . "/..") . '/db/MySQLDAO.php');

// Function to get all events year fields
function getAllEventsYears() {
	$mysqlManager = new MySQLDAO();
	$result = $mysqlManager->executeSelect(
		$mysqlManager->EVENTS_TABLE,
		[$mysqlManager->EVENTS_YEAR],
		null,
		true
	);

	if (!$result) {
		return [];
	}

	$years = [];
	foreach ($result as $row) {
		$years[] = $row["year"];
	}

	return array_unique($years);
}
