<?php
/*
 * Nous pouvons définir ici toutes les fonctions utiles
 * à notre projet et utilisable sur toutes les pages
 */
//Démarrage de la session php.
session_start();

function redirection($page){
    header('location: ' .$page);
}

/*
 * Permet de verifier si un auteur est connecté en session.
 */
function isOnline(){
    return isset($_SESSION['auteur']) ? $_SESSION['auteur'] : false;
}

/*
 * perme de générer un accrohe
 */

function summarize($text){
    // Suppression des balises HTML
    $string = strip_tags($text);//strip tags est une fonction par defaut qui enleve les balises.

    if (strlen($string) > 150){

        //je coupe ma chaine a 150.
        $stringCut = substr($string, 0, 150);

        //je coupe des q'uil y a un espace apres 150 caractères.
        $string = substr($stringCut, 0, strrpos($stringCut, ' '));

    }

    return $string. '...';
}
/**
 * Permet de générer un slug
 * à partir d'un string.
 */
function slugify($text)
{
    // replace non letter or digits by -
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);

    // transliterate
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

    // remove unwanted characters
    $text = preg_replace('~[^-\w]+~', '', $text);

    // trim
    $text = trim($text, '-');

    // remove duplicate -
    $text = preg_replace('~-+~', '-', $text);

    // lowercase
    $text = strtolower($text);

    if (empty($text)) {
        return 'n-a';
    }

    return $text;
}
