<?php require "require.php";
head("Street Art in Aix");
require "menu.php";
header("Content-Type: text/plain");

$participer = (isset($_GET["Participer"])) ? $_GET["Participer"] : NULL;
$eid = (isset($_GET["Eid"])) ? $_GET["Eid"] : NULL;
$u = isset($_SESSION['id']) ? new Utilisateur($_SESSION['id']) : new Utilisateur();

if ($participer == "true") {
    $u->inscriptionEvenement($eid);
} elseif ($participer == "false") {
    $u->desinscriptionEvenement($eid);
}

?>