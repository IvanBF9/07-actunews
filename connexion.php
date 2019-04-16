<?php
// Récupération du nom de la catégorie dans l'URL.
$nom_categorie = (isset($_GET['nom_categorie'])) ? $_GET['nom_categorie'] : '';
?>

<?php
//Inclusion du header sur la page.
require_once(__DIR__ . '/partials/header.php');

$email = null;
$password = null;
if (!empty($_POST)) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $errors = [];


    if (empty($email)) {
        $errors['email'] = "Merci de de saisir votre email.";
    }

    if (empty($password)) {
        $errors['password'] = "Merci de saisir votre Mot de passe";
    }

    if (empty($errors)) {
        //-- Début du processus de connexion.

        if (connexion($email, $password)){

        redirection('.');

        }else{

            $errors['email'] = 'email ou mot de passe incorect';
        }

    }

}

?>

<div class="p-3 mx-auto text-center">
    <h1 class="display-4">Connexion</h1>
</div>
<!--FORMULAIRE DE CONNEXION-->
<div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto">

            <?php if(isset($_GET['inscription'])){?>
            <div class="alert alert-success">
                Félicitation, vous pouvez maintenant vous connecter.
            </div>
            <?php } ?>

            <form method="post" class="form-horizontal">
                <!--EMAIL-->
                <div class="form-group">
                    <input name="email" type="email" value="<?= $email ?? $_GET['email'] ?? '' ?>"
                           class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>" placeholder="Email">
                    <div class="invalid-feedback">
                        <?= isset($errors['email']) ? $errors['email'] : '' ?>
                    </div>
                </div>
                <!--PASSWORD-->
                <div class="form-group">
                    <input name="password" type="password"
                           class="form-control <?= isset($errors['password']) ? 'is-invalid' : '' ?>"
                           placeholder="Mot de passe">
                    <div class="invalid-feedback">
                        <?= isset($errors['password']) ? $errors['password'] : '' ?>
                    </div>
                </div>
                <!--SUBMIT-->
                <button class="btn btn-block btn-secondary">
                    Connexion
                </button>
            </form>
        </div>
    </div>
</div>


<?php
//Inclusion du footer sur la page.
require_once(__DIR__ . '/partials/footer.php');
?>

