
<?php
//Inclusion du header sur la page.
require_once(__DIR__ . '/partials/header.php');

//Si mon paramètre id_article n'existe pas dans la route. J'affecte la valeur 0. Ainsi, ma requète ne retournera aucun résultat.
//id_article = (isset($_GET['id_article'])) ? $_GET['id_artice'] : 0;
//$articles = getArticlesById($id_article);




$article = getArticlesById($_GET['id_article'] ?? 0);


?>

<div class="p-3 mx-auto text-center bg-warning">
    <h1 class="display-4">Articles</h1>
</div>

<div class="mt-0 py-2 bg-warning">
    <div class="container col-10">
        <div class="row">
            <div class="col-md-10 mt-4 mx-auto">
                <div class="text-center">
                <h1><?= $article['titre'] ?></h1>
                </div>
                <div class="col-12 mx-auto mt-4">
                    <img src="assets/img/articles/<?= $article['image']?>" class="img-fluid" alt="<?= $article['titre'] ?>">
                </div>
              <div class="mb-4 mt-4 col-12">
                  <h4 class="articlesp"><?= $article['contenu']?></h4>
              </div>
                <div class="col-12 text-muted">
                    <p><?=$article['prenom']. ' ' . $article['nom']?></p>
                </div>
            </div><!--Fin du col md-->
        </div>
    </div><!--Fin Div Container-->
</div>

<?php
//Inclusion du footer sur la page.
require_once(__DIR__ . '/partials/footer.php');
?>

