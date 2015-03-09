<?php
session_start();
$db = mysqli_connect("127.0.0.1", "root", "", "streetartaix");
if (mysqli_connect_errno($db)) {
    var_dump("Echec lors de la connexion à MySQL : " . mysqli_connect_error());
    die();
}
require './class/Utilisateur.class.php';
require './class/Evenement.class.php';
require 'function.php';

$alert = null;