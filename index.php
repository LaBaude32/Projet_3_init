<?php
require_once('config.php');

if(isset($_GET['action'])){
	$action = $_GET['action'];
} else{
	$action = "home";
}

$routes = array(
					'home' => array('controller' => 'frontend', 'method' => 'actionHome'),
					//'admin' => array('controller' => 'backend', 'method' => 'login'),
					'admin' => array('controller' => 'backend', 'method' => 'actionBackend'),
);


//echo '<pre>'; var_dump('controller/'.$routes[$action]['controller'].'.php'); die;
if(key_exists($action, $routes)) {

	require_once('controller/'.$routes[$action]['controller'].'.php');

	$controller = ucfirst($routes[$action]['controller']);
	$method = $routes[$action]['method'];

	$controller = new $controller();
	$controller->$method();

} else {
	echo '404';
}