<?php

class Home extends Controller {

	protected HomeModel $model_home;

	public function __construct() {
		$this->model_home = $this->model('HomeModel');
		//		echo ;die();
	}

	public function index() {


		echo '<pre>';
		var_export($this->model_home->getList());
		die;
		echo 'Home page';
	}

	public function detail() {
		$data = $this->model_home->first();
	}
}
