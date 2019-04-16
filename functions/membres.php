<?php
/*
 * Dans ce fichier nous allons définir quelques fonctions qui seront utiles
 * pour gérer nos auteurs (membres)
 *
 */

/*
 * prepare bind execute.
 */

/*
 * Permet l'inscription d'un membre dans la bdd .
 * Retourne true ou 1 (oui) si l'insertion a été faite correctement.
 * retourne false ou 0(non) si une erreur est survenue.
 */

function inscription($prenom, $nom, $email, $password){
    global $db;

    $query = $db->prepare('INSERT INTO auteur (`prenom`, `nom`, `email`, `password`)
        VALUES (:prenom, :nom, :email, :password)');

    $query->bindValue(':prenom', $prenom, PDO::PARAM_STR);
    $query->bindValue(':nom', $nom, PDO::PARAM_STR);
    $query->bindValue(':email', $email, PDO::PARAM_STR);
    $query->bindValue(':password',password_hash($password, PASSWORD_DEFAULT), PDO::PARAM_STR);

    return $query->execute();
}
/*
 * Permet la connexion d'un utilisateur.
 * le stockage des informations en session !
 * Retourne true si la connexion est un succès
 * Retourne false en cas d'echec de la connexion
 */
function connexion($email, $password){

    global $db;

    $sql = 'SELECT * FROM auteur WHERE email = :email';
    $query = $db->prepare($sql);
    $query->bindValue(':email', $email);
    $query->execute();

    // Récupération de l'auteur dans la base
    $auteur = $query->fetch();

    /*On vérifie si un auteur a bien été trouvé, et que dans le même temps
    *le mot de passe saisie par l'utilisateur dans le formulaire correspond
     * au mot de passe de l'auteur dans la BDD.
    */
    if ($auteur && password_verify($password, $auteur['password'])){
        //-- METTRE EN SESSION LES INFORMATIONS DE L'AUTEUR
        $_SESSION['auteur'] = $auteur; //Je stock dans ma session PHP a la clé auteur mon tableau associatif $auteur.

        return true;
    }

    return false;

}

function deconnexion(){

    unset($_SESSION['auteur']);
    return true;
}