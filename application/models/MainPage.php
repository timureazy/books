<?php
namespace Models;

class MainPage
{
    private $data = array();
    private $count;
    public $perPage = 10;
    public $currentPage;


    public static function create (): MainPage
    {
        $mainPage = new self();
        return $mainPage;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @param array $data
     */
    public function setData(array $data): void
    {
        $this->data['items'] = $data;
    }

    /**
     * @return mixed
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * @param mixed $count
     */
    public function setCount($count): void
    {
        $this->count = $count['cnt'];
    }


    public function setCurrentPage($currentPage): void
    {
        $this->currentPage = $currentPage;
    }


    public function setPagination(string $pagination): void
    {
        $this->data['pagination'] = $pagination;
    }

}