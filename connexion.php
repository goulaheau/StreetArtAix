<?php require "require.php";
head("Connexion");
require "menu.php";
$alert = $email = null;
if (isset($_POST['pseudo']) && isset($_POST['password'])) {
    $pseudo = $_POST['pseudo'];
    $password = $_POST['password'];
    if (!Utilisateur::_exist($pseudo)) {
        $alert = 'Le compte n\'existe pas.';
    } else {
        $u = new Utilisateur($pseudo);
        if (!$u->checkPassword($password)) {
            $alert = "Le mot de passe et le nom d'utilisateur ne correspondent pas.";
        } else {
            $_SESSION['id'] = $u->getUid();
            $alert = "Vous êtes connecté.";
            header('Location: index.php');
        }
    }
}
?>
    <div class="container">
        <div class="section">
            <div class="row">
                <h2 class="header">Connexion ou Création de compte</h2>

                <div class="col s6">
                    <h4>Utilisateur déjà inscrit<?php echo $alert; ?></h4>

                    <p>Connectez-vous en utilisant vos identifiants.</p>

                    <div class="row">
                        <form class="col s12" action="" method="POST">
                            <div class="row">
                                <div class="input-field col s12">
                                    <input type="text" class="validate" name="pseudo" value="">
                                    <label for="pseudo">Pseudo</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input type="password" class="validate" name="password" value="">
                                    <label for="password">Mot de passe</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col left">
                                    <button class="btn waves-effect waves-light btn" type="submit" name="send">Connexion
                                    </button>
                                </div>
                                <div class="input-field col right">
                                    <a class="waves-effect waves-light btn">Mot de passe oublié</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col s6">
                    <h4>Nouvel utilisateur</h4>

                    <p>En vous inscrivant sur le site vous pourrez ajouter de nouvelles photos ainsi que de nouveaux
                        évènements.</p>
                    <a class="waves-effect waves-light btn" href="inscription.php">Inscription</a>
                </div>
            </div>
        </div>
    </div>

<?php require "footer.php"; ?>