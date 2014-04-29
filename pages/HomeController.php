<?php

use Blog\Controller;

Class HomeController extends Controller
{

    /**
     * Affiche la home page
     */
    public function getIndex($idTag = null)
    {
        $this->data['user'] = $this->isLogged(); //sera egal a false ou true

        $article = new Article($this->app);
        $this->data['articles'] = $article->getAllArticles($idTag);

        return $this->app['twig']->render('home.twig', $this->data);
    }

    public function getArticle($idArticle)
    {
        $article = new Article($this->app);
        $this->data['article'] = $article->getArticle($idArticle);

        $tag = new Tag($this->app);
        $tags = $tag->getTagsByArticle($idArticle);


        return $this->app['twig']->render('article.twig', $this->data);
    }

    public function postComment($idArticle)
    {
            $this->data['user'] = $this->isLogged(); //True ou false encore

            if($this->isLogged()){
                //verification en back au moment du post : doit renvoyer True ! Ne peut poster/on gère la base de donnée que s'il est connecté.
                // on fait maintenant la requête d'ajout de commentaire
                if ($idArticle) {
                    $comment = new Comment($this->app); //classe commentaire à laquelle des fonctions
                    $comment = $comment->saveComment($idArticle, $this->app['request']->get('comment')); // Ici on demande le contenu d'un formulaire qui a été envoyé par l'utilisateur.
                }

            }
    }

}
