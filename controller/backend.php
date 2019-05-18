<?php
include_once('MODEL/backendManager.php');

class Backend
{
    public function actionLogin()
    {
        //include('');
    }

    public function actionBackend()
    {
        $PostManager = new PostManager();
        $posts = $PostManager->findAll();

        $BackendManager = new BackendManager();
        $comments = $BackendManager->returnCommentsToValidate();

        $BackendManager = new BackendManager();
        $drafts = $BackendManager->findDrafts();

        include('VIEW/backend/backend.php');
    }
}
