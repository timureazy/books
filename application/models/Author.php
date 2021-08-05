<?php

namespace Models;

class Author
{

    private $id;
    private $name;
    private $oldName;

    public static function create($name)
    {
        $author = new self();
        $author->name = $name;
        return $author;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setOldName($name)
    {
        $this->oldName = $name;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getOldName()
    {
        return $this->name;
    }

}