<?php

class Comment extends Evenement
{
    private $eid;
    private $cid;
    private $uid;
    private $message;
    private $date;

    public function __construct($save = array("cid"=>0, "eid"=>0)){
        if(is_array($save)){
            if(isset($save["cid"]) && self::_exist($save['cid']) ){
                $this->setCid($cid); 
                $req = "
                    SELECT *
                    FROM commentaire 
                    WHERE cid = '".$save['cid']."'";
                $res = mysqli_query($GLOBALS['db'], $req) or die(mysql_error() . '<br />Erreur dans le fichier ' . __FILE__ . ' à la ligne ' . __LINE__ . ' avec la requete : ' . $req);
                while($a = mysqli_fetch_assoc($res)){
                    $this->eid = $a['eid'];
                    $this->cid = $a['cid'];
                    $this->uid = $a['uid'];
                    $this->message = $a['message'];
                    $this->date = $a['date'];
                }
            }else if(isset($save['eid']) && BlogArticle:: _exist($save['eid'])){
                $req = "SELECT COUNT(1) FROM blog_comment WHERE eid = '".$save['eid']."'";
                $this->eid = $save['eid'];
                $this->cid = intval(Database::_selectOne($req))+1;
                $this->uid = 0;
                $this->message = 0;
                $this->date = 0;
            }            
        }else{
            $this->eid = 0;
            $this->cid = 0;
            $this->uid = 0;
            $this->message = 0;
            $this->date = 0;
        }       
    }

    public function getEid()
    {
        return $this->eid;
    }

    public function setEid($eid)
    {
        if(!preg_match('#^[\d]+$#', $eid)) return false;
        $this->eid = $eid;

    }

    public function getCid()
    {
        return $this->cid;
    }

    public function setCid($cid)
    {
        if(!preg_match('#^[\d]+$#', $cid)) return false;
        $this->cid = $cid;

    }

    public function getUid()
    {
        return $this->Uid;
    }

    public function setUid($uid)
    {
        if(!preg_match('#^[\d]+$#', $uid)) return false;
        $this->uid = $uid;

    }

    public function getMessage()
    {
        return stripslashes($this->message);
    }

    public function setMessage($message)
    {
        if(!preg_match('#^[\w\s\.\,\:\?\!\(\)]+$#', $message))return false;
        $this->message = addslashes($message);
        return $this->message;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }

    public function insert(){
        $req = "INSERT INTO commentaire(eid,uid,message) VALUES('".$this->eid."','".$this->uid."','".$this->message."')";
        $res = mysqli_query($GLOBALS['db'], $req) or die(mysql_error() . '<br />Erreur dans le fichier ' . __FILE__ . ' à la ligne ' . __LINE__ . ' avec la requete : ' . $req);
        return true;
    }

    static public function _exist($u = array()){
        if(!is_array($u)) return false;
        elseif (!isset($u['eid']) && !BlogArticle::_exist($u['eid']))
            return false;
        elseif(!isset($u['cid']) && !is_numeric($u['cid'])) 
            return false;

        $req = "
            SELECT COUNT(1) 
            FROM commentaire 
            WHERE eid = '".$u['eid']."'
            AND cid = '".$u['cid']."'
        ";

        if(Database::_selectOne($req) > 0) return true;
        return false;
    }

}