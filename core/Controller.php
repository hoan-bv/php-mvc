<?php

class Controller {

	function model($model) {
		if (file_exists(_DIR_ROOT . '/app/models/' . $model . '.php')) {
			require_once _DIR_ROOT . '/app/models/' . $model . '.php';
			if (class_exists($model, _DIR_ROOT . '/app/models/' . $model . '.php')) {

				return new $model;
			}
		}
		return false;
	}

	public function render($view, $data = []) {

		extract($data);
//		echo '<pre>';
//		print_r($page_title);
//		die;
		if (file_exists(_DIR_ROOT . '/app/views/' . $view . '.php')) {
			require_once _DIR_ROOT . '/app/views/' . $view . '.php';
		} else {
//			echo '<pre>';
//			print_r(_DIR_ROOT . '/app/views/' . $view . '.php');
//			die;
			echo "View $view not found";
		}
	}
}
