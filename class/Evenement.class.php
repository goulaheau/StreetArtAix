<?php

class Evenement
{
    private $eid;
    private $titre;
    private $description;
    private $date;
    private $datesql;
    private $lieu;

    public function __construct($eid = 0)
    {
        if (self::_exist($eid)) {
            $req = "SELECT * FROM evenement WHERE eid = '$eid'";
            $res = mysqli_query($GLOBALS['db'], $req) or die(mysql_error() . '<br />Erreur dans le fichier ' . FILE . ' à la ligne ' . LINE . ' avec la requete : ' . $req);
            while ($a = mysqli_fetch_assoc($res)) {
                $this->eid = $a['eid'];
                $this->titre = $a['titre'];
                $this->description = $a['description'];
                $this->date = $a['date'];
                $this->datesql = $a['datesql'];
                $this->lieu = $a['lieu'];
            }
        } else {
            $this->eid = 0;
            $this->titre = 0;
            $this->description = 0;
            $this->date = 0;
            $this->datesql = 0;
            $this->lieu = 0;
        }
    }

    public function getEid()
    {
        return $this->eid;
    }

    public function getTitre()
    {
        return $this->titre;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function getDatesql()
    {
        return $this->datesql;
    }

    public function getLieu()
    {
        return $this->lieu;
    }

    public function setTitre($titre)
    {
        $this->titre = $titre;
        return true;
    }

    public function setDescription($description)
    {
        $this->description = $description;
        return true;
    }

    public function setDate($date)
    {
        $this->date = $date;
        return true;
    }

    public function setDatesql($datesql)
    {
        $this->datesql = $datesql;
        return true;
    }

    public function setLieu($lieu)
    {
        $this->lieu = $lieu;
        return true;
    }

    public function insert()
    {
        $db = mysqli_connect("127.0.0.1", "root", "", "streetartaix");
        $req = "INSERT INTO evenement (datesql, date, titre, lieu, description) VALUES ('" . $this->datesql . "', '" . $this->date . "', '" . $this->titre . "', '" . $this->lieu . "', '" . $this->description . "')";
        $res = mysqli_query($GLOBALS['db'], $req) or die(mysql_error() . '<br />Erreur dans le fichier ' . __FILE__ . ' à la ligne ' . __LINE__ . ' avec la requete : ' . $req);
        if (!$res) return false;
        $this->eid = mysqli_insert_id($db);
        return true;
    }

    public static function _exist($e = null)
    {
        if (!is_null($e)) {
            if (verifName($e)) $where = "titre = '$e'";
            elseif (is_numeric($e)) $where = "eid = '$e'";
            else return false;

            $req = "SELECT eid FROM evenement WHERE " . $where;
            $res = mysqli_query($GLOBALS['db'], $req) or die(mysql_error() . '<br />Erreur dans le fichier ' . __FILE__ . ' à la ligne ' . __LINE__ . ' avec la requete : ' . $req);
            if (mysqli_num_rows($res) > 0) return true;
            else return false;
        }
        return false;
    }

    public static function _evenementsAVenir($limit = 2)
    {
        if (!is_int($limit)) return array();
        $req = "SELECT * FROM evenement  WHERE datesql > NOW() ORDER BY datesql ASC LIMIT 0, $limit";
        $res = mysqli_query($GLOBALS['db'], $req) or die(mysql_error() . '<br />Erreur dans le fichier ' . __FILE__ . ' à la ligne ' . __LINE__ . ' avec la requete : ' . $req);
        $r = array();
        while ($a = mysqli_fetch_assoc($res)) {
            $r[] = $a;
        }
        return $r;
    }

    public static function _affEvenementsAVenir($limit)
    {
        foreach (Evenement::_evenementsAVenir($limit) as $v) {
            $e = new Evenement($v['eid']);
            echo '
                <div class="col s12">
                    <div class="card">
                        <div class="card-image waves-effect waves-block waves-light">
                            <a href="affichage_evenement.php?id=' . $v['eid'] . '"><img src="media/background1.jpg"></a>
                            <span class="card-title">' . $v['titre'] . '</span>
                        </div>
                        <div class="card-content">
                            <span class="card-title activator grey-text text-darken-4">
                                ' . $v['date'] . '
                                <i class="mdi-navigation-more-vert right"></i>
                            </span>
                            <br>
                            <span class="card-title activator grey-text text-darken-4">
                                ' . $v['lieu'] . '
                            </span>
                            <span class="card-title activator grey-text text-darken-4 right">
                                <i class="mdi-social-person right"></i>
                                ' . $e->_nombreParticipants($v['eid']) . '
                            </span>
                        </div>
                        <div class="card-reveal">
                            <span class="card-title grey-text text-darken-4">' . $v['titre'] . '<i class="mdi-navigation-close right"></i></span>
                            <p>' . $v['description'] . '</p>
                        </div>
                    </div>
                </div>
            ';
        }
    }

    public static function _evenementsPasses($limit = 2)
    {
        if (!is_int($limit)) return array();
        $req = "SELECT * FROM evenement  WHERE datesql < NOW() ORDER BY datesql DESC LIMIT 0, $limit";
        $res = mysqli_query($GLOBALS['db'], $req) or die(mysql_error() . '<br />Erreur dans le fichier ' . __FILE__ . ' à la ligne ' . __LINE__ . ' avec la requete : ' . $req);
        $r = array();
        while ($a = mysqli_fetch_assoc($res)) {
            $r[] = $a;
        }
        return $r;
    }

    public static function _affEvenementsPasses($limit)
    {
        foreach (Evenement::_evenementsPasses($limit) as $v) {
            $e = new Evenement($v['eid']);
            echo '
                <div class="col s12">
                    <div class="card">
                        <div class="card-image waves-effect waves-block waves-light">
                            <a href="affichage_evenement.php?id=' . $v['eid'] . '"><img src="media/background1.jpg"></a>
                            <span class="card-title">' . $v['titre'] . '</span>
                        </div>
                        <div class="card-content">
                            <span class="card-title activator grey-text text-darken-4">
                                ' . $v['date'] . '
                                <i class="mdi-navigation-more-vert right"></i>
                            </span>
                            <br>
                            <span class="card-title activator grey-text text-darken-4">
                                ' . $v['lieu'] . '
                            </span>
                            <span class="card-title activator grey-text text-darken-4 right">
                                ' . $e->_nombreParticipants($v['eid']) . '
                                <i class="mdi-social-person right"></i>
                            </span>
                        </div>
                        <div class="card-reveal">
                            <span class="card-title grey-text text-darken-4">' . $v['titre'] . '<i class="mdi-navigation-close right"></i></span>
                            <p>' . $v['description'] . '</p>
                        </div>
                    </div>
                </div>
            ';
        }
    }

    public static function _uidParticipants($eid)
    {
        $req = "SELECT * FROM evenement_utilisateur WHERE eid = '$eid' ";
        $res = mysqli_query($GLOBALS['db'], $req) or die(mysql_error() . '<br />Erreur dans le fichier ' . __FILE__ . ' à la ligne ' . __LINE__ . ' avec la requete : ' . $req);
        $r = array();
        while ($a = mysqli_fetch_assoc($res)) {
            $r[] = $a;
        }
        return $r;
    }

    public static function _nombreParticipants($eid)
    {
        $nombre = count(Evenement::_uidParticipants($eid));
        return $nombre;
    }

    public static function _pseudoParticipants($eid)
    {
        foreach (Evenement::_uidParticipants($eid) as $v) {
            echo $v->getPseudo();
        }
    }
}