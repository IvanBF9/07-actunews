<?php

/*
 * Retourne les categories du site
 * depuis la base de données
 */

function getCategories()
{
    global $db;//récupération du $db depuis l'espace global.
    $query = $db->query('SELECT * FROM categorie');
    return $query->fetchAll();// On retourne les catéfories de la BDD.
}

?>
