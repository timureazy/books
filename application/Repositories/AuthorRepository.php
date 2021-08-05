<?php

namespace Repositories;
use Core\Database;
use Models\Author;
use PDO;
class AuthorRepository
{
    public function save(Author $author, bool $newName = false)
    {
        $connection = Database::getConnect();
        if($newName) {
            $sql = "UPDATE authors SET name = :name where name = :oldName";
            $query = $connection->prepare($sql);
            $query->execute(array('name' => $author->getName(), 'oldName' => $author->getOldName()));
        }
        else {
            $sql = "INSERT INTO authors(name) value(:name)";
            $query = $connection->prepare($sql);
            $query->bindValue('name', $author->getName());
            $query->execute();
        }
    }

    public function getId(Author $author): Author
    {
        $connection = Database::getConnect();
        $sql = 'SELECT id FROM authors WHERE name = :name';
        $query = $connection->prepare($sql);
        $query->bindValue('name', $author>getName());
        $query->execute();
        $res = $query->fetch(PDO::FETCH_ASSOC);
        return $author->setId($res['id']);
    }

    public function addRel(Author $author, $bookId)
    {
        $connection = Database::getConnect();
        $sql = "INSERT INTO rel_author_work(fid_author, fid_work) values (:authorId, :bookId)";
        $query = $connection->prepare($sql);
        $query->execute(array('authorId' => $author->getId(), 'bookId' => $bookId));
    }

}