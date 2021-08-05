<?php

namespace Models;

class Book
{
    private $id;
    private $name;
    private $genre;
    private $publicDate;
    private $author;


    public static function create(...$data): Book
    {
        $book = new self();
        $book->name = $data[0]['bookName'];
        $book->genre = $data[0]['genre'];
        $book->publicDate = $data[0]['public_date'];
        $book->author = $data[0]['authorName'];
        return $book;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getDate()
    {
        return $this->publicDate;
    }

    public function getGenre()
    {
        return $this->genre;
    }

    public function getAuthor()
    {
        return $this->author;
    }


}
