<?php

require_once(realpath(dirname(__FILE__) . "/..") . '/db/MySQLDAO.php');

function getUsernameByUserId(int $userId) {
	$mysqlManager = new MySQLDAO();
	$query = "SELECT $mysqlManager->USERS_FIRSTNAME FROM $mysqlManager->USERS_TABLE WHERE $mysqlManager->USERS_ID = $userId";
	return $mysqlManager->executeRawSelect($query);
}

function getUserDataByCredentials(string $username, string $password) {
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

function getAllUsers() {
	$mysqlManager = new MySQLDAO();
	return $mysqlManager->executeSelect(
		$mysqlManager->USERS_TABLE,
		null,
		null,
		true
	);
}

function createNewUser(
	string $firstnames,
	string $lastnames,
	string $email,
	string $password,
	?string $admin = null
) {
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

function updateUserById(
	string $userId,
	string $firstnames,
	string $lastnames,
	string $email,
	string $password,
	?string $admin = null
) {
	$firstnames = filter_var($firstnames, FILTER_SANITIZE_STRING);
	$lastnames = filter_var($lastnames, FILTER_SANITIZE_STRING);
	$email = filter_var($email, FILTER_SANITIZE_EMAIL);
	$password = filter_var($password, FILTER_SANITIZE_STRING);

	$admin = $admin === "1" ? 1 : 0;

	$mysqlManager = new MySQLDAO();
	return $mysqlManager->executeUpdate(
		$mysqlManager->USERS_TABLE,
		[
			$mysqlManager->USERS_FIRSTNAME 	=> $firstnames,
			$mysqlManager->USERS_LASTNAMES 	=> $lastnames,
			$mysqlManager->USERS_EMAIL 		=> $email,
			$mysqlManager->USERS_PASSWORD 	=> md5($password),
			$mysqlManager->USERS_ADMIN 		=> $admin
		],
		[$mysqlManager->USERS_ID => $userId]
	);
}

function deleteUserById(
	string $userId
) {
	$mysqlManager = new MySQLDAO();
	return $mysqlManager->executeDelete(
		$mysqlManager->USERS_TABLE,
		[$mysqlManager->USERS_ID => $userId]
	);
}
