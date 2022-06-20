<?php 
namespace App\Models;

use PDO;
use PDOException;

class User extends \core\Model
{
    public static function get()
    {
        try{
            $db = static::getDB();
            $sql = $db->query('SELECT * FROM users');
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }catch(PDOException $x){
            echo $x->getMessage();
        }
    } 

}

?>