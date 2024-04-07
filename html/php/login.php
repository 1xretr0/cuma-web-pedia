<?php

include_once 'db/MySQLDAO.php';

session_start();

function isUserLogged() {
	return boolval($_SESSION['loggedUserId']);
}

function getUsernameByUserId(int $userId) {
	$mysqlManager = new MySQLDAO();
	return $mysqlManager->executeSelect(
		$mysqlManager->USERS_TABLE,
		[$mysqlManager->USERS_FIRSTNAME],
		[$mysqlManager->USERS_ID => $userId]
	);
}

print_r(getUsernameByUserId(1));
die;