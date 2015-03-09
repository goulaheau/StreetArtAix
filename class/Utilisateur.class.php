<?php
class Utilisateur
{
    private $pseudo;
    private $email;
    private $password;
    private $uid;
    private $admin;
    private $eid;
    
    public function __construct($uid = 0)
    {
        if(self::_exist($uid)) {
            if (verifInt($uid)) {
                $req = "SELECT * FROM utilisateur WHERE uid = '$uid'";
            }else {
                $req = "SELECT * FROM utilisateur WHERE pseudo = '$uid'";            
            }
            $res = mysqli_query($GLOBALS['db'], $req) or die(mysql_error() . '<br />Erreur dans le fichier ' . FILE . ' à la ligne ' . LINE . ' avec la requete : ' . $req);
            while($a = mysqli_fetch_assoc($res)){
                $this->uid = $a['uid'];
                $this->email = $a['email'];
                $this->pseudo = $a['pseudo'];
                $this->password = $a['password'];
                $this->admin = $a['admin'];
            }
        }else {
            $this->email = 0;
            $this->pseudo = 0;
            $this->password = 0;
            $this->uid = 0;
            $this->admin = 0;
        }
    }
    public function getEmail()
    {
        return $this->email;
    }

    public function getPseudo()
    {
        return $this->pseudo;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getUid()
    {
        return $this->uid;
    }

    public function setEmail($email)
    {
        if (!preg_match("#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,4}$#", $email)) 
        {
            return false;
        }
        $this->email = $email;
        return true;
    }

    public function setPseudo($pseudo) 
    {
        if (!preg_match("#^[\w\.\#\-\s]{5,}$#", $pseudo)) 
        {
            return false;
        }
        $this->pseudo = $pseudo;
        return true;
    }

    public function setPassword($password)
    {
        if (!preg_match("#^[\w\.\#\-\s]{6,}$#", $password)) 
        {
            return false;
        }   
        $this->password = $password;
        return true;
    }

    public function setUid($uid)
    {
        $this->uid = $uid;
    }

    public function insert()
    {
        $db = mysqli_connect("127.0.0.1", "root", "", "streetartaix");
        $req = "INSERT INTO utilisateur(pseudo, email, password) VALUES('".$this->pseudo."', '".$this->email."', '" . md5($this->password) . "')";
        $res = mysqli_query($GLOBALS['db'], $req) or die(mysql_error() . '<br />Erreur dans le fichier ' . __FILE__ . ' à la ligne ' . __LINE__ . ' avec la requete : ' . $req);
        if(!$res) return false;
        $this->uid = mysqli_insert_id($db);
        return true;
    }

    public function checkPassword($password)
    {
        if (md5($password) != $this->password) {
            return false;
        }
        return true;
    }

    public function isAdmin()
    {
        if($this->admin != 1) {
            return false;
        } 
        return true;
    }

    static public function _exist($u = null) 
    {
        if (!is_null($u)) 
        {
            if (verifMail($u)) $where = "email = '$u'";
            else if (verifInt($u)) $where = "uid = '" . intval($u) . "'";
            else if (verifName($u)) $where = "pseudo = '$u'";
            else return false;
            
            $req = "SELECT uid FROM utilisateur WHERE " . $where;
            $res = mysqli_query($GLOBALS['db'], $req) or die(mysql_error() . '<br />Erreur dans le fichier ' . __FILE__ . ' à la ligne ' . __LINE__ . ' avec la requete : ' . $req);
            if (mysqli_num_rows($res) > 0) return true;
            else return false;
        }
        return false;
    }
}