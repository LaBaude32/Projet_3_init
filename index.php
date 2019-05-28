<?php
require_once('config.php');

MyAutoload::start();

if (isset($_GET['action'])) {
	$action = $_GET['action'];
} else {
	$action = "home";
}

$routeur = new Routeur($action);
$routeur->renderController();