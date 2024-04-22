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

function getAllResources()
{
	$mysqlManager = new MySQLDAO();
	return $mysqlManager->executeSelect(
		$mysqlManager->RESOURCES_TABLE,
		[
			$mysqlManager->RESOURCES_ID,
			$mysqlManager->RESOURCES_TITLE,
			$mysqlManager->RESOURCES_IMG,
			$mysqlManager->RESOURCES_URL,
			$mysqlManager->RESOURCES_TYPE,
			$mysqlManager->RESOURCES_LANG
		],
		null,
		true
	);
}

function updateResourceById(
	string $resourceId,
	string $title,
	string $image,
	string $url,
	string $type,
	string $lang
) {
	$mysqlManager = new MySQLDAO();
	return $mysqlManager->executeUpdate(
		$mysqlManager->RESOURCES_TABLE,
		[
			$mysqlManager->RESOURCES_TITLE 	=> $title,
			$mysqlManager->RESOURCES_IMG 	=> $image,
			$mysqlManager->RESOURCES_URL 	=> $url,
			$mysqlManager->RESOURCES_TYPE 	=> $type,
			$mysqlManager->RESOURCES_LANG 	=> $lang
		],
		[$mysqlManager->RESOURCES_ID => $resourceId]
	);
}