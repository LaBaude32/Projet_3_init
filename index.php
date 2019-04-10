<?php

require_once('controller/frontend.php');

if(isset($_GET['action'])){
	$action = $_GET['action'];
} else{
	$action = "home";
}

$action = "action".ucfirst($action);
$controller = new Frontend();
$controller->$action();

//include('controller/'.$action.'.php');