<?php require "require.php";
head("Street Art in Aix");
require "menu.php";
$u = isset($_SESSION['id']) ? new Utilisateur($_SESSION['id']) : new Utilisateur();
?>
    <div class="container">
        <div class="section">
            <div class="row">
            <h2 class="header">Compte de <?php echo $u->getPseudo(); ?></h2>

            </div>
            <div class="row">
                <h2>Gestion des images</h2>

                <table class="centered">
                    <thead>
                    <tr>
                        <th data-field="image">Images</th>
                        <th data-field="pseudo">Pseudo du posteur</th>
                        <th data-field="affichage">Affichage de l'image</th>
                    </tr>
                    </thead>

                    <tbody>
                        <?php getImagesATraiter(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<?php require "footer.php"; ?>