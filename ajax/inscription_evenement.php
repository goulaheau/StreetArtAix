<?php
if(isset($_POST['check'])
    $db = mysqli_connect("127.0.0.1", "root", "", "streetartaix");
    $req = "INSERT INTO evenement_utilisateur(uid, eid) VALUES('".$this->uid."', '".$this->eid."')";
    $res = mysqli_query($GLOBALS['db'], $req) or die(mysql_error() . '<br />Erreur dans le fichier ' . __FILE__ . ' à la ligne ' . __LINE__ . ' avec la requete : ' . $req);
    if(!$res) return false;
    $this->uid = mysqli_insert_id($db);
    return true;
