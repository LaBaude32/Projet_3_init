<?php
require_once('model/postManager.php');

class Frontend {
    public function actionHome()
    {
    	$posts = getPosts();
        include('view/home.php');
    }

    public function actionChapter()
    {
	    if (isset($_GET['id']) && $_GET['id'] > 0) {
	        $ID = $_GET['id'];
		    }
		$posts = getPost($ID);
		$comments = getComments($ID);
		include('view/chapter.php');
    }
}