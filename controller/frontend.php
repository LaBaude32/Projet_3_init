<?php
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

    public function actionConnection()
    {
        //include('');
    }

    public function actionLogin()
    {
        //1 recuepère le user par son identifiant avec les roles
        //2 user et le password hashé
        //3A tu compares le password hashé avec une hash du password tapé
        //    ex: if(mot de pass badd = sha1(mot dep asse tapé))
        //3B passwordverify(mdp en clair tapé, le mdp bdd);

        // password_hash et password_verify


        // instancie Session log, session role + les preferences / les config
        // Alimente les vars de sessions


    }

    //faire une logout -> session_destroy()

}