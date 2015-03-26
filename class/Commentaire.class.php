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
            $req = "SELECT *
                    FROM commentaire
                    WHERE cid = $cid";
            foreach (Database::_query($req) as $a) {
                $this->cid = $a['cid'];
                $this->eid = $a['eid'];
                $this->uid = $a['uid'];
                $this->contenu = $a['contenu'];
                $this->date = $a['date'];
            }
        } else {
            $this->idt = 0;
            $this->idf = 0;
            $this->uid = 0;
            $this->nom = 0;
            $this->description = 0;
            $this->date = 0;
        }
    }

    public static function _getAllCommentaire($eid)
    {
        // On récupère tous les commentaires pour l'eid donné dans un tableau.
        $r = array();
        $req = "SELECT *
                FROM commentaire
                WHERE eid = '$eid'";
        foreach (Database::_query($req) as $a) {
            $r[] = $a;
        }

        // On crée pour chaque commentaire un "Avatar Content".
        foreach ($r as $index => $value) {
            $utilisateur = new Utilisateur($value['uid']);
            echo '  <li class="collection-item avatar">
                        <i class="mdi-file-folder circle"></i>
                        <span class="title">' . $utilisateur->getPseudo() . ' le ' . $value['date'] . '</span>
                        <p>
                            ' . $value['contenu'] . '
                        </p>
                    </li>';
        }
    }

    public function getCid()
    {
        return $this->cid;
    }

    public function setCid($cid)
    {
        if (!preg_match('#^[\d]+$#', $cid)) {
            return false;
        }
        $this->cid = $cid;
        return true;

    }

    public function getEid()
    {
        return $this->eid;
    }

    public function setEid($eid)
    {
        if (!preg_match('#^[\d]+$#', $eid)) {
            return false;
        }
        $this->eid = $eid;
        return true;
    }

    public function getUid()

    {
        return $this->uid;
    }

    public function setUid($uid)
    {
        if (!preg_match('#^[\d]+$#', $uid)) {
            return false;
        }
        $this->uid = $uid;
        return true;
    }

    public function getContenu()
    {
        return stripslashes($this->contenu);
    }

    public function setContenu($contenu)
    {
        if (!preg_match('#^[\w\s\.\,\:\?\!\(\)]+$#', $contenu)) {
            return false;
        }
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
        $req = "INSERT INTO commentaire(date, eid, uid, contenu)
                VALUES (NOW(), '" . $this->eid . "','" . $this->uid . "','" . $this->contenu . "')";
        $res = Database::_exec($req);
        if ($res) {
            $this->cid = Database::_lastInsertId();
        }
        return $this;
    }
}