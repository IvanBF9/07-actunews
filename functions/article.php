<?php
/*
 * CONSIGNE: Créer 3 fonctions :
 *
 * 1. getArticles() : Permet de retourner tous les articles de la base.
 * 2. getArticlesById() : Permet de récupérer un article grace a son ID.
 * 3. getArticlesByCategorieId() : Permet de recuperer les articlesd'une
 * categorie,grâce a son ID.
 */


function getArticles()
{
    global $db;//récupération du $db depuis l'espace global.
    $query = $db->query('
    SELECT article.id, titre, contenu, image, prenom, nom FROM article, auteur 
    WHERE article.auteur_id = auteur.id 
    ORDER BY article.id DESC');
    return $query->fetchAll();// On retourne les catéfories de la BDD.
}

function getArticlesById($article_id){
    global $db;
    $sql = 'SELECT * FROM article ,auteur WHERE article.id = :id AND article.auteur_id = auteur.id';
    $query = $db->prepare($sql);
    $query->bindValue(':id', $article_id);
    $query->execute();

    return $query->fetch();
}
/*
 * Retourne les articles appartenant a l'IDde la
 * catégorie passée en paramétre.
 */
function getArticlesByCategorieId($categorie_id){

    global $db;

    $sql = 'SELECT article.id, titre, contenu, image, prenom, nom  FROM article,auteur WHERE article.auteur_id = auteur.id AND article.categorie_id = :id';
    $query = $db->prepare($sql);
    $query->bindValue(':id', $categorie_id);
    $query->execute();

    return $query->fetchAll();

}
//9874984498498489489498498498498498498498498498dsfndhusfbdysgfstyfgdsyfgdsyfgdsyfugdsyhufbdshufbdsufbhdsfuh
function getArticlesByAuteurId($auteur_id){

    global $db;

    $sql = 'SELECT article.id, titre, contenu, image, prenom, nom FROM article,auteur WHERE article.auteur_id = auteur.id AND article.auteur_id = :id';
    $query = $db->prepare($sql);
    $query->bindValue(':id', $auteur_id);
    $query->execute();

    return $query->fetchAll();

}

function addArticle($auteur_id, $categorie_id, $titre, $contenu, $image){
    global $db;

    $query = $db->prepare('INSERT INTO article (`titre`, `contenu`, `image`, `categorie_id` ,`auteur_id`)
    VALUES (:titre, :contenu, :image, :categorie_id, :auteur_id)');

    $query->bindValue(':titre', $titre, PDO::PARAM_STR);
    $query->bindValue(':contenu',$contenu, PDO::PARAM_STR);
    $query->bindValue(':image', $image, PDO::PARAM_STR);
    $query->bindValue(':categorie_id', $categorie_id, PDO::PARAM_INT);
    $query->bindValue(':auteur_id', $auteur_id, PDO::PARAM_INT);

/*
 * Si mon article à bien été inséré dans la BDD. Alors je retourne l'ID de l'article. sinnon je retourne faux..
 */
    return $query->execute() ? $db->lastInsertId() : false;
}

?>

