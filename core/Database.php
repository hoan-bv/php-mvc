<?php

class Database {

	private $__conn;

	public function __construct() {
		global $db_config;
		$this->__conn = Connection::getInstance($db_config);
		print_r($this->__conn);
	}

	function insert($table, $data) {
		if (!empty($data)) {
			$fieldStr = '';
			$valueStr = '';
			foreach ($data as $key => $datum) {
				$fieldStr .= $key . ',';
				$valueStr .= "'" . $datum . ",'";
			}
			$fieldStr = rtrim($fieldStr, ',');
			$valueStr = rtrim($valueStr, ',');
			$sql      = "INSERT INTO $table($fieldStr) VALUE ($valueStr)";
			$status   = $this->query($sql);
			if ($status) {
				return true;
			}
		}
		return false;
	}

	/**
	 * @param        $table
	 * @param        $data
	 * @param string $condition
	 *
	 * @return bool
	 */
	function update($table, $data, string $condition = ''): bool {
		if (!empty($data)) {
			$updateStr = '';
			foreach ($data as $key => $datum) {
				$updateStr .= "'" . $datum . ",'";
			}
			$updateStr = rtrim($updateStr, ',');
			if (!empty($condition)) {
				$sql = "UPDATE $table SET $updateStr WHERE $condition";
			} else {

				$sql = "UPDATE $table SET $updateStr";
			}
			$status = $this->query($sql);
			if ($status) {
				return true;
			}
		}
		return false;
	}

	/**
	 * @param $table
	 * @param $condition
	 *
	 * @return bool
	 */
	function delete($table, $condition) {
		if (!empty($condition)) {
			$sql = "DELETE FROM $table WHERE $condition";
		} else {
			$sql = "DELETE FROM $table";
		}
		$status = $this->query($sql);
		if ($status) {
			return true;
		}
		return false;
	}

	/**
	 * @param string $sql
	 *
	 * @return mixed
	 */
	 function query(string $sql) {
		 try {

			 $statement = $this->__conn->prepare($sql);
			 $statement->execute();
			 return $statement;
		 }catch (Exception $e){
			 $mes = $e->getMessage();
			 $data['message'] = $mes;
			 App::$app->loadError($data);
			 die();
		 }
	}

	function lastInsertId() {
		return $this->__conn->lastInsertId();
	}

	public function prepare(string $sql) {
	}
}
