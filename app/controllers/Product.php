<?php

class Product extends Controller {

	function index() {
		echo 'list product';
	}

	function list_product() {
		$product = $this->model('ProductModel');
		$data    = $product->getProductLists();
		$this->render('products/list', []);
	}

	function detail() {
		$this->render('layout/main', [
			'content'     => 'products/detail',
			'page_title'     => 'Detail',
			'sub_content' => ['detail' => 'detail product'],
		]);
	}
}
