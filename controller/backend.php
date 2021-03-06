<?php
class Backend
{
    public function actionBackend()
    {
        $PostManager = new PostManager();
        $posts = $PostManager->findPublished();

        $CommentsManager = new CommentsManager();
        $comments = $CommentsManager->returnCommentsToValidate();

        $PostManager = new PostManager();
        $drafts = $PostManager->findDrafts();

        include(VIEW . 'backend/backend.php');
    }

    public function actionValidateComment()
    {
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $CommentsManager = new CommentsManager();
            $comments = $CommentsManager->validateComment($_GET['id']);

            header('Location:index.php?action=admin');
        }
    }

    public function actionDeleteComment()
    {
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $CommentsManager = new CommentsManager();
            $comments = $CommentsManager->deleteComment($_GET['id']);

            header('Location:index.php?action=admin');
        }
    }

    public function actionEditPost()
    {
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $id = $_GET['id'];
            $PostManager = new PostManager();
            $post = $PostManager->findOneById($id);
        } else {
            $post = new Post();
        }

        include(VIEW . 'backend/createPost.php');
    }

    public function actionUpdatePost()
    {
        var_dump($_POST);
        if (isset($_POST['id']) && isset($_POST['title']) && isset($_POST['content']) && isset($_POST['isDraft'])) {

            $postArray = array(
                'id' => $_POST['id'],
                'title' => $_POST['title'],
                'content' => $_POST['content'],
                'isDraft' => $_POST['isDraft'],
                'autorId' => $_SESSION['idAdmin'],

            );

            $PostManager = new PostManager();
            $PostManager->save($postArray);

            header('Location:index.php?action=admin');
        }
    }

    public function actionDeleteDraft()
    {
        if (isset($_GET['id']) && $_GET['id'] >= 0) {
            $id = $_GET['id'];

            $PostManager = new PostManager();
            $post = $PostManager->findOneById($id);
            if ($post->getIsDraft() == 1) {
                $PostManager->delete($id);
            }

            header('Location:index.php?action=admin');
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
        if (isset($_GET['id']) && $_GET['id'] > 1) {
            $id = $_GET['id'];
        }
        $AutorManager = new AutorManager();
        $autor = $AutorManager->delete($id);

        header('Location:index.php?action=managerAutors');
    }

    public function actionEditAutor()
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
            $AutorManager->save($autorArray);

            header('Location:index.php?action=managerAutors');
        }
    }

    public function actionManageBook()
    {
        $BookManager = new BookManager();
        $book = $BookManager->findOneById(1);
        include(VIEW . 'backend/editBook.php');
    }

    public function actionUpdateBook()
    {
        if (isset($_POST['id']) && isset($_POST['title']) && isset($_POST['content'])) {

            $bookArray = array(
                'id' => $_POST['id'],
                'title' => $_POST['title'],
                'content' => $_POST['content']
            );

            $BookManager = new BookManager();
            $BookManager->save($bookArray);

            header('Location:index.php?action=admin');
        }
    }
}
