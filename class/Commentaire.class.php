<?php

class Commentaire
{
    private $cid;
    private $eid;
    private $uid;
    private $contenu;
    private $date;

    public function __construct($cid = 0)
    {
        if ($cid > 0) {
            $this->setCid($cid);
            $req = "SELECT * FROM commentaire  WHERE cid = $cid";
            $res = mysqli_query($GLOBALS['db'], $req) or die(mysql_error() . '<br />Erreur dans le fichier ' . __FILE__ . ' à la ligne ' . __LINE__ . ' avec la requete : ' . $req);
            while ($a = mysqli_fetch_assoc($res)) {
                $this->cid = $a['cid'];
                $this->eid = $a['eid'];
                $this->uid = $a['uid'];
                $this->contenu = $a['contenu'];
                $this->date = $a['date'];
            }
        } else {
            $this->cid = 0;
            $this->eid = 0;
            $this->uid = 0;
            $this->contenu = 0;
            $this->date = 0;
        }

    }

    public static function _getAllCommentaire($eid)
    {
        $r = array();
        if ($eid > 0) {

            $req = "SELECT * FROM commentaire  WHERE eid = '$eid'";
            $res = mysqli_query($GLOBALS['db'], $req) or die(mysql_error() . '<br />Erreur dans le fichier ' . __FILE__ . ' à la ligne ' . __LINE__ . ' avec la requete : ' . $req);
            while ($a = mysqli_fetch_assoc($res)) {
                $r[] = $a;
            }

            foreach ($r as $index => $value) {
                $utilisateur = new Utilisateur($value['uid']);
                echo "
                    <li class='collection-item avatar'>
                        <i class='mdi-file-folder circle'></i>
                        <span class='title'>" . $utilisateur->getPseudo() . " le " . $value['date'] . "</span>
                        <p>
                            " . $value['contenu'] . "
                        </p>
                    </li>";
            }
        }
    }

    public function getCid()
    {
        return $this->cid;
    }

    public function setCid($cid)
    {
        if (!preg_match('#^[\d]+$#', $cid)) return false;
        $this->cid = $cid;
        return true;

    }

    public function getEid()
    {
        return $this->eid;
    }

    public function setEid($eid)
    {
        if (!preg_match('#^[\d]+$#', $eid)) return false;
        $this->eid = $eid;
        return true;
    }

    public function getUid()

    {
        return $this->uid;
    }

    public function setUid($uid)
    {
        if (!preg_match('#^[\d]+$#', $uid)) return false;
        $this->uid = $uid;
        return true;
    }

    public function getContenu()
    {
        return stripslashes($this->contenu);
    }

    public function setContenu($contenu)
    {
        if (!preg_match('#^[\w\s\.\,\:\?\!\(\)]+$#', $contenu)) return false;
        $this->contenu = addslashes($contenu);
        return true;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date)
    {
        $this->date = $date;
        return true;
    }

    public function insert()
    {
        $db = mysqli_connect("127.0.0.1", "root", "", "streetartaix");
        $req = "
            INSERT INTO commentaire (date, eid, uid, contenu)
            VALUES (NOW(), '" . $this->eid . "','" . $this->uid . "','" . $this->contenu . "')";
        $res = mysqli_query($GLOBALS['db'], $req) or die(mysql_error() . '<br />Erreur dans le fichier ' . __FILE__ . ' à la ligne ' . __LINE__ . ' avec la requete : ' . $req);
        if (!$res) return false;
        $this->cid = mysqli_insert_id($db);
        return true;
    }
}