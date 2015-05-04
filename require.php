<?php
// On inclut toutes les classes.
require_once './class/Utilisateur.class.php';
require_once './class/Evenement.class.php';
require_once './class/Commentaire.class.php';
require_once './class/Database.class.php';
require_once './class/Image.class.php';

// On inclut le fichier contenant les fonctions globales.
require_once 'function.php';

session_start();

// Définit les variables pour la connexion à la DB.
define('DBHOST', 'localhost');
define('DBNAME', 'streetartaix');
define('DBUSER', 'root');
define('DBPASSWORD', '');

// Définit les variables pour la taille d'un fichier.
define('KB', 1024);
define('MB', 1048576);
define('GB', 1073741824);
define('TB', 1099511627776);

// Initialisation de la DB.
Database::_init();
if (!is_null(Database::_lastError())) {
    if (isset($_messages)) {
        add_error($_messages, Database::_lastError()->getMessage());
    }
}

// Initialisation des variables globales.
$utilisateur = isset($_SESSION['id']) ? new Utilisateur($_SESSION['id']) : new Utilisateur();
$alert = null;