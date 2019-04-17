<?php

class Db
{

    private static $pdo;

    /**
     * @param $db_host
     * @param $db
     * @param $db_user
     * @param $db_pass
     * @return bool|PDO
     */
    public static function checkDb($db_host, $db, $db_user, $db_pass ){
        $resp = false;
        try {
            $pdo = new PDO("mysql:host=" . $db_host . ";dbname=" . $db, $db_user,$db_pass);
            return $pdo;
        }catch (Exception $e ){}
        return $resp;
    }


    /**
     * @param PDO $pdo
     * @param $username
     * @param $password
     */
    public static function setup(PDO $pdo, $username, $password ){
        include_once('../sql-setup.php');
        /** @var array $sql_cmd */
        foreach( $sql_cmd as $sql ){
            $d = $pdo->prepare( $sql );
            $d->execute();
            unset( $d );
        }
        $d = $pdo->prepare('insert into user (username,password) values (?,?) ');
        $d->execute( array($username,md5($password)) );
    }

    /**
     * @return PDO
     */
    public static function get( ){
        return self::$pdo;
    }

    /**
     * @param PDO $pdo
     */
    public static function set(PDO $pdo ){
        self::$pdo = $pdo;
    }


}