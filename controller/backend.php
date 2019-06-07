<?php
class Backend
{
    public function actionBackend()
    {

        $PostManager = new PostManager();
        $posts = $PostManager->findPublished();

        $BackendManager = new BackendManager();
        $comments = $BackendManager->returnCommentsToValidate();

        $PostManager = new PostManager();
        $drafts = $PostManager->findDrafts();

        include(VIEW . 'backend/backend.php');
    }

    public function actionValidateComment()
    {
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $CommentsManager = new CommentsManager();
            $comments = $CommentsManager->validateComment($_GET['id']);

            $Backend = new Backend();
            $Backend->actionBackend();
        }
    }

    public function actionDeleteComment()
    {
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $CommentsManager = new CommentsManager();
            $comments = $CommentsManager->deleteComment($_GET['id']);

            $Backend = new Backend();
            $Backend->actionBackend();
        }
    }

    public function actionEditChapter()
    {
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $PostManager = new PostManager();
            $post = $PostManager->findOneById($_GET['id']);
            $ID = $_GET['id'];

            include(VIEW . 'backend/chapterEditing.php');
        }
    }

    public function actionPublishChapter()
    {
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $PostManager = new PostManager();
            $PostManager->publishChapter($_GET['id']);

            $Frontend = new Frontend();
            $Frontend->actionChapter();

            header('Location:index.php'); //location:ROOT
        }
    }

    public function actionSaveDraft()
    {
        if (isset($_GET['id']) && $_GET['id'] > 0 && isset($_POST['postContent'])) {

            $PostManager = new PostManager();
            $PostManager->saveDraft($_GET['id'], $_POST['postContent']);

            $Backend = new Backend();
            $Backend->actionEditChapter();
        }
    }

    public function actionCreateDraft()
    {
        include(VIEW . 'backend/createChapter.php');
    }

    public function actionSaveNewDraft()
    {
        if (isset($_POST['title']) && isset($_POST['content']) && isset($_POST['isDraft'])) {

            $PostManager = new PostManager();
            $PostManager->createDraft($_POST['title'], $_POST['content'], $_POST['isDraft']);

            header('Location:index.php');
        }
    }

    public function actionLogOut()
    {
        session_destroy();
        header('Location:index.php');
    }

    public function actionManageAutors()
    {
        $AutorManager = new AutorManager();
        $autors = $AutorManager->findAll();

        include(VIEW . 'backend/allAutors.php');
    }

    public function actionDisplayAutor()
    {
        if (isset($_GET['id']) && $_GET['id'] >= 0) {
            $id = $_GET['id'];
        }
        $AutorManager = new AutorManager();
        $autor = $AutorManager->findOneById($id);

        include(VIEW . 'backend/displayAutor.php');
    }

    public function actionDeleteAutor()
    {
        if (isset($_GET['id']) && $_GET['id'] >= 0) {
            $id = $_GET['id'];
        }
        $AutorManager = new AutorManager();
        $autor = $AutorManager->delete($id);

        header('Location:index.php?action=managerAutors');
    }

    public function actionEditAutor() // toutes les edit/create passe par ce controller, la création étant un cas particulier
    {
        if (isset($_GET['id']) && $_GET['id'] >= 0) {
            $id = $_GET['id'];
            $AutorManager = new AutorManager();
            $autor = $AutorManager->findOneById($id);
        } else {
            $autor = new Autor();
        }


        include(VIEW . 'backend/editAutor.php');
    }

    public function actionUpdateAutor()
    {
        if (isset($_POST['id']) && isset($_POST['email']) && isset($_POST['lastName']) && isset($_POST['firstName']) && isset($_POST['pseudo']) && isset($_POST['role'])) {


            // vérification de s champs et si echec creation d'un tableau error et revoie vers la vue edit

            // si submit && pas d'erreur

            $autorArray = array(
                'id' => $_POST['id'],
                'email' => $_POST['email'],
                'pwd' => $_POST['pwd'],
                'lastName' => $_POST['lastName'],
                'firstName' => $_POST['firstName'],
                'pseudo' => $_POST['pseudo'],
                'roleAdmin' => $_POST['role'],
            );

            $AutorManager = new AutorManager();
            $autor = $AutorManager->save($autorArray);

            header('Location:index.php?action=managerAutors');
        }
    }
}