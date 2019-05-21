<?php
class BackendManager extends BddManager
	{
	// pour afficher les commentaires à valider dans le back end

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