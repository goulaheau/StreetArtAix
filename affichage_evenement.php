<?php
require "require.php";
head("Evènements");
require "menu.php";

$alert = $id = null;

$evenement = new Evenement($_GET['id']);
$eid = $evenement->getEid();


// Vérification du POST message.
if (isset($_POST['contenu']) && isset($_SESSION['id'])) {
    $contenu = $_POST['contenu'];
    $uid = $_SESSION['id'];

    $commentaire = new Commentaire($eid, $uid, $contenu);

    if (!$commentaire->setEid($eid)) {
        $alert = "Le sujet n'a pas d'id";
    } elseif (!$commentaire->setUid($uid)) {
        $alert = "La session n'a pas été activé";
    } elseif (!$commentaire->setContenu($contenu)) {
        $alert = "Le message est vide";
    } elseif (!$commentaire->insert()) {
        $alert = "Il y a eu un problème à l'insertion !";
    } else {
        $alert = "Votre message a été publié.";
        header("Location: " . $_SERVER['REQUEST_URI']);
    }
}

?>
    <div class="container">
        <div class="section">
            <div class="row">
                <div class="section col s12">
                    <div class="card large">
                        <div class="card-image">
                            <img src="media/background1.jpg"></a>
                        <span class="card-title center"
                              id="titreEvenement"><?php echo $evenement->getTitre(); ?></span>
                        </div>
                        <div class="card-content">
                            <div class="section col s3 center-align">
                                Date : <?php echo $evenement->getDate(); ?>
                            </div>
                            <div class="section col s3 center-align">
                                Lieu : <?php echo $evenement->getLieu(); ?>
                            </div>
                            <div class="section col s3 center-align">
                                Participants : <?php echo $evenement->_nombreParticipants($eid); ?>
                            </div>
                            <div class="section col s3 center-align">
                                <form>
                                    <input <?php disabled(); ?>type="checkbox" name="participer"
                                           onclick="request(readData);" id="participer"
                                           value="<?php echo $eid; ?>" <?php $utilisateur->_checkOrUncheck($eid) ?>/>
                                    <label for="participer">Je participe</label>
                                </form>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="section col s12">
                                <h4>Description</h4>

                                <p class="">
                                    <?php echo $evenement->getDescription(); ?>
                                </p>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="section col s12">
                                <h4>Commentaires</h4>

                                <div class="row">
                                    <ul class="collection">
                                        <?php Commentaire::_getAllCommentaire($eid); ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <?php commenter(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php require "footer.php";
