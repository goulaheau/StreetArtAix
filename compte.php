<?php require "require.php"; head( "Street Art in Aix"); require "menu.php"; 
$u = isset($_SESSION['id'])? new Utilisateur($_SESSION['id']):new Utilisateur();
?>
<div class="container">
    <div class="section">
        <div class="row">
            <h2 class="header">Compte de <?php echo $u->getPseudo();?></h2>

            <a class="waves-effect waves-light btn right" href="deconnexion.php">Déconnexion</a>
        </div>
    </div>
</div>

<?php require "footer.php"; ?>