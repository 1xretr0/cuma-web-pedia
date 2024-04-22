<?php

require_once(realpath(dirname(__FILE__) . "/..") . '/db/MySQLDAO.php');

function searchConceptsByName(string $name)
{
	$mySQLManager = new MySQLDAO();

	$name = filter_var($name, FILTER_SANITIZE_STRING);

	$query = "SELECT
			u.id_uam,
			u.nombre,
			u.descripcion,
			ag.nombre_area,
			gc.nombre AS 'nombre_grupo',
			hc.year,
			em.nombre_estado
		FROM
			cm_uams u
		LEFT JOIN
			cm_hechos_culturales hc ON hc.id_hecho = u.id_hecho
		LEFT JOIN
			cm_grupos_culturales gc ON gc.id_grupo = hc.id_grupo
		LEFT JOIN
			cm_areas_geograficas_ctl ag ON ag.id_area = hc.id_area
		LEFT JOIN
			cm_estados_migratorios_ctl em ON em.id_estado = u.id_estado
		WHERE
			u.nombre LIKE '%$name%';
	";
	// return $query;

	$result = $mySQLManager->executeRawSelect($query, true);
	if (!$result)
		return array();

	return $result;
}

function getConceptDataById(string $conceptId) {
	$mySQLManager = new MySQLDAO();

	// $conceptId = filter_var($conceptId, FILTER_SANITIZE_STRING);

	$query = "SELECT
			u.id_uam,
			u.nombre as 'title',
			u.descripcion as 'description',
			ag.nombre_area,
			gc.nombre AS 'nombre_grupo',
			hc.year,
			em.nombre_estado,
			c.$mySQLManager->CONCEPTS_IMG AS 'image'
		FROM
			cm_uams u
		JOIN
			$mySQLManager->CONCEPTS_TABLE c ON c.$mySQLManager->CONCEPTS_ID = u.$mySQLManager->CONCEPTS_ID
		LEFT JOIN
			cm_hechos_culturales hc ON hc.id_hecho = u.id_hecho
		LEFT JOIN
			cm_grupos_culturales gc ON gc.id_grupo = hc.id_grupo
		LEFT JOIN
			cm_areas_geograficas_ctl ag ON ag.id_area = hc.id_area
		LEFT JOIN
			cm_estados_migratorios_ctl em ON em.id_estado = u.id_estado
		WHERE
			u.$mySQLManager->CONCEPTS_ID = $conceptId
		LIMIT 1
		;
	";
	// return $query;

	$result = $mySQLManager->executeRawSelect($query, true);

	if (!$result)
		return false;

	return $result[0];
}

function updateConceptAreaDetailById(string $conceptId, string $newValue) {
	$mySQLManager = new MySQLDAO();
	$query = "SELECT
				ag.id_area
			FROM
			cm_uams u
			JOIN
			cm_hechos_culturales hc ON hc.id_hecho = u.id_hecho
			JOIN
			cm_areas_geograficas_ctl ag ON ag.id_area = hc.id_area
			WHERE
				u.id_uam = $conceptId
			LIMIT 1;
	";
	return $query;

	$areaId = $mySQLManager->executeRawSelect(
		$query
	);
	return $areaId[0];

	if (!$areaId)
		return false;

	// return $mySQLManager->executeUpdate(
	// 	$mySQLManager->AREAS_TABLE,
	// 	[
	// 		$mySQLManager->RESOURCES_TITLE 	=> $title,
	// 		$mySQLManager->RESOURCES_IMG 	=> $image,
	// 		$mySQLManager->RESOURCES_URL 	=> $url,
	// 		$mySQLManager->RESOURCES_TYPE 	=> $type,
	// 		$mySQLManager->RESOURCES_LANG 	=> $lang
	// 	],
	// 	[$mySQLManager->RESOURCES_ID => $resourceId]
	// );
}

function insertNewConcept(
	string $uamName,
	string $uamDescription,
	string $conceptName,
	?string $conceptImg	= null
) {
	$mySQLManager = new MySQLDAO();
	$newConceptId = $mySQLManager->executeInsert(
		$mySQLManager->CONCEPTS_TABLE,
		[
			$mySQLManager->CONCEPTS_NAME 	=> $conceptName,
			$mySQLManager->CONCEPTS_IMG 	=> $conceptImg
		],
		true,
		true
	);
	// return $newConceptId;
	// $newConceptId = 3;

	if (!$newConceptId)
		return false;

	$newUamId = $mySQLManager->executeInsert(
		$mySQLManager->UAMS_TABLE,
		[
			$mySQLManager->UAMS_NAME => $uamName,
			$mySQLManager->UAMS_DESC => $uamDescription,
			$mySQLManager->CONCEPTS_ID => $newConceptId,
			$mySQLManager->EVENTS_ID => 1
		],
		true,
		true
	);

	if (!$newUamId)
		return false;

	return true;
}
