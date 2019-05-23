<?php
require_once('config.php');

MyAutoload::start();

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
					'admin' => array('controller' => 'backend', 'method' => 'actionBackend', 'roles' => array('ADMIN', 'MANAGER' )),
					'validateComment' => array('controller' => 'backend', 'method' => 'actionValidateComment'),
					'deleteComment' => array('controller' => 'backend', 'method' => 'actionDeleteComment'),
					'editChapter' => array('controller' => 'backend', 'method' => 'actionEditChapter'),
					'publishChapter' => array('controller' => 'backend', 'method' => 'actionPublishChapter'),
					'saveDraft' => array('controller' => 'backend', 'method' => 'actionSaveDraft'),
					'createDraft' => array('controller' => 'backend', 'method' => 'actionCreateDraft'),
					'saveNewDraft' => array('controller' => 'backend', 'method' => 'actionSaveNewDraft'),
				);

//echo '<pre>'; var_dump('controller/'.$routes[$action]['controller'].'.php'); die;
if(key_exists($action, $routes)) {

	require_once('controller/'.$routes[$action]['controller'].'.php');

	$controller = ucfirst($routes[$action]['controller']);
	$method = $routes[$action]['method'];

	if($controller == "backend") {
		if($_SESSION['log'] == 1 && in_array($_SESSION['role'], $routes[$action]['roles'] )){

			$controller = new $controller();
			$controller->$method();
		} else {
			echo '403'; // new ErrorPage() -> sho403();
		}
	} else {
		$controller = new $controller();
		$controller->$method();
	}




} else {
	echo '404'; // new ErrorPage() -> sho404();
}