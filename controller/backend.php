<?php
class Backend
{
    public function actionBackend()
    {
        $PostManager = new PostManager();
        $posts = $PostManager->findPublished(); //a modifer pour n'avoir que ceux publiés

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

    public function actionPublishChapter()
    {
        if (isset($_GET['id']) && $_GET['id'] > 0){
            $PostManager = new PostManager();
            $PostManager->publishChapter($_GET['id']);

            $Frontend = new Frontend();
            $Frontend->actionChapter();

            header('Location:index.php'); //location:ROOT
        }
    }

    public function actionSaveDraft()
    {
        if (isset($_GET['id']) && $_GET['id'] > 0 && isset($_POST['postContent'])){

           // var_dump($_POST['postContent']); die;
            $PostManager = new PostManager();
            $PostManager->saveDraft($_GET['id'], $_POST['postContent']);

            $Backend = new Backend();
            $Backend->actionEditChapter();

        }
    }

    public function actionCreateDraft()
    {
        include(VIEW.'backend/createChapter.php');
    }

    public function actionSaveNewDraft()
    {
        if (isset($_POST['title']) && isset($_POST['content']) && isset($_POST['isDraft'])){

           // var_dump($_POST['postContent']); die;
            $PostManager = new PostManager();
            $PostManager->createDraft($_POST['title'], $_POST['content'],$_POST['isDraft']);

            header('Location:index.php');
        }
    }
}