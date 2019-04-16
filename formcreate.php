<?php
//Inclusion du header sur la page.
require_once(__DIR__ . '/partials/header.php');

if (!$auteur){
    redirection('connexion.php');
}

$auteur_id = $auteur['id'];

$titre = null;
$contenu = null;
$image = null;
$categorie_id = null;

if (!empty($_POST)) {

    $titre        = $_POST['titre'];
    $contenu      = $_POST['contenu'];
    $image        = $_FILES['image']; //!\\ je récupère un fichier avec la superglobale $_FILES.
    $categorie_id = $_POST['categorie_id'];

    //Traitement de l'upload.
    var_dump($image);

    //récupération des donées de l'image
    $fileTmp = $image['tmp_name']; //Emplacement temporaire de l'image sur le serveur.

    $extension = pathinfo($image['name'])['extension'];//récupérér l'extension de l'image.

    $fileName = slugify($titre) . '.' . $extension;//Je donne un nom a mon image.

    $destination = __DIR__ . '/assets/img/articles/' . $fileName;//je définie la destination de mon image .

    move_uploaded_file($fileTmp, $destination);//pour finir je déplace mon image du dossier temporaire vers mon dossier projet.

    $image = $fileName;// j'envoie dans ma bdd le nom de l'image /!\

    var_dump($fileName);
    $errors = [];

    if (!empty($titre) && strlen($titre) < 20) {
        $errors['titre'] = "Le titre est trop court.";
    }

    if (!empty($titre) && strlen($titre) > 150){
        $errors['titre'] = "Votre titre ne peut pas dépasser les 150 caractères";
    }

    if (!empty($contenu) && strlen($contenu) < 200) {
        $errors['contenu'] = "Le contenu est trop court.";
    }

    //empty
    if (empty($titre)){
        $errors['titre'] = 'Merci de saisir un titre';
    }

    if (empty($contenu)){
        $errors['contenu'] = 'Merci de saisir du contenu';
    }



    if (empty($errors)){
        $idArticle = addArticle($auteur_id, $categorie_id, $titre, $contenu, $image);//function qui est dans article.php
        if($idArticle){
            //si $idArticle ne retourne pas false alors je redirige l'utilisateur sur l'article
            redirection('articles.php?id_article=' . $idArticle);
        }
    }

}


?>


<div class="p-3 mx-auto text-center bg-warning">
    <h1 class="display-4">Creation d'Articles</h1>
</div>

<div class="container col-12 mt-0 py-2 bg-warning">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <?php if(!empty($errors)){?>
            <div class="alert alert-danger col-12 mx-auto">
                <strong>Attention, vous devez vérifier vos champs.</strong><br>
                <?php foreach ($errors as $error) {?>
                <?= $error ?><br>
                <?php }?>
            </div>
            <?php }?>

            <form method="post" enctype="multipart/form-data"><!--Obligatoire pour les fichiers dans un formulaire-->

                <!---------- Titre de l'article ----------->
                <div class="form-group">
                    <input name="titre" type="text" value="<?=$titre?>" class="form-control"
                           placeholder="Titre de l'article">
                    <div class="invalid-feedback">
                        <?= isset($errors['titre']) ? $errors['titre'] : '' ?>
                    </div>
                </div>
                <!--------- Catégorie ------------->
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Catégorie</label>
                    <select class="form-control" name="categorie_id">
                        <?php foreach ($categories as $categorie) { ?>
                        <option value="<?= $categorie['id'] ?>">
                            <?php echo $categorie['nom'] ?>
                        </option>
                        <?php } ?>
                    </select>
                </div>

                <!---------- Contenu ----------->
                <div class="form-group">
                    <textarea name="contenu" class="form-control" placeholder="Contenu de l'article" rows="3"><?= $contenu ?></textarea>
                </div>
                <!--------- Image -------->
                <div class="form-group">
                    <input name="image" type="file" class="form-control-file">
                </div>
                <!---------- Bouton Submit ----------->

                <button type="submit" class="btn btn-block btn-dark mb-2 ">Créer</button>

            </form>
        </div> <!-- /.col-md-8 -->
    </div> <!-- /.row -->
</div> <!-- /.container -->

<?php
//Inclusion du footer sur la page.
require_once(__DIR__ . '/partials/footer.php');
?>
