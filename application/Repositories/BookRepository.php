<?php

namespace Repositories;
use Core\Database;
use Models\Book;
use PDO;

class BookRepository
{

    public function addBook(Book $book)
    {
        $connection = Database::getConnect();
        $sql = "BEGIN;
                INSERT INTO work_info (book_name, genre, public_date) 
                VALUES(:bookName, :genre, :public_date);
                SET @last_book_id = (SELECT max(id) as last_id from work_info);
                SET @author_id = (SELECT id FROM authors WHERE name = :authorName);
                INSERT INTO rel_author_work(fid_author, fid_work)
                VALUES(@author_id, @last_book_id);
                COMMIT;";
        $query = $connection->prepare($sql);
        $query -> execute(array('bookName' => $book->getName(), 'public_date' => $book->getDate(), 'genre' => $book->getGenre(), 'authorName' => $book->getAuthor()));
    }

    public function getBookById($id)
    {
        $connection = Database::getConnect();
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
        $connection = Database::getConnect();
        $sql = 'DELETE FROM rel_author_work WHERE fid_author = :authorId and fid_work = :id';
        $query = $connection->prepare($sql);
        $query->execute(array('authorId' => $authorId, 'id' => $id));
    }

    public function getAuthorId($name)
    {
        $connection = Database::getConnect();
        $sql = 'SELECT id FROM authors WHERE name = :name';
        $query = $connection->prepare($sql);
        $query->bindValue('name', $name);
        $query->execute();
        $res = $query->fetch(PDO::FETCH_ASSOC);
        return $res;
    }

    public function updateAuthor($authorId, $relId)
    {
        $connection = Database::getConnect();
        $sql = 'UPDATE rel_author_work SET fid_author = :authorId WHERE id = :rel_id';
        $query = $connection->prepare($sql);
        $query->execute(array('authorId' => $authorId, 'rel_id' => $relId));
    }

    public function updateBook(Book $book)
    {
        $connection = Database::getConnect();
        $sql = 'UPDATE work_info SET book_name = :book_name WHERE id = :id';
        $query = $connection->prepare($sql);
        $query->execute(array('book_name' => $book->getName(), 'id' => $book->getId()));
    }

    public function updateGenre(Book $book)
    {
        $connection = Database::getConnect();
        $sql = 'UPDATE work_info SET genre = :genre WHERE id = :id';
        $query = $connection->prepare($sql);
        $query->execute(array('genre' => $book->getGenre(), 'id' => $book->getId()));
    }

    public function updatePublicDate(Book $book)
    {
        $connection = Database::getConnect();
        $sql = 'UPDATE work_info SET public_date = :public_date WHERE id = :id';
        $query = $connection->prepare($sql);
        $query->execute(array('public_date' => $book->getDate(), 'id' => $book->getId()));
    }

}