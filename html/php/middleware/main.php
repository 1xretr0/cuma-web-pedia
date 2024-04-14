<?php

require_once(realpath(dirname(__FILE__) . "/..") . '/db/MySQLDAO.php');

function getUsernameByUserId(int $userId)
{
	$mysqlManager = new MySQLDAO();
	return $mysqlManager->executeSelect(
		$mysqlManager->USERS_TABLE,
		[$mysqlManager->USERS_FIRSTNAME],
		[$mysqlManager->USERS_ID => $userId]
	);
}

function getUserIdByCredentials(string $username, string $password): array | bool | null {
	$username = filter_var($username, FILTER_SANITIZE_EMAIL);
	$password = filter_var($password, FILTER_SANITIZE_STRING);

	$mysqlManager = new MySQLDAO();
	return $mysqlManager->executeSelect(
		$mysqlManager->USERS_TABLE,
		[$mysqlManager->USERS_ID],
		[
			$mysqlManager->USERS_USERNAME => $username,
			$mysqlManager->USERS_PASSWORD => $password
		]
	);
}
