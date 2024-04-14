<?php

require_once(realpath(dirname(__FILE__) . "/..") . '/db/MySQLDAO.php');

function getUsernameByUserId(int $userId) : array | bool | null {
	$mysqlManager = new MySQLDAO();
	return $mysqlManager->executeSelect(
		$mysqlManager->USERS_TABLE,
		[$mysqlManager->USERS_FIRSTNAME],
		[$mysqlManager->USERS_ID => $userId]
	);
}

function getUserDataByCredentials(string $username, string $password): array | bool | null {
	$username = filter_var($username, FILTER_SANITIZE_EMAIL);
	$password = filter_var($password, FILTER_SANITIZE_STRING);

	$mysqlManager = new MySQLDAO();
	return $mysqlManager->executeSelect(
		$mysqlManager->USERS_TABLE,
		[$mysqlManager->USERS_ID, $mysqlManager->USERS_FIRSTNAME],
		[
			$mysqlManager->USERS_EMAIL => $username,
			$mysqlManager->USERS_PASSWORD => $password
		],
		true
	);
}

function createNewUser(
	string $firstnames,
	string $lastnames,
	string $email,
	string $password
): int | bool | null {
	$firstnames = filter_var($firstnames, FILTER_SANITIZE_STRING);
	$lastnames = filter_var($lastnames, FILTER_SANITIZE_STRING);
	$email = filter_var($email, FILTER_SANITIZE_EMAIL);
	$password = filter_var($password, FILTER_SANITIZE_STRING);

	$mysqlManager = new MySQLDAO();
	return $mysqlManager->executeInsert(
		$mysqlManager->USERS_TABLE,
		[
			$mysqlManager->USERS_FIRSTNAME 	=> $firstnames,
			$mysqlManager->USERS_LASTNAMES 	=> $lastnames,
			$mysqlManager->USERS_EMAIL 		=> $email,
			$mysqlManager->USERS_PASSWORD 	=> $password
		],
		true,
		true
	);
}
