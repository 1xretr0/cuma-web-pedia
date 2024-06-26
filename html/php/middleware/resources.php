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
			ORDER BY $mySQLManager->CONCEPTS_NAME
			LIMIT 5)
			UNION ALL
			(SELECT
				$mySQLManager->RESOURCES_ID AS 'id',
				$mySQLManager->RESOURCES_TITLE AS 'name',
				$mySQLManager->RESOURCES_IMG AS 'image',
				'resource' AS 'type'
			FROM cm_recursos r
			ORDER BY $mySQLManager->RESOURCES_TITLE
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
	$mySQLManager = new MySQLDAO();
	return $mySQLManager->executeSelect(
		$mySQLManager->RESOURCES_TABLE,
		[
			$mySQLManager->RESOURCES_ID,
			$mySQLManager->RESOURCES_TITLE,
			$mySQLManager->RESOURCES_IMG,
			$mySQLManager->RESOURCES_URL,
			$mySQLManager->RESOURCES_TYPE,
			$mySQLManager->RESOURCES_LANG
		],
		null,
		true
	);
}

function getAllResourcesForView()
{
	$mySQLManager = new MySQLDAO();

	$query = "SELECT
				r.$mySQLManager->RESOURCES_ID,
				r.$mySQLManager->RESOURCES_TITLE,
				r.$mySQLManager->RESOURCES_DESC,
				r.$mySQLManager->RESOURCES_IMG,
				r.$mySQLManager->RESOURCES_URL,
				r.$mySQLManager->RESOURCES_TYPE,
				r.$mySQLManager->RESOURCES_LANG,
				CONCAT(
					'[',
					GROUP_CONCAT(
						CONCAT(
							'{\"conceptId\": ', rc.id_fundamento, ', \"conceptName\": \"', c.nombre_fundamento, '\"}'
						)
						SEPARATOR ','
					),
					']'
				) AS 'json'
			FROM
				cm_recursos r
			LEFT JOIN cm_recurso_fundamentos rc ON
				rc.id_recurso = r.id_recurso
			LEFT JOIN cm_fundamentos_sanitarios c ON
				c.id_fundamento = rc.id_fundamento
			GROUP BY
				r.id_recurso,
				r.titulo_recurso,
				r.descripcion_recurso;
	";
	// return $query;

	$result = $mySQLManager->executeRawSelect(
		$query,
		true
	);
	if (!$result)
		return array();

	return $result;
}

function getResourceDataById(string $resourceId) {
	$mySQLManager = new MySQLDAO();

	$query = "SELECT
				r.id_recurso,
				r.titulo_recurso as 'title',
				r.descripcion_recurso as 'description',
				r.$mySQLManager->RESOURCES_CONTENT as 'content',
				r.$mySQLManager->RESOURCES_IMG as 'image',
				CONCAT(
					'[',
					GROUP_CONCAT(
						CONCAT(
							'{\"conceptId\": ', rc.id_fundamento, ', \"conceptName\": \"', c.nombre_fundamento, '\"}'
						)
						SEPARATOR ','
					),
					']'
				) AS 'conceptsJson'
			FROM
				cm_recursos r
			LEFT JOIN cm_recurso_fundamentos rc ON
				rc.id_recurso = r.id_recurso
			LEFT JOIN cm_fundamentos_sanitarios c ON
				c.id_fundamento = rc.id_fundamento
			WHERE
				r.$mySQLManager->RESOURCES_ID = $resourceId
			GROUP BY
				r.id_recurso,
				r.titulo_recurso,
				r.descripcion_recurso
			LIMIT 1;
	";
	// return $query;

	$result = $mySQLManager->executeRawSelect(
		$query,
		true
	);

	if (!$result)
		return false;

	return $result[0];
}

function searchResourcesByName($name) {
	$mySQLManager = new MySQLDAO();

	$name = filter_var($name, FILTER_SANITIZE_STRING);

	$query = "SELECT
				r.id_recurso,
				r.titulo_recurso,
				r.descripcion_recurso,
				CONCAT(
					'[',
					GROUP_CONCAT(
						CONCAT(
							'{\"conceptId\": ', rc.id_fundamento, ', \"conceptName\": \"', c.nombre_fundamento, '\"}'
						)
						SEPARATOR ','
					),
					']'
				) AS 'json'
			FROM
				cm_recursos r
			LEFT JOIN cm_recurso_fundamentos rc ON
				rc.id_recurso = r.id_recurso
			LEFT JOIN cm_fundamentos_sanitarios c ON
				c.id_fundamento = rc.id_fundamento
			WHERE
				r.titulo_recurso LIKE '%$name%'
			GROUP BY
				r.id_recurso,
				r.titulo_recurso,
				r.descripcion_recurso;
	";
	// return $query;

	$result = $mySQLManager->executeRawSelect(
		$query,
		true
	);
	if (!$result)
		return array();

	return $result;
}

function getAllResourceTypesData() {
	$mySQLManager = new MySQLDAO();
	return $mySQLManager->executeSelect(
		$mySQLManager->RESOURCE_TYPES_TABLE,
		null,
		null,
		true
	);
}

// insert new resource
function insertNewResource(
	string $title,
	string $description,
	string $content,
	string $url,
	string $type,
	string $lang,
	?string $image = null
) {
	$mySQLManager = new MySQLDAO();
	$resourceId = $mySQLManager->executeInsert(
		$mySQLManager->RESOURCES_TABLE,
		[
			$mySQLManager->RESOURCES_TITLE 	=> $title,
			$mySQLManager->RESOURCES_DESC 	=> $description,
			$mySQLManager->RESOURCES_CONTENT => $content,
			$mySQLManager->RESOURCES_URL 	=> $url,
			$mySQLManager->RESOURCES_TYPE 	=> $type,
			$mySQLManager->RESOURCES_LANG 	=> $lang,
			$mySQLManager->RESOURCES_IMG 	=> $image
		],
		true
	);
	// print_r($resourceId)

	if (!$resourceId)
		return false;

	return true;
}

function updateResourceById(
	string $resourceId,
	string $title,
	string $image,
	string $url,
	string $type,
	string $lang
) {
	$mySQLManager = new MySQLDAO();
	return $mySQLManager->executeUpdate(
		$mySQLManager->RESOURCES_TABLE,
		[
			$mySQLManager->RESOURCES_TITLE 	=> $title,
			$mySQLManager->RESOURCES_IMG 	=> $image,
			$mySQLManager->RESOURCES_URL 	=> $url,
			$mySQLManager->RESOURCES_TYPE 	=> $type,
			$mySQLManager->RESOURCES_LANG 	=> $lang
		],
		[$mySQLManager->RESOURCES_ID => $resourceId]
	);
}

// delete resource by id
function deleteResourceById(string $resourceId) {
	$mySQLManager = new MySQLDAO();
	return $mySQLManager->executeDelete(
		$mySQLManager->RESOURCES_TABLE,
		[$mySQLManager->RESOURCES_ID => $resourceId]
	);
}