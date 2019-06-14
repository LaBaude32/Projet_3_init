<?php
class Frontend
{
    public function actionHome()
    {
        $PostManager = new PostManager();
        $posts = $PostManager->findPublished();
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
            include(VIEW . 'commentAdded.php');
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
            $autor = $AutorManager->findOneByEmail($_POST['email']);
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

        //1 recuepère le user par son identifiant avec les roles
        //2 user et le password hashé
        //3A tu compares le password hashé avec une hash du password tapé
        //    ex: if(mot de pass bdd = sha1(mot dep asse tapé))
        //3B passwordverify(mdp en clair tapé, le mdp bdd);

        // password_hash et password_verify


        // instancie Session log, session role + les preferences / les config
        // Alimente les vars de sessions
    }

    //faire une logout -> session_destroy() -> redicrection acceuil

}
