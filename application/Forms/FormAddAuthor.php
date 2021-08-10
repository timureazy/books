<?php


namespace Forms;


class FormAddAuthor
{
    public $authorName;

    public function load (array $data): void
    {
        foreach($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this -> $key = $value;
            }
        }
    }
}