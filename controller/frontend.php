<?php
class Frontend
{
    public function actionHome()
    {
        $PostManager = new PostManager();
        $posts = $PostManager->findPublished();
        $BookManager = new BookManager();
        $book = $BookManager->findOneById(1);
        include(VIEW . 'home.php');
    }

    public function actionChapter()
    {
        if (isset($_GET['id']) && $_GET['id'] >= 0) {
            $id = $_GET['id'];
        }
        $PostManager = new PostManager();
        $post = $PostManager->findOneById($id);

        $CommentsManager = new CommentsManager();
        $comments = $CommentsManager->returnComments($id);
        include(VIEW . 'chapter.php');
    }

    public function actionCommentAdded()
    {
        if (isset($_POST['PostID']) && $_POST['PostID'] > 0 && isset($_POST['Pseudo']) && isset($_POST['Comments_content'])) {
            $pseudo = $_POST['Pseudo'];
            $content = $_POST['Comments_content'];
            $postId = $_POST['PostID'];
            $CommentsManager = new CommentsManager();
            $comments = $CommentsManager->addComment($pseudo, $content, $postId);
            header('Location:index.php?id=' . $postId . '&action=chapter');
        }
    }

    public function actionReportComment()
    {
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $CommentsManager = new CommentsManager();
            $CommentsManager->reportComment($_GET['id']);
            header('Location:index.php');
        }
    }

    public function actionConnectionForm()
    {
        if (!isset($_SESSION['log'])) {
            $_SESSION['log'] = '';
        }
        if ($_SESSION['log'] == 0) {
            include(VIEW . 'connection.php');
        } else {
            header('Location:index.php?action=admin');
        }
    }

    public function actionLogin()
    {
        if (isset($_POST['email']) && isset($_POST['pwd'])) {
            $AutorManager = new AutorManager;
            if (!$autor = $AutorManager->findOneByEmail($_POST['email'])) {
                include(VIEW . '403.php');
                exit;
            }

            if (password_verify($_POST['pwd'], $autor->getPwd()) && $_POST['email'] == $autor->getEmail()) {
                $_SESSION['log'] = 1;
                $_SESSION['pseudo'] = $autor->getPseudo();
                $_SESSION['role'] = $autor->getRoleAdmin();
                $_SESSION['idAdmin'] = $autor->getId();
                header('Location:index.php?action=admin');
            } else {
                include(VIEW . '403.php');
            }
        }
    }
}
