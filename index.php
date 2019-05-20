<?php
require_once('config.php');

if(isset($_GET['action'])){
	$action = $_GET['action'];
} else{
	$action = "home";
}

$routes = array(
					'home' => array('controller' => 'frontend', 'method' => 'actionHome'),
					'chapter' => array('controller' => 'frontend', 'method' => 'actionChapter'),
					'addComment' => array('controller' => 'frontend', 'method' => 'actionCommentAdded'),

					//'admin' => array('controller' => 'backend', 'method' => 'actionLogin'),
					'admin' => array('controller' => 'backend', 'method' => 'actionBackend'),
					'validateComment' => array('controller' => 'backend', 'method' => 'actionValidateComment'),
					'deleteComment' => array('controller' => 'backend', 'method' => 'actionDeleteComment'),
					'editChapter' => array('controller' => 'backend', 'method' => 'actionEditChapter'),
					'publishChapter' => array('controller' => 'backend', 'method' => 'actionPublishChapter'),
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