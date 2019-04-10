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
		}
		catch(Exception $e)
		{
		        die('Erreur : '.$e->getMessage());
		}

		$chapter = getChapter($ID);
		include('view/chapter.php');
    }
}