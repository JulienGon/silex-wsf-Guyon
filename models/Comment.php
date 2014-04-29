<?php

use Blog\Model; 

class Comment extends Model
{
	public function saveComment($idArticle, $comment) //on demande aussi le contenu du commentaire avec le $comment
	{
		$sql = 'INSERT INTO comments 
			id=NULL,
			content = :comment
			'; //premiere requete sql qui met le comm dansl a table de commentaire

        $arguments = array(
            ':comment' => $comment
        );

        $this->app['sql']->prepareExec($sql, $arguments)->fetchAll();  //On lance la requete
		
		$query = 'INSERT INTO comments_articles 
			id = NULL, 
			id_comment = :commentId,
			id_article = :idArticle 
		';

			$argument = array(
					':commentId' => $this->app['sql']->lastId(),
					':idArticle' => $idArticle
			);

			$this->app['sql']->prepareExec($query, $argument)->fetchAll();
	}

}