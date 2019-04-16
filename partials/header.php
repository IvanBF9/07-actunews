<?php
require_once(__DIR__ . '/../functions/global.php');
//Inclusion du fichier database.
require_once(__DIR__ . '/../config/database.php');
//$categories = ['CS-GO', 'RS6', 'Fortnite'];
//RECUPERATION DES CATEGORIES DE LA BASE

require_once(__DIR__ . '/../functions/categorie.php');
require_once (__DIR__. '/../functions/article.php');
require_once(__DIR__ . '/../functions/membres.php');

$categories = getCategories();


//Si un auteur est en session, alors $auteur prendra comme valeur
//le tableau. Sinon, $auteur prendra comme valeur false.

$auteur = isOnline();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>EsportNews</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
          integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <!--Bootstrap CSS-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
<header>
    <div class="top">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark col-md-12">
            <a class="navbar-brand mx-3 esportnews" href="#">EsportNews</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02"
                    aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Accueil<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Catégories
                        </a>

                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <?php foreach ($categories as $categorie) { ?>
                                <a class="dropdown-item"
                                   href="categorie.php?nom_categorie=<?= $categorie['nom']; ?>& id_categorie=<?= $categorie['id']?>">
                                    <?php echo $categorie['nom'] ?></a>
                            <?php } //Fin du foreach sur $categories. ?>
                        </div>
                    </li>
                </ul>
                <?php if ($auteur) {?>
                    <div class="nav-item text-light mt-2 mr-3"><p>Bonjour <strong><?= $auteur['prenom'] ?></strong></p></div>
                <a href="mesarticles.php?id_auteur=<?= $auteur['id']; ?>" class="nav-item btn btn-outline-secondary text-light mx-1">Mes Articles</a>
                <a href="deconnexion.php" class="nav-item btn btn-outline-secondary text-light mx-1 mr-3">Déconnexion</a>
                    <?php }else{ ?>
                <a href="inscription.php" class="nav-item btn btn-outline-secondary text-light mx-1">inscription</a>
                <a href="connexion.php" class="nav-item btn btn-outline-secondary text-light ml-1 mr-3">connexion</a>
                <?php } ?>
                <form class="form-inline my-2 my-lg-0 recherche">
                    <input class="form-control mr-sm-2 col-sm-8" type="search" placeholder="Search">
                    <button class="btn btn-outline-secondary my-2 my-sm-0 mr-3 ml-1 text-light" type="submit"><i
                                class="fas fa-search"></i></button>
                </form>
            </div>
        </nav>
    </div>
</header>
