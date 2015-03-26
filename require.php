<?php
// On inclut toutes les classes.
require_once './class/Utilisateur.class.php';
require_once './class/Evenement.class.php';
require_once './class/Commentaire.class.php';
require_once './class/Database.class.php';

// On inclut le fichier contenant les fonctions globales.
require_once 'function.php';

session_start();
$db = mysqli_connect("127.0.0.1", "root", "", "streetartaix");
if (mysqli_connect_errno($db)) {
    var_dump("Echec lors de la connexion à MySQL : " . mysqli_connect_error());
    die();
}

// Définit les variables pour la connexion à la DB.
define('DBHOST', 'localhost');
define('DBNAME', 'streetartaix');
define('DBUSER', 'root');
define('DBPASSWORD', '');

// Initialisation de la DB.
Database::_init();
if (!is_null(Database::_lastError())) {
    if (isset($_messages)) {
        add_error($_messages, Database::_lastError()->getMessage());
    }
}

// Initialisation des variables globales.
global $utilisateur;
global $alert;
$utilisateur = isset($_SESSION['id']) ? new Utilisateur($_SESSION['id']) : new Utilisateur();
$alert = null;