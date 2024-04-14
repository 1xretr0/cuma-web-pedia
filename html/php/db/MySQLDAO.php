<?php

class MySQLDAO {
	// private $conn;

	// DB ENTITIES CONSTANTS
	public $DB_NAME 			= 'cuma';
	// users table
	public $USERS_TABLE 		= 'cm_usuarios';
	public $USERS_ID 			= 'id_usuario';
	public $USERS_FIRSTNAME 	= 'nombres_personales_usuario';
	public $USERS_LASTNAMES 	= 'apellidos_personales_usuario';
	public $USERS_EMAIL 		= 'correo_usuario';
	public $USERS_PASSWORD 		= 'contrasena_usuario';
	public $USERS_ADMIN 		= 'administrador';
	// concepts table
	public $CONCEPTS_TABLE 		= 'cm_fundamentos_sanitarios';
	public $CONCEPTS_ID 		= 'id_fundamento';
	public $CONCEPTS_NAME 		= 'nombre_fundamento';
	public $CONCEPTS_DESC 		= 'descripcion_fundamento';
	public $CONCEPTS_IMG 		= 'imagen';
	// resources table
	public $RESOURCES_TABLE 	= 'cm_recursos';
	public $RESOURCES_ID 		= 'id_recurso';
	public $RESOURCES_TITLE 	= 'titulo_recurso';
	public $RESOURCES_DESC 		= 'descripcion_recurso';
	public $RESOURCES_CONTENT 	= 'contenido_recurso';
	public $RESOURCES_IMG 		= 'imagen';
	public $RESOURCES_URL 		= 'url_recurso';
	public $RESOURCES_TYPE 		= 'id_tipo_recurso';
	public $RESOURCES_LANG 		= 'idioma';
	public $RESOURCES_DATE 		= 'fecha_recurso';
	public $RESOURCES_PUB_DATE 	= 'fecha_publicacion';

	public function __construct() {
		// PHP_EXTENSION_DIR
		$this->loadDotenv();
	}

	private function loadDotenv(): bool {
		// BREAK PROCESS IF ENV ALREADY LOADED
		if (isset($_ENV['database']))
			return true;

		$env_file_path = realpath(__DIR__ . "/.env");

		if (!is_file($env_file_path)) {
			throw new ErrorException("Environment File is Missing.");
			return false;
		}

		if (!is_readable($env_file_path)) {
			throw new ErrorException("Permission Denied for reading the " . ($env_file_path) . ".");
			return false;
		}

		$var_arrs = array();
		// Open the .en file using the reading mode
		$fopen = fopen($env_file_path, 'r');
		if ($fopen) {
			//Loop the lines of the file
			while (($line = fgets($fopen)) !== false) {
				// Check if line is a comment
				$line_is_comment = (substr(trim($line), 0, 1) == '#') ? true : false;
				// If line is a comment or empty, then skip
				if ($line_is_comment || empty(trim($line)))
					continue;

				// Split the line variable and succeeding comment on line if exists
				$line_no_comment = explode("#", $line, 2)[0];
				// Split the variable name and value
				$env_ex = preg_split('/(\s?)\=(\s?)/', $line_no_comment);
				$env_name = trim($env_ex[0]);
				$env_value = isset($env_ex[1]) ? trim($env_ex[1]) : "";
				$var_arrs[$env_name] = $env_value;
			}
			// Close the file
			fclose($fopen);
		}

		foreach ($var_arrs as $name => $value) {
			//Using putenv()
			// putenv("{$name}={$value}");

			//Or, using $_ENV
			$_ENV[$name] = $value;
		}

		return true;
	}

	private function getConnection() {
		$conn = new mysqli(
			$_ENV['host'],
			$_ENV['username'],
			$_ENV['password'],
			$_ENV['database']
		);
		if ($conn->connect_error) {
			throw new ErrorException("DB Connection Failed!");
			return false;
		}

		return $conn;
	}

	public function executeSelect(
		string $tableName,
		?array $fields = null,
		?array $filters = null,
		bool $assoc = false
	): array | bool | null {
		$conn = $this->getConnection();

		$selectClause = $fields ? implode(',', $fields) : '*';

		$whereClause = '';
		if ($filters) {
			foreach ($filters as $key => $value) {
				$whereClause = $whereClause ?
					$whereClause .= "AND $key = ? "
				:
					$whereClause .= "WHERE $key = ? "
				;
			}
		}

		$query = "SELECT $selectClause FROM $this->DB_NAME.$tableName $whereClause;";
		// return $query;
		// die;
		try {
			if ($filters) {
				$stmt = $conn->prepare($query);

				// $paramTypes = '';
				// foreach ($filters as $value) {
				// 	if (gettype($value) === 'integer')
				// 		$paramTypes .= 'i';
				// 	else
				// 		$paramTypes .= 's';
				// }

				// $stmt->bind_param($paramTypes, array_values($filters));
				$stmt->execute(array_values($filters));
				$result = $stmt->get_result();
			}
			else {
				$result = $conn->query($query);
			}

			if ($assoc)
				return $result->num_rows > 0 ? $result->fetch_all(MYSQLI_ASSOC) : null;
			else
				return $result->num_rows > 0 ? $result->fetch_all(MYSQLI_NUM) : null;
		}
		catch (Exception $e) {
			return false;
		}
		finally {
			$conn->close();
		}
	}

	public function executeRawSelect(
		string $query,
		bool $assoc = false,
		?array $params = null
	) : array | bool | null {
		$conn = $this->getConnection();
		try {
			if ($params) {
				$stmt = $conn->prepare($query);
				$stmt->execute(array_values($params));
				$result = $stmt->get_result();
			} else
				$result = $conn->query($query);

			if ($assoc)
				return $result->num_rows > 0 ? $result->fetch_all(MYSQLI_ASSOC) : null;
			else
				return $result->num_rows > 0 ? $result->fetch_all(MYSQLI_NUM) : null;
		} catch (Exception $e) {
			return false;
		} finally {
			$conn->close();
		}
	}

	public function executeInsert(
		string $tableName,
		array $values,
		bool $fields = false,
		bool $lastId = false
	): string | bool | null {
		$conn = $this->getConnection();

		$query = "INSERT INTO $this->DB_NAME.$tableName ";

		if ($fields) {
			$query .= '(' . implode(', ', array_keys($values)) . ') ';
		}

		$valuesString = '';
		foreach ($values as $value) {
			if (!$valuesString)
				$valuesString .= 'VALUES (?';
			else
				$valuesString .= ',?';
		}
		$valuesString .= ');';

		$query .= $valuesString;
		try {
			$stmt = $conn->prepare($query);
			$stmt->execute(array_values($values));

			if ($lastId)
				return $conn->insert_id ?? false;

			if (!isset($result) || $result === -1)
				return false;
			elseif ($result === 0)
				return null;
			else
				return $result;
		} catch (Exception $e) {
			return false;
		} finally {
			$conn->close();
		}
	}
}
