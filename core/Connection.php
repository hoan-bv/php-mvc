<?php

class Connection {

	// Hold the class instance.
	private static $instance = null, $conn = null;

	// The constructor is private
	// to prevent initiation with outer code.
	private function __construct($db_config) {

		try {
			$dns = 'mysql:dbname=' . $db_config['db'] . ';host=' . $db_config['host'];
			/** config utf8
			 * Exception connection error
			 */
			$option_db_config = [
				//				PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAME "utf8"',
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			];
			$con              = new PDO($dns, $db_config['user'], 'mysql', $option_db_config);
			self::$conn       = $con;
			var_export($con);
			return $con;
		} catch (Exception $exception) {
			App::$app->loadError('database', ['message' => $exception->getMessage()]);
			die;
		}

		// The expensive process (e.g.,db connection) goes here.
		echo 'connect success';
	}

	// The object is created from within the class itself
	// only if the class has no instance.
	public static function getInstance($db_config) {
		if (self::$instance == null) {
			$connection     = new Connection($db_config);
			self::$instance = self::$conn;
		}
		return self::$instance;
	}
}

