<?php
namespace Controllers;
use Core\Controller;
use Core\View;
use Models\Model_main;
use Utils\Pager;

class Controller_main extends Controller
{
    private $content = 'Main_view.php';
    private $template = 'Template_view.php';
    private $perPage = 5;
    public function __construct()
    {
            $this->model = new Model_main();
            $this->view = new View();
            $this->pager = new Pager();
    }

    public function action_index()
    {

            $data['items'] = $this->model->get_data();
            $totalItems = count($data);
            $pagination = $this->pager->drawPager($this->perPage, $totalItems);
            $data['pagination'] = $pagination;
            $this->view->generate($this->content, $this ->template, $data);
    }
}