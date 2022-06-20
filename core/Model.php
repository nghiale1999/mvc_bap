<?php 

namespace core;
use PDO;
use App\Config;
use PDOException;

abstract class Model
{
    protected static function getDB()
    {
        static $db = null;

        if($db === null){
           
            $dbhn = 'mysql:host=' . Config::DB_HOST . ';dbname=' . Config::DB_NAME . ';charset=utf8';
            $db = new PDO($dbhn, Config::DB_USER, Config::DB_PASSWORD);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
        }
        return $db;
    }
}
?>