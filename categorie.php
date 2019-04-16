<?php
// Récupération du nom de la catégorie dans l'URL.
$nom_categorie = (isset($_GET['nom_categorie'])) ? $_GET['nom_categorie'] : '';
?>

<?php
//Inclusion du header sur la page.
require_once(__DIR__ . '/partials/header.php');

//recuperation de l'id de l'article dans l'url
$id_categorie = (isset($_GET['id_categorie'])) ? $_GET['id_categorie'] : 0;

// Je récupére les articles de la catégorie
$articles = getArticlesByCategorieId($id_categorie);
?>

<div class="p-3 mx-auto text-center bg-warning">
    <h1 class="display-4"><?php echo $_GET['nom_categorie']; ?></h1>
</div>

<div class="mt-0 py-2 bg-warning">
    <div class="container">
        <div class="row">
            <?php foreach ($articles as $article) { ?>
                <div class="col-md-5 mt-4 mx-auto">
                    <div class="card shadow-sm p-1">
                        <img src="assets/img/articles/<?= $article['image']?>" class="card-img-top" alt="<?= $article['titre'] ?>">
                        <div class="card-body">
                            <h5 class="card-title">
                                <?= $article['titre'] ?>
                            </h5>
                            <p class="card-text">
                                <?= summarize($article['contenu'])?>
                            </p>
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="articles.php?id_article=<?= $article['id']?>" class="btn btn-primary">
                                    Lire la suite
                                </a>
                                <small class="text-muted">
                                    <?=$article['prenom']. ' ' . $article['nom']?>
                                </small>
                            </div><!--d-flex-->
                        </div>
                    </div>
                </div><!--Fin du col md-->
            <?php } ?>
        </div>
    </div><!--Fin Div Container-->
</div>

<?php
//Inclusion du footer sur la page.
require_once(__DIR__ . '/partials/footer.php');
?>

