<?php
require_once('config.php');



if(isset($_GET['action'])){
	$action = $_GET['action'];
} else{
	$action = "home";
}

$routes = array(
					'home' => array('controller' => 'frontend', 'method' => 'actionHome'),
					'admin' => array('controller' => 'backend', 'method' => 'login'),
);


if(key_exists($action, $routes)) {

	require_once('controller/'.$routes['controller'].'.php');

	$controller = ucfirst($routes['controller']);
	$method = $routes['method'];

	$controller = new $controller();
	$controller->$method();

} else {
	echo '404';
}




//$action = "action".ucfirst($action);




$controller = new Frontend();
$controller->$action();

//include('controller/'.$action.'.php');