<?php

class Image
{

    private $iid;
    private $nom;
    private $description;
    private $uid;
    private $extension;
    private $affichage;

    public function __construct($iid = 0)
    {
        if ($iid > 0) {
            $this->setIid($iid);
            $req = "SELECT *
                    FROM image
                    WHERE iid = '$iid'";
            foreach (Database::_query($req) as $a) {
                $this->iid = $a['iid'];
                $this->nom = $a['nom'];
                $this->description = $a['description'];
                $this->uid = $a['uid'];
            }
        } else {
            $this->iid = 0;
            $this->nom = 0;
            $this->description = 0;
            $this->uid = 0;
        }
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        if (!preg_match("#^[\w\s\-]{1,50}$#", $nom)) {
            return false;
        }
        $this->nom = $nom;
        return true;
    }

    /**
     * @return int
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param int $description
     */
    public function setDescription($description)
    {
        if (!preg_match("#^[\w\s\.\,\:\?\!\(\)]{1,500}+$#", $description)) {
            return false;
        }
        $this->description = $description;
        return true;
    }


    /**
     * @return mixed
     */
    public function getUid()
    {
        return $this->uid;
    }

    /**
     * @param mixed $uid
     */
    public function setUid($uid)
    {
        if (!preg_match("#^[\d]+$#", $uid)) {
            return false;
        }
        $this->uid = $uid;
        return true;
    }

    /**
     * @return mixed
     */
    public function getIid()
    {
        return $this->iid;
    }

    /**
     * @param mixed $iid
     */
    public function setIid($iid)
    {
        if (!preg_match("#^[\d]+$#", $iid)) {
            return false;
        }
        $this->iid = $iid;
        return true;
    }

    /**
     * @return mixed
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * @param mixed $extension
     */
    public function setExtension($extension)
    {
        if (!preg_match("#^[a-z]{3,4}$#", $extension)) {
            return false;
        }
        $this->extension = $extension;
        return true;
    }

    /**
     * @return mixed
     */
    public function getAffichage()
    {
        return $this->affichage;
    }

    /**
     * @param mixed $affichage
     */
    public function setAffichage($affichage)
    {
        if (!preg_match("#^[\d]+$#", $affichage)) {
            return false;
        }
        $this->affichage = $affichage;
        return true;
    }


    public function insert()
    {
        $req = "INSERT INTO image(
                  uid,
                  nom,
                  description,
                  extension
                ) VALUES (
                  '$this->uid',
                  '$this->nom',
                  '$this->description',
                  '$this->extension'
                )";
        $res = Database::_exec($req);
        if ($res) {
            $this->iid = Database::_lastInsertId();
        }
        return $this;
    }

    public function delete($iid)
    {
        $req = "DELETE FROM image
                WHERE iid = '$iid'";
        $res = Database::_exec($req);
        if ($res) {
            $this->iid = Database::_lastInsertId();
        }
        return $this;
    }

}