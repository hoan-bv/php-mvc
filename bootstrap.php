<?php
const _DIR_ROOT = __DIR__;
$config_dir = scandir('config');
if (!empty($config_dir)) {

	foreach ($config_dir as $item) {

		if (strpos($item, 'php') && file_exists('config/' . $item)) {

			require_once 'config/' . $item;
		}
	}
}
require_once 'config/app.php';
require_once 'config/db.php';
require_once 'core/Route.php';
require_once 'config/routes.php';
require_once 'app/App.php';
/** @var array $config */
if (!empty($config)) {

	$db_config = array_filter($config['db']);
	if (!empty($db_config)) {
		require_once 'core/Connection.php';
		require_once 'core/Database.php';

	}
}
require_once 'core/Model.php';

require_once 'core/Controller.php';
