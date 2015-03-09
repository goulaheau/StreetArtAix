<?php
function isConnected()
{
    if (!isset($_SESSION['id'])) {
        return false;
    }
    return true;
}

function isAdmin(){
    if(!isConnected()) return false;
    $u = new Utilisateur($_SESSION['id']);
    return $u->isAdmin();
}

function verifMail($mail)
{
    if (!preg_match("#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,4}$#", $mail)){
        return false;
    }
    return true;
}

function verifInt($int)
{
    if(!preg_match("#^[0-9]{1,1000}$#", $int)){
        return false;
    }
    return true;
}

function verifName($name)
{
    if (!preg_match("#^[\w\.\#\-\s]{5,}$#", $name)) 
    {
        return false;
    }
    return true;
}

function head($title)
{
    echo '
        <!DOCTYPE HTML>
        <html lang="fr">
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
            <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
            <title>'.$title.'</title>
            <!-- CSS -->
            <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
            <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
        </head>
    ';
}

function switchMenu()
{
    $u = isset($_SESSION['id'])? new Utilisateur($_SESSION['id']):new Utilisateur();
    if (isConnected()) {
        echo '
            <li><a class="dropdown-button" href="#" data-activates="dropdown_compte">Compte<i class="mdi-navigation-arrow-drop-down right"></i></a>
            </li>
        ';
    }else{
        echo '
            <li><a href="connexion.php">Connexion</a>
            </li>
        ';
    }
}

function affichageCreationEvenement()
{
    if (isAdmin()) {
        echo '
            <li><a href="creation_evenement.php">Créer un évènement</a>
            </li>
        ';
    }
}
