<?php

/**
 * @property string $table
 */
class HomeModel extends Model {

	protected $__table = 'product';

	function tableFill() {
		return 'product';
	}

	/**
	 * @return string[]
	 */
	public function getList() {
		return $this->db->query("select * from product")->fetchAll(PDO::FETCH_ASSOC);
	}

	public function getDetail(int $id) {

	}

	function filedFill() {
		return '*';
	}
}
