<?php
include_once(MODEL.'backendManager.php');

class Backend
{
    public function actionLogin()
    {
        //include('');
    }

    public function actionBackend()
    {
        $PostManager = new PostManager();
        $posts = $PostManager->findAll(); //a modifer pour n'avoir que ceux publiés

        $BackendManager = new BackendManager();
        $comments = $BackendManager->returnCommentsToValidate();

        $PostManager = new PostManager();
        $drafts = $PostManager->findDrafts();

        include(VIEW.'backend/backend.php');
    }

    public function actionValidateComment()
    {
        if (isset($_GET['id']) && $_GET['id'] > 0){
            $CommentsManager = new CommentsManager();
            $comments = $CommentsManager->validateComment($_GET['id']);

            $Backend = new Backend();
            $Backend->actionBackend();
        }

    }

    public function actionDeleteComment()
    {
        if (isset($_GET['id']) && $_GET['id'] > 0){
            $CommentsManager = new CommentsManager();
            $comments = $CommentsManager->deleteComment($_GET['id']);

            $Backend = new Backend();
            $Backend->actionBackend();
        }

    }

    public function actionEditChapter()
    {
        if (isset($_GET['id']) && $_GET['id'] > 0){
            $PostManager = new PostManager();
            $post = $PostManager->findOneById($_GET['id']);
            $ID = $_GET['id'];

            include(VIEW.'backend/chapterEditing.php');

        }
    }

}
