<?php

class Database extends PDO
{
    static private $db;
    static private $last;
    static private $error = null;

    public function __construct()
    {
        $dsn = 'mysql:dbname=' . DBNAME . ';host=' . DBHOST;
        $user = DBUSER;
        $password = DBPASSWORD;

        try {
            self::$db = parent::__construct($dsn, $user, $password);
        } catch (PDOException $e) {
            self::$error = $e;
        }
    }

    public static function _init()
    {
        self::$db = new Database();
        return true;
    }

    public static function _lastError()
    {
        return self::$error;
    }

    public static function _query($sql = "")
    {
        self::$last = self::$db->query($sql);
        return self::$last;
    }

    public static function _selectOne($sql = "")
    {
        self::$last = self::$db->query($sql);

        $return = null;
        foreach (self::$last as $k => $v) {
            foreach ($v as $kk => $vv) {
                $return = $vv;
                break;
            }
            break;
        }
        return $return;
    }

    public static function _lastInsertId()
    {
        return self::$db->lastInsertId();
    }

    public static function _exec($sql)
    {
        self::$last = self::$db->exec($sql);
        return self::$last;
    }

    public static function _beginTransaction()
    {
        return self::$db->beginTransaction();
    }

    public static function _commit()
    {
        return self::$db->commit();
    }

    public static function _rollBack()
    {
        return self::$db->rollBack();
    }
}