<?php
namespace Models;

use Core\Model;
use PDO;

class Model_addAuthor extends Model
{
   public function addAuthor($name){
       $connection = $this->connect_to_db();
       $sql = "INSERT INTO authors(name) value(:name)";
       $query = $connection->prepare($sql);
       $query->bindValue('name', $name);
       $query->execute();
   }

    public function getAuthorId($name)
    {
        $connection = $this->connect_to_db();
        $sql = 'SELECT id FROM authors WHERE name = :name';
        $query = $connection->prepare($sql);
        $query->bindValue('name', $name);
        $query->execute();
        $res = $query->fetch(PDO::FETCH_ASSOC);
        return $res;
    }

    public function addAuthorRel($authorId, $bookId)
    {
        $connection = $this->connect_to_db();
        $sql = "INSERT INTO rel_author_work(fid_author, fid_work) values (:authorId, :bookId)";
        $query = $connection->prepare($sql);
        $query->execute(array('authorId' => $authorId, 'bookId' => $bookId));
    }
}