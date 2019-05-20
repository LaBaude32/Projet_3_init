<?php
require_once(MODEL.'postManager.php');
require_once(MODEL.'commentsManager.php');

class Frontend
{
    public function actionHome()
    {
        $PostManager = new PostManager();
        $posts = $PostManager->findAll();
        include(VIEW.'home.php');
    }

    public function actionChapter()
    {
	    if (isset($_GET['id']) && $_GET['id'] >= 0) {
	        $ID = $_GET['id'];
		    }
        $PostManager = new PostManager();
        $posts = $PostManager->findAll();

        $CommentsManager = new CommentsManager();
        $comments = $CommentsManager->returnComments($ID);
		include(VIEW.'chapter.php');
    }

    public function actionCommentAdded()
    {
        if (isset($_POST['PostID']) && $_POST['PostID'] > 0 && isset($_POST['Pseudo']) && isset($_POST['Comments_content'])){
            $pseudo = $_POST['Pseudo'];
            $content = $_POST['Comments_content'];
            $postId = $_POST['PostID'];
            $CommentsManager = new CommentsManager();
            $comments = $CommentsManager->addComment($pseudo, $content, $postId);
            include(VIEW.'commentAdded.php');
        }
    }


}