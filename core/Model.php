<?php

/**
 * @property Database $db;
 */
abstract class Model extends Database {

	protected $db, $tableName;

	function __construct() {
		$this->db = new         Database();
	}

	abstract function tableFill();

	abstract function filedFill();

	function setTable($table) {
		$this->tableName = $table;
	}

	function get() {
		$tableName   = $this->tableFill();
		$fieldSelect = $this->filedFill();
		$sql         = "SELECT $fieldSelect FROM $tableName";
		$query = $this->db->query($sql);
		if (!empty($query)) {
			return $query->fetchAll(PDO::FETCH_ASSOC);
		}
		return false;
	}
	function first() {
		$tableName   = $this->tableFill();
		$fieldSelect = $this->filedFill();
		$sql         = "SELECT $fieldSelect FROM $tableName ";
		$query = $this->db->query($sql);
		if (!empty($query)) {
			return $query->fetch(PDO::FETCH_ASSOC);
		}
		return false;
	}
}
