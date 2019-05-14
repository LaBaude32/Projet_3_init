<?php
class BackendManager extends BddManager
	{
		public function findDrafts()
	{
		$PostManager = new PostManager();
		$drafts = $PostManager->findAll();
		foreach ($drafts as $draft) {
			if ($draft->getIsDraft() == 1 ){
				$toReturn[] = $draft;
			}
		}
		return array_reverse($toReturn);
	}

	// pour afficher les commentaires à valider dans le back end

	// A faire => faire un fusion de table pour recuperer : le titre du chapitre
	public function returnCommentsToValidate()
	{
		$CommentsManager = new CommentsManager();
		$comments = $CommentsManager->findAll();

		foreach ($comments as $comment) {
			if ($comment->getReport() == 0 ){
				$toReturn[] = $comment;
			}
		}
		return array_reverse($toReturn); //pour les mettre dans l'ordre décroissant
	}
}