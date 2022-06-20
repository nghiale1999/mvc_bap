<?php 
namespace App\Models;

use PDO;
use PDOException;

class Post extends \core\Model
{
    public static function getAll()
    {
        try{
            $db = static::getDB();
            $sql = $db->query('SELECT * FROM posts');
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }catch(PDOException $x){
            echo $x->getMessage();
        }
    } 

    public static function create($data = [])
    {
        
        $columns = implode(',', array_keys($data));
        $newValues = array_map(function($value){
            return "'". $value. "'";
        }, array_values($data));
        $newValues = implode(',', $newValues);
        
        $db = static::getDB();
        // $abc = "INSERT INTO posts ($columns) VALUES ($newValues)";
        // echo $abc ;
        // die;
        $db->query("INSERT INTO posts ($columns) VALUES ($newValues)");
        
    }

    public static function delete($id)
    {
        $db = static::getDB();
        $db->query("DELETE FROM posts WHERE id =$id");
        
    } 

    public static function find($id)
    {
        $db = static::getDB();
        $sql = $db->query("SELECT * FROM posts WHERE id = $id");
        $data = $sql->fetchAll(PDO::FETCH_BOTH);
        return $data;
    }

    public static function update($id, $data = [])
    {
        $dataSets = [];
        foreach($data as $key => $value)
        {
            array_push($dataSets, "${key} = '". $value ."'");
        }
        $dataSetString = implode(',', $dataSets);
        $db = static::getDB();
        $db->query("UPDATE posts SET $dataSetString WHERE id = $id");

        
    }
 
}

?>