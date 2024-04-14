<?php

require_once(realpath(dirname(__FILE__) . "/..") . '/db/MySQLDAO.php');

function getHomeCarrouselData() {
	$mySQLManager = new MySQLDAO();
	$query = "(SELECT
				$mySQLManager->CONCEPTS_ID AS 'id',
				$mySQLManager->CONCEPTS_NAME AS 'name',
				$mySQLManager->CONCEPTS_IMG AS 'image',
				'concept' AS 'type'
			FROM $mySQLManager->CONCEPTS_TABLE f
			LIMIT 5)
			UNION ALL
			(SELECT
				$mySQLManager->RESOURCES_ID AS 'id',
				$mySQLManager->RESOURCES_TITLE AS 'name',
				$mySQLManager->RESOURCES_IMG AS 'image',
				'resource' AS 'type'
			FROM cm_recursos r
			LIMIT 5)
	";
	$result = $mySQLManager->executeRawSelect($query, true);
	if (!$result)
		return array();

	// return (object) $result;
	return $result;
}