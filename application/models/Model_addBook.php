<?php
namespace Models;
use Core\Model;
use PDO;

class Model_addBook extends Model
{

    public function addBook($bookName, $public_date, $genre, $authorName)
    {
        $connection = $this->connect_to_db();
        $sql = "BEGIN;
                INSERT INTO work_info (book_name, genre, public_date) 
                VALUES(:bookName, :genre, :public_date);
                SET @last_book_id = (SELECT max(id) as last_id from work_info);
                SET @author_id = (SELECT id FROM authors WHERE name = :authorName);
                INSERT INTO rel_author_work(fid_author, fid_work)
                VALUES(@author_id, @last_book_id);
                COMMIT;";
        $query = $connection->prepare($sql);
        $query -> execute(array('bookName' => $bookName, 'public_date' => $public_date, 'genre' => $genre, 'authorName' => $authorName));
    }

}