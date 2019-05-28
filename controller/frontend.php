<?php
class Frontend
{
    public function actionHome()
    {
        $PostManager = new PostManager();
        $posts = $PostManager->findPublished();
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

    public function actionConnectionForm()
    {
        include(VIEW.'connection.php');
    }

    public function actionLogin()
    {
        if(isset($_POST['email']) && isset($_POST['pwd'])){
            $AutorManager = new AutorManager;
            $autor = $AutorManager->findOneByEmail($_POST['email']);
            if(password_verify($_POST['pwd'], $autor->getPwd())){
                $_SESSION['log'] = 1;
                $_SESSION['pseudo'] = $autor->getPseudo();
                $_SESSION['role'] = $autor->getRole();
            }else{
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
        var_dump($autor->getRole());
        var_dump($_SESSION['role']);

        //header('Location:index.php?action=admin');
    }

    //faire une logout -> session_destroy() -> redicrection acceuil

}