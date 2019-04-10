<?php
require_once('model/postManager.php');

class Frontend {
    public function actionHome()
    {
    	$posts = getPosts();
        include('view/home.php');
    }
}