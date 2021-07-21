<?php
namespace Models;

use Core\Model;
use PDO;

class Model_changeAuthor extends Model
{
   public function changeAuthor($name, $oldName){
       $connection = $this->connect_to_db();
       $sql = "UPDATE authors SET name = :name where name = :oldName";
       $query = $connection->prepare($sql);
       $query->execute(array('name' => $name, 'oldName' => $oldName));
   }

    public function getAuthorByName($name)
    {
        $connection = $this->connect_to_db();
        $sql = 'SELECT name  FROM authors WHERE name = :name';
        $query = $connection->prepare($sql);
        $query->bindValue('name', $name);
        $query->execute();
        $res = $query->fetch(PDO::FETCH_ASSOC);
        return $res;
    }
}