<?php require "require.php"; head( "Nouvel évènement"); require "menu.php";
$u = isset($_SESSION['id'])? new Utilisateur($_SESSION['id']):new Utilisateur();
if(!$u->isAdmin()) header("Location: index.php");

$alert = null;

if (isset($_POST['titre']) && isset($_POST['lieu']) && isset($_POST['date']) && isset($_POST['description'])) 
{
    $date = $_POST['date'];
    $datesql = date("Y-m-d", strtotime($date)); 
    $titre = $_POST['titre'];
    $lieu = $_POST['lieu'];
    $description = $_POST['description'];
    $uid = $u->getUid();
    
    $e = new Evenement($titre, $date, $datesql, $lieu, $description, $uid);

    if (!$e->setTitre($titre))
    {
        $alert = 'Le titre n\'est pas conforme.';
    }
    elseif (!$e->setLieu($lieu))
    {
        $alert = 'Le lieu n\'est pas conforme.';
    }
    elseif (!$e->setDate($date)) 
    {
        $alert = 'La date n\'est pas conforme.';
    }
    elseif (!$e->setDatesql($datesql)) 
    {
        $alert = 'La date n\'est pas conforme.';
    }
    elseif (!$e->setDescription($description)) 
    {
        $alert = 'La description n\'est pas conforme.';
    }
    elseif (Evenement::_exist($titre)) {
        $alert = 'Ce titre est déjà utilisé.';
    }
    elseif (!$e->insert()) {$alert = 'Problème Insert';}
    else 
    {
        header('Location: index.php');
    }
}
?>
<div class="container">
    <div class="section">
        <div class="row">
            <h2 class="header">Créer un nouvel évènement</h2>
            <form class="col s12" action="" method="POST">
                <?php echo '<h4>'.$alert.'</h4>' ?>
                <div class="row">
                    <div class="input-field col s6">
                        <input name="titre" type="text" class="validate">
                        <label for="titre">Titre</label>
                    </div>
                    <div class="input-field col s4">
                        <input name="lieu" type="text" class="validate">
                        <label for="lieu">Lieu</label>
                    </div>
                    <div class="input-field col s2">
                        <input name="date" type="date" class="datepicker">
                        <label for="date">Date</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <textarea name="description" class="materialize-textarea"></textarea>
                        <label for="description">Description</label>
                    </div>
                </div>
                <button class="btn waves-effect waves-light btn-large" type="submit" name="send">Créer l'évènement
                </button>
            </form>
        </div>
    </div>
</div>
<?php require "footer.php"; ?>