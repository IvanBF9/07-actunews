<?php
//Inclusion du header sur la page.
require_once(__DIR__ . '/partials/header.php');

$articles = getArticles();
?>

<div class="topaccueil bg-warning">
    <h1>EsportNews</h1>
    <br>
</div>
<!--Ici, viendra le contenu de ma page-->
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

