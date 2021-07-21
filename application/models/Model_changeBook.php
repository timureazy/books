<?php
namespace Models;

use Core\Model;
use PDO;

class Model_changeBook extends Model
{
    public function getBookById($id)
    {
        $connection = $this->connect_to_db();
        $sql = "SELECT     wi.id as id, group_concat(distinct a.name) as name, max(wi.public_date) as public_date, max(wi.genre) as genre, max(raw.id) as rel_id, book_name
                          FROM work_info wi
                          join rel_author_work raw on wi.id = raw.fid_work
                                                    and wi.id = :id
                          join authors a on a.id = raw.fid_author
                          group by book_name";
        $query = $connection->prepare($sql);
        $query->bindValue('id', $id);
        $query->execute();
        $res = $query->fetch(PDO::FETCH_ASSOC);
        return $res;
    }

    public function deleteAuthor($authorId, int $id)
    {
        $connection = $this->connect_to_db();
        $sql = 'DELETE FROM rel_author_work WHERE fid_author = :authorId and fid_work = :id';
        $query = $connection->prepare($sql);
        $query->execute(array('authorId' => $authorId, 'id' => $id));
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

    public function updateAuthor($authorId, $relId)
    {
        $connection = $this->connect_to_db();
        $sql = 'UPDATE rel_author_work SET fid_author = :authorId WHERE id = :rel_id';
        $query = $connection->prepare($sql);
        $query->execute(array('authorId' => $authorId, 'rel_id' => $relId));
    }

    public function updateBook($book_name, $id)
    {
        $connection = $this->connect_to_db();
        $sql = 'UPDATE work_info SET book_name = :book_name WHERE id = :id';
        $query = $connection->prepare($sql);
        $query->execute(array('book_name' => $book_name, 'id' => $id));
    }

    public function updateGenre($genre, $id)
    {
        $connection = $this->connect_to_db();
        $sql = 'UPDATE work_info SET genre = :genre WHERE id = :id';
        $query = $connection->prepare($sql);
        $query->execute(array('genre' => $genre, 'id' => $id));
    }

    public function updatePublicDate($public_date, $id)
    {
        $connection = $this->connect_to_db();
        $sql = 'UPDATE work_info SET public_date = :public_date WHERE id = :id';
        $query = $connection->prepare($sql);
        $query->execute(array('public_date' => $public_date, 'id' => $id));
    }
}