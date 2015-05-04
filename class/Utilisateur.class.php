<?php

class Utilisateur
{
    private $uid;
    private $pseudo;
    private $email;
    private $password;
    private $admin;

    public function __construct($uid = 0)
    {
        if (self::_exist($uid)) {
            if (is_numeric($uid)) {
                $req = "SELECT * FROM utilisateur WHERE uid = '$uid'";
            }
            else {
                $req = "SELECT * FROM utilisateur WHERE pseudo = '$uid'";
            }
            foreach (Database::_query($req) as $a) {
                $this->uid = $a['uid'];
                $this->pseudo = $a['pseudo'];
                $this->email = $a['email'];
                $this->password = $a['password'];
                $this->admin = $a['admin'];
            }
        } else {
            $this->uid = 0;
            $this->pseudo = 0;
            $this->email = 0;
            $this->password = 0;
            $this->admin = 0;
        }
    }

    public function getUid()
    {
        return $this->uid;
    }

    public function setUid($uid)
    {
        if (!preg_match("#^[\d]+$#", $uid)) {
            return false;
        }
        $this->uid = $uid;
        return true;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        if (!preg_match("#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,4}$#", $email)) {
            return false;
        }
        $this->email = $email;
        return true;
    }

    public function getPseudo()
    {
        return $this->pseudo;
    }

    public function setPseudo($pseudo)
    {
        if (!preg_match("#^[\w\.\#\-\s]{5,}$#", $pseudo)) {
            return false;
        }
        $this->pseudo = $pseudo;
        return true;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        if (!preg_match("#^[\w\.\#\-\s]{6,}$#", $password)) {
            return false;
        }
        $this->password = $password;
        return true;
    }

    public function getAdmin()
    {
        return $this->admin;
    }

    public function setAdmin($admin)
    {
        if ($admin != 0 || $admin != 1) {
            return false;
        }
        $this->admin = $admin;
        return true;
    }

    public function insert()
    {
        $req = "INSERT INTO utilisateur(
                  pseudo,
                  email,
                  password
                ) VALUES (
                  '$this->pseudo',
                  '$this->email',
                  '".md5($this->password)."'
                )";
        return Database::_exec($req);
    }

    public function checkPassword($password){
        if (md5($password) != $this->password) {
            return false;
        }
        return true;
    }

    public function isAdmin()
    {
        if ($this->admin != 1) {
            return false;
        }
        return true;
    }

    public function inscriptionEvenement($eid)
    {
        $req = "INSERT INTO evenement_utilisateur(
                  eid,
                  uid
                ) VALUES (
                  '$eid',
                  '$this->uid'
                )";
        return Database::_exec($req);
    }

    public function desinscriptionEvenement($eid)
    {
        $req = "DELETE FROM evenement_utilisateur
                WHERE eid = '$eid'
                AND   uid = '$this->uid' ";
        return Database::_exec($req);
    }

    static public function _exist($u = null)
    {
        if (!is_null($u)) {
            if (verifMail($u)) {
                $where = "email = '$u'";
            } else if (verifInt($u)) {
                $where = "uid = '" . intval($u) . "'";
            } else if (verifName($u)) {
                $where = "pseudo = '$u'";
            } else {
                return false;
            }

            $req = "SELECT uid
                    FROM utilisateur
                    WHERE " . $where;
            if (Database::_selectOne($req) > 0) {
                return true;
            }
        }
        return false;
    }

    public function checkOrUncheck($eid)
    {
        // Récupération des utilisateurs inscrits à l'évènement.
        $req = "SELECT *
                FROM evenement_utilisateur
                WHERE eid = '$eid'";
        $r = array();
        foreach (Database::_query($req) as $a) {
            $r[] = $a;
        }

        // Si l'utilisateur est inscrit on check, sinon non.
        $check = 0;
        foreach ($r as $index => $value) {
            if ($value['uid'] == $this->uid) {
                $check++;
            }
        }
        if ($check == 0) {
            echo 'unchecked';
        } else {
            echo 'checked';
        }
    }
}