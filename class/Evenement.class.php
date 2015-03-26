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
        if ($eid > 0) {
            $this->setEid($eid);
            $req = "SELECT *
                    FROM evenement
                    WHERE eid = '$eid'";
            foreach (Database::_query($req) as $a) {
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

    public function setEid($eid)
    {
        if (!preg_match("#^[\d]+$#", $eid)) {
            return false;
        }
        $this->eid = $eid;
        return true;
    }

    public function getTitre()
    {
        return $this->titre;
    }

    public function setTitre($titre)
    {
        if (!preg_match("#^[\w\s\.\,\:\?\!\(\)]{1,50}+$#", $titre)) {
            return false;
        }
        $this->titre = $titre;
        return true;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        if (!preg_match("#^[\w\s\.\,\:\?\!\(\)]{1,5000}+$#", $description)) {
            return false;
        }
        $this->description = $description;
        return true;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date)
    {
        if (!preg_match("#^[\w\s\.\,\:\?\!\(\)]{1,5}+$#", $date)) {
            return false;
        }
        $this->date = $date;
        return true;
    }

    public function getDatesql()
    {
        return $this->datesql;
    }

    public function setDatesql($datesql)
    {
        $this->datesql = $datesql;
        return true;
    }

    public function getLieu()
    {
        return $this->lieu;
    }

    public function setLieu($lieu)
    {
        if (!preg_match("#^[\w\s\.\,\:\?\!\(\)]{1,10}+$#", $lieu)) {
            return false;
        }
        $this->lieu = $lieu;
        return true;
    }

    public function insert()
    {
        $req = "INSERT INTO evenement(datesql, date, titre, lieu, description)
                VALUES ('" . $this->datesql . "', '" . $this->date . "', '" . $this->titre . "', '" . $this->lieu . "', '" . $this->description . "')";
        $res = Database::_exec($req);
        if (!$res) return false;
        if ($res) {
            $this->eid = Database::_lastInsertId();
        }
        return $this;
    }

    public static function _exist($e = null)
    {
        if (!is_null($e)) {
            if (verifName($e)) {
                $where = "titre = '$e'";
            } elseif (is_numeric($e)) {
                $where = "eid = '$e'";
            } else {
                return false;
            }
            $req = "SELECT COUNT(1)
                    FROM blog_article
                    WHERE " . $where;
            if (Database::_selectOne($req) > 0) {
                return true;
            }
        }
        return false;
    }

    public static function _affEvenementsAVenir($limit = 2)
    {
        // Sécurité.
        if (!is_int($limit)) {
            return array();
        }

        // Récupération de $limit évènements à venir.
        $req = "SELECT *
                FROM evenement
                WHERE datesql > NOW()
                ORDER BY datesql
                ASC LIMIT 0, $limit";
        $r = array();
        foreach (Database::_query($req) as $a) {
            $r[] = $a;
        }

        // Création d'une "Card" pour chaque évènement.
        foreach ($r as $index => $value) {
            $evenement = new Evenement($value['eid']);
            echo '  <div class="col s12">
                        <div class="card">
                            <div class="card-image waves-effect waves-block waves-light">
                                <a href="affichage_evenement.php?id=' . $value['eid'] . '"><img src="media/background1.jpg"></a>
                                <span class="card-title">' . $value['titre'] . '</span>
                            </div>
                            <div class="card-content">
                                <span class="card-title activator grey-text text-darken-4">
                                    ' . $value['date'] . '
                                    <i class="mdi-navigation-more-vert right"></i>
                                </span>
                                <br>
                                <span class="card-title activator grey-text text-darken-4">
                                    ' . $value['lieu'] . '
                                </span>
                                <span class="card-title activator grey-text text-darken-4 right">
                                    <i class="mdi-social-person right"></i>
                                    ' . $evenement->_nombreParticipants($value['eid']) . '
                                </span>
                            </div>
                            <div class="card-reveal">
                                <span class="card-title grey-text text-darken-4">' . $value['titre'] . '<i class="mdi-navigation-close right"></i></span>
                                <p>' . $value['description'] . '</p>
                            </div>
                        </div>
                    </div>';
        }
    }

    public static function _affEvenementsPasses($limit = 2)
    {
        // Sécurité.
        if (!is_int($limit)) {
            return array();
        }

        // Récupération de $limit évènements passés.
        $req = "SELECT *
                FROM evenement
                WHERE datesql < NOW()
                ORDER BY datesql
                DESC LIMIT 0, $limit";
        $r = array();
        foreach (Database::_query($req) as $a) {
            $r[] = $a;
        }

        // Création d'une "Card" pour chaque évènement.
        foreach ($r as $index => $value) {
            $evenement = new Evenement($value['eid']);
            echo '  <div class="col s12">
                        <div class="card">
                            <div class="card-image waves-effect waves-block waves-light">
                                <a href="affichage_evenement.php?id=' . $value['eid'] . '"><img src="media/background1.jpg"></a>
                                <span class="card-title">' . $value['titre'] . '</span>
                            </div>
                            <div class="card-content">
                                <span class="card-title activator grey-text text-darken-4">
                                    ' . $value['date'] . '
                                    <i class="mdi-navigation-more-vert right"></i>
                                </span>
                                <br>
                                <span class="card-title activator grey-text text-darken-4">
                                    ' . $value['lieu'] . '
                                </span>
                                <span class="card-title activator grey-text text-darken-4 right">
                                    ' . $evenement->_nombreParticipants($value['eid']) . '
                                    <i class="mdi-social-person right"></i>
                                </span>
                            </div>
                            <div class="card-reveal">
                                <span class="card-title grey-text text-darken-4">' . $value['titre'] . '<i class="mdi-navigation-close right"></i></span>
                                <p>' . $value['description'] . '</p>
                            </div>
                        </div>
                    </div>';
        }
    }

    public static function _uidParticipants($eid)
    {
        $req = "SELECT *
                FROM evenement_utilisateur
                WHERE eid = '$eid' ";
        $r = array();
        foreach (Database::_query($req) as $a) {
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
        foreach (Evenement::_uidParticipants($eid) as $value) {
            echo $value->getPseudo();
        }
    }
}