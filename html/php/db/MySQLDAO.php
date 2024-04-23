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
	// uams table
	public $UAMS_TABLE 			= 'cm_uams';
	public $UAMS_ID 			= 'id_uam';
	public $UAMS_NAME 			= 'nombre';
	public $UAMS_DESC 			= 'descripcion';
	// public $UAMS_CONCEPT_ID 	= 'id_fundamento';
	public $UAMS_EVENT_ID 		= 'id_hecho';
	// public $UAMS_STATE_ID		= 'id_estado';
	// events table
	public $EVENTS_TABLE 		= 'cm_hechos_culturales';
	public $EVENTS_ID 			= 'id_hecho';
	public $EVENTS_NAME 		= 'nombre_hecho';
	public $EVENTS_DESC 		= 'descripcion';
	public $EVENTS_YEAR 		= 'year';
	// public $EVENTS_GROUP_ID 	= 'id_grupo';
	// public $EVENTS_AREA_ID 		= 'id_area';
	// cultural groups table
	public $GROUPS_TABLE 		= 'cm_grupos_culturales';
	public $GROUPS_ID 			= 'id_grupo';
	public $GROUPS_NAME 		= 'nombre';
	// geographic areas table
	public $AREAS_TABLE 		= 'cm_areas_geograficas_ctl';
	public $AREAS_ID 			= 'id_area';
	public $AREAS_NAME 			= 'nombre_area';
	// states table
	public $STATES_TABLE		= 'cm_estados_migratorios_ctl';
	public $STATES_ID			= 'id_estado';
	public $STATES_NAME			= 'nombre_estado';
	public $STATES_KEY			= 'clave_estado';
	// resource concepts table
	public $RESOURCE_CONCEPT_TABLE = 'cm_recurso_fundamentos';

	public $RESOURCE_TYPES_TABLE = 'cm_tipos_recurso_ctl';
	public $RESOURCE_TYPES_ID 	= 'id_tipo';
	public $RESOURCE_TYPES_NAME = 'nombre';

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
			$_ENV['cm_host'],
			$_ENV['cm_username'],
			$_ENV['cm_password'],
			$_ENV['cm_database']
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
	) {
		$conn = $this->getConnection();

		$selectClause = $fields ? implode(',', $fields) : '*';

		$whereClause = '';
		if ($filters) {
			foreach ($filters as $key => $value) {
				$whereClause = $whereClause ?
					$whereClause .= "AND $key = '$value' "
				:
					$whereClause .= "WHERE $key = '$value' "
				;
			}
		}

		$query = "SELECT $selectClause FROM $tableName $whereClause;";

		try {
			$result = $conn->query($query);

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
	) {
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
	) {
		$conn = $this->getConnection();

		$query = "INSERT INTO $tableName ";

		if ($fields) {
			$query .= '(' . implode(', ', array_keys($values)) . ') ';
		}

		$valuesString = '';
		foreach ($values as $value) {
			if (gettype($value) != 'integer')
				$value = "'$value'";

			if (!$valuesString)
				$valuesString .= "VALUES ($value";
			else
				$valuesString .= ",$value";
		}
		$valuesString .= ');';

		$query .= $valuesString;
		// return $query;
		try {
			$result = $conn->query($query);

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

	public function executeUpdate(
		string $tableName,
		array $values,
		?array $filters = null,
	) {
		$conn = $this->getConnection();

		$valuesString = '';
		foreach ($values as $key => $value) {
			if (gettype($value) != 'integer')
				$value = "'$value'";

			if (!$valuesString)
				$valuesString .= "$key = $value";
			else
				$valuesString .= ", $key = $value";
		}

		$whereClause = '';
		if ($filters) {
			foreach ($filters as $key => $value) {
				if (gettype($value) != 'integer')
					$value = "'$value'";

				$whereClause = $whereClause ?
					$whereClause .= "AND $key = $value "
				:
					$whereClause .= "WHERE $key = $value "
				;
			}
		}

		$query = "UPDATE $tableName SET $valuesString $whereClause;";
		// return $query;
		try {
			$conn->begin_transaction();
			$result = $conn->query($query);

			if (!isset($result) || !$result) {
				$conn->rollback();
				return false;
			}

			$conn->commit();
			return true;
		}
		catch (Exception $e) {
			$conn->rollback();
			return false;
		} finally {
			$conn->close();
		}
	}

	public function executeDelete(
		string $tableName,
		array $filters
	) {
		$conn = $this->getConnection();

		$whereClause = '';
		if ($filters) {
			foreach ($filters as $key => $value) {
				if (gettype($value) != 'integer')
				$value = "'$value'";

				$whereClause = $whereClause ?
					$whereClause .= "AND $key = $value "
					:
					$whereClause .= "$key = $value ";
			}
		}

		$query = "DELETE FROM $tableName WHERE $whereClause;";
		// return $query;
		try {
			$conn->begin_transaction();
			$result = $conn->query($query);

			if (!isset($result) || !$result) {
				$conn->rollback();
				return false;
			}

			$conn->commit();
			return true;
		} catch (Exception $e) {
			$conn->rollback();
			return false;
		} finally {
			$conn->close();
		}
	}
}
