<?php
require_once('model/postManager.php');

class Frontend {
    public function actionHome()
    {
        $PostManager = new PostManager();
        $posts = $PostManager->findAll();
        include('view/home.php');
    }

    public function actionChapter()
    {
	    if (isset($_GET['id']) && $_GET['id'] > 0) {
	        $ID = $_GET['id'];
		    }
        $PostManager = new PostManager();
        $posts = $PostManager->findAll();

        $CommentsManager = new CommentsManager();
        $comments = $CommentsManager->returnComments($ID);
		include('view/chapter.php');
    }

    public function actionCommentAdded()
    {
        if (isset($_POST['PostID']) && $_POST['PostID'] > 0 && isset($_POST['Pseudo']) && isset($_POST['Comments_content'])){
            $pseudo = $_POST['Pseudo'];
            $content = $_POST['Comments_content'];
            $postID = $_POST['PostID'];
            addComment($pseudo, $content, $postID);
            include('view/commentAdded.php');
        }
    }
}