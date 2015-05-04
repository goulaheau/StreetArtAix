<?php require "require.php";
head("Inscription");
require "menu.php";

$alert = null;
if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['pseudo']) && isset($_POST['cemail']) && isset($_POST['cpassword'])) {
    $pseudo = $_POST['pseudo'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cemail = $_POST['cemail'];
    $cpassword = $_POST['cpassword'];

    $utilisateur = new Utilisateur($email, $pseudo, $password);

    if (!$utilisateur->setEmail($email)) {
        $alert = 'Le mail n\'est pas conforme.';
    } elseif (!$utilisateur->setPseudo($pseudo)) {
        $alert = 'Le pseudo n\'est pas conforme.';
    } elseif (!$utilisateur->setPassword($password)) {
        $alert = 'Le mot de passe n\'est pas conforme.';
    } elseif ($email != $cemail) {
        $alert = 'Les mails ne correspondent pas.';
    } elseif ($password != $cpassword) {
        $alert = 'Les mots de passes ne correspondent pas.';
    } elseif (Utilisateur::_exist($email) || Utilisateur::_exist($pseudo)) {
        $alert = 'Cet email ou ce pseudo est déjà utilisé.';
    } elseif (!$utilisateur->insert()) {
        $alert = 'Problème Insert';
    } else {
        header('Location: index.php');
    }
}
?>
    <div class="container">
        <div class="section">
            <div class="row">
                <h2 class="header">Création de compte</h2>

                <form class="col s12" action="" method="post">
                    <?php echo '<h4>' . $alert . '</h4>' ?>
                    <div class="row">
                        <div class="input-field col s12">
                            <input name="pseudo" type="text" class="validate">
                            <label for="pseudo">Pseudo</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <input name="password" type="password" class="validate">
                            <label for="password">Mot de Passe</label>
                        </div>
                        <div class="input-field col s6">
                            <input name="cpassword" type="password" class="validate">
                            <label for="cpassword">Confirmation du Mot de Passe</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <input name="email" type="email" class="validate">
                            <label for="email">Email</label>
                        </div>
                        <div class="input-field col s6">
                            <input name="cemail" type="email" class="validate">
                            <label for="cemail">Confirmation de l'Email</label>
                        </div>
                    </div>
                    <button class="btn waves-effect waves-light btn-large" type="submit" name="send">Inscription
                    </button>
                </form>
            </div>
        </div>
    </div>
<?php require "footer.php"; ?>