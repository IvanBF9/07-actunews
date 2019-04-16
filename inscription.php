<?php
//Inclusion du header sur la page.
require_once(__DIR__ . '/partials/header.php');
?>
<?php

//DECLARATION DE MES VARIABLES VIDES.
$prenom = null;
$nom = null;
$email = null;
$password = null;
$cfPassword = null;
$verif = null;

$regexlettre = '/[\^<,\"@\/\{\}\(\)\*\$%\?=>:\|;#]+/i';

if (!empty($_POST)) {

    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cfPassword = $_POST['cf-password'];

    //DECLARATION DU TABLEAU D'ERREURS.
    $errors = [];

    //PRENOM.


    if (empty($prenom)) {
        $errors['prenom'] = "Merci de saisir votre prenom";
    }

    if (!empty($prenom) && strlen($prenom) < 2) {
        $errors['prenom'] = "Votre prénom est trop court";
    }

    if (preg_match($regexlettre, $prenom)) {
        $errors['prenom'] = 'Votre prénom doit contenir uniquement des lettres.';
    }


    //NOM.

    if (empty($nom)) {
        $errors['nom'] = "Merci de saisir votre nom";
    }

    if (!empty($nom) && strlen($nom) < 4) {
        $errors['nom'] = "Votre nom est trop court";
    }

    //EMAIL.

    if (empty($email)) {
        $errors['email'] = "Merci de de saisir votre email.";
    }

    if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Vérifiez le format de votre email.";
    }

    $query = $db->prepare('SELECT email FROM auteur WHERE email = :email');
    $query->execute(array(':email'=>$email));
    $donnees = $query->fetch();
    if($donnees){
        $errors['email'] = "Email déjà utilisé";
    }
    //PASSWORD.

    if (empty($password)) {
        $errors['password'] = "Merci de saisir votre Mot de passe";
    }

    if (!empty($password) && strlen($password) < 9) {
        $errors['password'] = "Votre mot de passe doit avoir au minimum 9 caractères.";
    }

    //CONFIRM PASSWORD

    if ($password !== $cfPassword) {
        $errors['password'] = 'Les mots de passe ne correspondent pas';
    }

    if (empty($errors)){
        //******************************
        //******************************
//        $query = $db->prepare('INSERT INTO membres (`prenom`, `nom`, `email`, `password`)
//        VALUES (:prenom, :nom, :email, :password)');
//
//        $query->bindValue(':prenom', $prenom, PDO::PARAM_STR);
//        $query->bindValue(':nom', $nom, PDO::PARAM_STR);
//        $query->bindValue(':email', $email, PDO::PARAM_STR);
//        $query->bindValue(':password',password_hash($password, PASSWORD_DEFAULT), PDO::PARAM_STR);

        if (empty($errors)){
            //--Je procéde a l'inscription en base.
            if (inscription($prenom, $nom, $email, $password)){
                //-- Puis redirection sur la page de connexion.
                redirection('connexion.php?inscription=success&email=' .$email);
            }
        }
    }

}


?>

<div class="p-3 mx-auto text-center">
    <h1 class="display-4">Inscription</h1>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <?= $verif ?>
            <form method="post" class="form-horizontal">
                <!--Prénom-->
                <div class="form-group">
                    <input name="prenom" type="text" value="<?= $prenom ?>"
                           class="form-control <?= isset($errors['prenom']) ? 'is-invalid' : '' ?>"
                           placeholder="Prénom">
                    <div class="invalid-feedback">
                        <?= isset($errors['prenom']) ? $errors['prenom'] : '' ?>
                    </div>
                </div>
                <!--Nom-->
                <div class="form-group">
                    <input name="nom" type="text" value="<?= $nom ?>"
                           class="form-control <?= isset($errors['nom']) ? 'is-invalid' : '' ?>" placeholder="Nom">
                    <div class="invalid-feedback">
                        <?= isset($errors['nom']) ? $errors['nom'] : '' ?>
                    </div>
                </div>
                <!--Email-->
                <div class="form-group">
                    <input name="email" type="email" value="<?= $email ?>"
                           class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>" placeholder="Email">
                    <div class="invalid-feedback">
                        <?= isset($errors['email']) ? $errors['email'] : '' ?>
                    </div>
                </div>
                <!--Password-->
                <div class="form-group">
                    <input name="password" type="password"
                           class="form-control <?= isset($errors['password']) ? 'is-invalid' : '' ?>"
                           placeholder="Mot de passe">
                    <div class="invalid-feedback">
                        <?= isset($errors['password']) ? $errors['password'] : '' ?>
                    </div>
                </div>
                <!--Confirmation Password-->
                <div class="form-group">
                    <input name="cf-password" type="password"
                           class="form-control <?= isset($errors['password']) ? 'is-invalid' : '' ?>"
                           placeholder="Confirmez le Mot de passe">
                </div>
                <!--Submit-->
                <button class="btn btn-block btn-secondary">
                    Inscription
                </button>
            </form>
        </div>
    </div><!--Fin de la div row-->
</div><!--Fin du container-->

<?php
//Inclusion du footer sur la page.
require_once(__DIR__ . '/partials/footer.php');
?>

