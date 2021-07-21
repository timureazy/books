<?php


namespace Utils;
use PDO;

class Checker extends \Core\Model
{
    public function isAuthorExists($author)
    {
        $connection = $this->connect_to_db();
        $sql = "SELECT name FROM authors WHERE name = :author";
        $query = $connection->prepare($sql);
        $query -> bindValue('author', $author);
        $query -> execute();
        $res = $query->fetch(PDO::FETCH_ASSOC);
        return $res;
    }

    public function isBookExists($book)
    {
        $connection = $this->connect_to_db();
        $sql = "SELECT book_name FROM work_info WHERE book_name = :book";
        $query = $connection->prepare($sql);
        $query -> bindValue('book', $book);
        $query -> execute();
        $res = $query->fetch(PDO::FETCH_ASSOC);
        return $res;
    }

    public function isRelExists($authorId, $bookId)
    {
        $connection = $this->connect_to_db();
        $sql = "SELECT id FROM rel_author_work WHERE fid_author = :authorId and fid_work = :bookId";
        $query = $connection->prepare($sql);
        $query -> bindValue('fid_author', $authorId);
        $query -> bindValue('fid_work', $bookId);
        //$query -> execute();
        $res = $query->fetch(PDO::FETCH_ASSOC);
        return $res;
    }

    public function validateAuthor($data, bool $isNewAuthor = false, bool $isNewRel = false)
   {
        $authorNameValidation = "/[^а-яА-Я\s]+/msiu";
        $isAuthorExists = $this->isAuthorExists($data['authorName']);
        $isRelExists = $this->isRelExists($data['authorId'], $data['bookId']);
        if(empty($data['authorName']) == true){
            $data['authorNameError'] = "Введите имя автора";
            $data['authorName'] = '';
        } elseif (preg_match($authorNameValidation, $data['authorName'])){
            $data['authorNameError'] =  'Имя автора должно содержать только кириллицу, в верхнем и нижнем регистре';
            $data['authorName'] = '';
        } elseif ($isNewAuthor == true && empty($isAuthorExists) != 1){
            $data['authorNameError'] =  'Такой автор уже есть, имя должно быть уникальным';
            $data['authorName'] = '';
        } elseif ($isNewRel == true && empty($isAuthorExists) != 0){
            $data['authorNameError'] =  'Такого автора нет в списке авторов.'.'<br>'.'Сначала добавьте его туда'.'<br>'.'Кнопка внизу на главной странице';
            $data['authorName'] = '';
        } elseif ($isNewRel == true && empty($isRelExists) != 1){
            $data['authorNameError'] =  'Такой автор уже есть в списке авторов книги.'.'<br>'.'Имя должно быть уникальным';
            $data['authorName'] = '';
        } else{
            $data;
        }
        return $data;
    }
}