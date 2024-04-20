<?php

require_once(realpath(dirname(__FILE__) . "/..") . '/db/MySQLDAO.php');

function getUsernameByUserId(int $userId) : array | bool | null {
	$mysqlManager = new MySQLDAO();
	$query = "SELECT $mysqlManager->USERS_FIRSTNAME FROM $mysqlManager->USERS_TABLE WHERE $mysqlManager->USERS_ID = $userId";
	return $mysqlManager->executeRawSelect($query);
}

function getUserDataByCredentials(string $username, string $password): array | bool | null {
	$username = filter_var($username, FILTER_SANITIZE_EMAIL);
	// CIFRADO MD5
	$password = md5(filter_var($password, FILTER_SANITIZE_STRING));

	$mysqlManager = new MySQLDAO();
	$query = "SELECT
				$mysqlManager->USERS_ID,
				$mysqlManager->USERS_FIRSTNAME,
				$mysqlManager->USERS_ADMIN
			FROM
				$mysqlManager->USERS_TABLE
			WHERE
				$mysqlManager->USERS_EMAIL = '$username'
				AND $mysqlManager->USERS_PASSWORD = '$password'"
	;
	return $mysqlManager->executeRawSelect($query, true);
}

function createNewUser(
	string $firstnames,
	string $lastnames,
	string $email,
	string $password,
	?string $admin = null
): int | bool | null {
	$firstnames = filter_var($firstnames, FILTER_SANITIZE_STRING);
	$lastnames = filter_var($lastnames, FILTER_SANITIZE_STRING);
	$email = filter_var($email, FILTER_SANITIZE_EMAIL);
	$password = filter_var($password, FILTER_SANITIZE_STRING);

	$admin = $admin === "1" ? 1 : 0;

	$mysqlManager = new MySQLDAO();
	return $mysqlManager->executeInsert(
		$mysqlManager->USERS_TABLE,
		[
			$mysqlManager->USERS_FIRSTNAME 	=> $firstnames,
			$mysqlManager->USERS_LASTNAMES 	=> $lastnames,
			$mysqlManager->USERS_EMAIL 		=> $email,
			$mysqlManager->USERS_PASSWORD 	=> md5($password),
			$mysqlManager->USERS_ADMIN 		=> $admin
		],
		true,
		true
	);
}
