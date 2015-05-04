<?php
require "require.php";
head("Envoyer une image");
require "menu.php";

if (!isset($_SESSION['id'])) {
    header("Location: index.php");
}
$u = isset($_SESSION['id']) ? new Utilisateur($_SESSION['id']) : new Utilisateur();

if (isset($_POST['nom']) && isset($_POST['description']) && isset($_FILES['image']['tmp_name'] )) {
    //Vérification du poids de l'image.
    if ($_FILES['image']['size'] > 10*MB) {
        $alert = "Le fichier dépasse 10 Mo.";
    }

    // Vérification de l'extension de l'image.
    $extensions_valides = array('jpg', 'jpeg', 'png');
    $extension_upload = strtolower(substr(strrchr($_FILES['image']['name'], '.') ,1));
    if (!in_array($extension_upload, $extensions_valides)) {
        $alert = "Extension incorrecte";
    }

    // Vérification de la taille de l'image.
    $image_sizes = getimagesize($_FILES['image']['tmp_name']);
    if ($image_sizes[0] < 140 OR $image_sizes[1] < 140) {
        $alert = "Image trop petite";
    }

    // Vérification infos avant d'insérer dans la DB.
    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $uid = $u->getUid();

    $image = new Image($nom, $description, $uid, $extension_upload);

    if (!$image->setNom($nom)) {
        $alert = 'Le nom n\'est pas conforme.';
        $image->delete($image->getIid());
    } elseif (!$image->setUid($uid)) {
        $alert = 'L\'ID de l\'utilisateur n\'est pas conforme.';
        $image->delete($image->getIid());
    } elseif (!$image->setDescription($description)) {
        $alert = 'La description n\'est pas conforme.';
        $image->delete($image->getIid());
    } elseif (!$image->setExtension($extension_upload)) {
        $alert = 'L\'extension n\'est pas valide.';
        $image->delete($image->getIid());
    } elseif (!$image->insert()) {
        $alert = 'Problème Insert';
        $image->delete($image->getIid());
    } else {

        // Upload du fichier dans le dossier d'attente.
        $fichier = 'img/large/'.$image->getIid().'.'.$extension_upload;
        $resultat = move_uploaded_file($_FILES['image']['tmp_name'], $fichier);
        if ($resultat) {

            // Création du Thumbnail.
            $dest = 'img/thumb/'.$image->getIid().'.'.$extension_upload;
            $desired_width = '238';
            make_thumb($fichier, $dest, $desired_width);
            header('Location: index.php');
        } else {
            $alert = 'Problème d\'upload.';
            $image->delete($image->getIid());
        }
    }
}
?>
<div class="container">
    <div class="section">
        <div class="row">
            <h2 class="header">Importation d'images</h2>
            <p><?php echo $alert;?></p>

            <form class="col s12" action="" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="input-field">
                        <input name="nom" type="text" class="validate">
                        <label for="nom">Nom</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <textarea name="description" class="materialize-textarea"></textarea>
                        <label for="description">Description</label>
                    </div>
                </div>
                <div class="row">
                    <div class="file-field input-field">
                        <input class="file-path validate" type="text" value="<?php pathFichier();?>"/>
                        <div class="btn">
                            <span>File</span>
                            <input type="file" name="image"/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <button class="btn waves-effect waves-light btn" type="submit" name="send">Envoyer
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
