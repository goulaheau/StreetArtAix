<?php
function isConnected()
{
    if (!isset($_SESSION['id'])) {
        return false;
    }
    return true;
}

function isAdmin()
{
    if (!isConnected()) return false;
    $utilisateur = new Utilisateur($_SESSION['id']);
    return $utilisateur->isAdmin();
}

function verifMail($mail)
{
    if (!preg_match("#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,4}$#", $mail)) {
        return false;
    }
    return true;
}

function verifInt($int)
{
    if (!preg_match("#^[0-9]{1,1000}$#", $int)) {
        return false;
    }
    return true;
}

function verifName($name)
{
    if (!preg_match("#^[\w\.\#\-\s]{5,}$#", $name)) {
        return false;
    }
    return true;
}

function head($title)
{
    echo '  <!DOCTYPE HTML>
            <html lang="fr">
            <head>
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
                <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
                <title>' . $title . '</title>
                <!-- CSS -->
                <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
                <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
            </head>';
}

function cssPortfolio()
{
    echo '  <link rel="stylesheet" type="text/css" href="css/demo.css" />
		    <link rel="stylesheet" type="text/css" href="css/component.css" />
		    <script src="js/modernizr.custom.js"></script>';
}

function switchMenu()
{
    $utilisateur = isset($_SESSION['id']) ? new Utilisateur($_SESSION['id']) : new Utilisateur();
    if (isConnected()) {
        echo '<li><a class="dropdown-button" href="#" data-activates="dropdown_compte">' . $utilisateur->getPseudo() . '<i class="mdi-navigation-arrow-drop-down right"></i></a>
              </li>';
    } else {
        echo '<li><a href="connexion.php">Connexion</a>
              </li>';
    }
}

function affichageCreationEvenement()
{
    if (isAdmin()) {
        echo '<li><a href="creation_evenement.php">Créer un évènement</a>
              </li>';
    }
}

function disabled()
{
    if (!isConnected()) {
        echo 'disabled = "disabled"';
    }
}

function commenter()
{
    echo '<div class="card-content">
              <div class="section col s12">
                  <h4>Ecrire un commentaire</h4>';
    if (isConnected()) {
        echo '<form action="" method="POST">
                  <div class="input-field col s12">
                      <i class="mdi-editor-mode-edit prefix"></i>
                      <textarea name="contenu" class="materialize-textarea"></textarea>
                      <label for="contenu">Message</label>
                      <p>
                          <?php echo $alert ?>
                          <button class="btn waves-effect waves-light right" type="submit" name="send">
                              Publier
                          </button>
                      </p>
                  </div>
              </form>';
    } else {
        echo '<p>
                  <a href="connexion.php">
                      <button class="btn waves-effect waves-light btn">
                          Connectez-vous
                      </button>
                  </a>
                  pour pouvoir commenter cet évènement.
              </p>';
    }
    echo '
            </div>
        </div>';
}

function pathFichier()
{
    if (isset($_FILES['image'])) {
        echo $_FILES['image']['tmp_name'];
    } elseif (! isset($_FILES['image']) || $_FILES['image']['size'] == 0) {
        echo 'Cliquez sur le bouton.';
    }
}

function getImagesATraiter()
{
    // On récupère toutes les images non traitées dans un tableau.
    $r = array();
    $req = "SELECT *
            FROM image
            WHERE affichage = 0";
    foreach (Database::_query($req) as $a) {
        $r[] = $a;
    }

    // On crée pour chaque image une ligne dans le tableau.
    foreach ($r as $index => $value) {
        $utilisateur = new Utilisateur($value['uid']);
        echo '<tr>
                  <td><img class="materialboxed" data-caption="'.$value['nom'].'" width="250" src="images/attente/'.$value['iid'].'.'.$value['extension'].'"></td>
                  <td>'.$utilisateur->getPseudo().'</td>
                  <td>
                      <input type="checkbox" id="image-'.$value['iid'].'" />
                      <label for="indeterminate-checkbox">Indeterminate Style</label>
                      <i class="mdi-action-delete right"></i>
                  </td>
              </tr>';
    }
}

function getImagesAAfficher()
{
    // On récupère toutes les images non traitées dans un tableau.
    $r = array();
    $req = "SELECT *
            FROM image
            WHERE affichage = 1";
    foreach (Database::_query($req) as $a) {
        $r[] = $a;
    }

    // On crée pour chaque image une "case".
    foreach ($r as $index => $value) {
        echo '<li>
                  <figure>
                      <img src="img/thumb/' . $value['iid'] . '.' . $value['extension'] . '" alt="img' . $value['iid'] . '"/>
                      <figcaption><h3>' . $value['nom'] . '</h3><p>' . $value['description'] . '</p></figcaption>
                  </figure>
              </li>';
    }
}

function getSlidersAAfficher()
{
    // On récupère toutes les images non traitées dans un tableau.
    $r = array();
    $req = "SELECT *
            FROM image
            WHERE affichage = 1";
    foreach (Database::_query($req) as $a) {
        $r[] = $a;
    }

    // On crée pour chaque image un Slider.
    foreach ($r as $index => $value) {
        echo '<li>
                  <figure>
                      <figcaption>
                          <h3>' . $value['nom'] . '</h3>
                          <p>' . $value['description'] . '</p>
                      </figcaption>
                      <img src="img/large/' . $value['iid'] . '.' . $value['extension'] . '" alt="img' . $value['iid'] . '"/>
                  </figure>
              </li>';
    }
}

function make_thumb($src, $dest, $desired_width)
{
    /* read the source image */
    $source_image = imagecreatefromjpeg($src);
    $width = imagesx($source_image);
    $height = imagesy($source_image);

    /* find the "desired height" of this thumbnail, relative to the desired width  */
    $desired_height = floor($height * ($desired_width / $width));

    /* create a new, "virtual" image */
    $virtual_image = imagecreatetruecolor($desired_width, $desired_height);

    /* copy source image at a resized size */
    imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);

    /* create the physical thumbnail image to its destination */
    imagejpeg($virtual_image, $dest);
}