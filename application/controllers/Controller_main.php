<?php
namespace Controllers;
use Core\Controller;
use Core\View;
use Core\Request;
use Models\Model_main;
use Utils\Pager;


class Controller_main extends Controller
{
    private $content = 'Main_view.php';
    private $template = 'Template_view.php';
    private $perPage = 10;

    public function __construct()
    {
            $this->model = new Model_main();
            $this->view = new View();
            $this->pager = new Pager();
    }

    public function action_index()
    {
            $currentPage = intval(Request::get('page'));
            $totalItems = $this->model->count_all();
            if($currentPage > 1){$currentPage--;};
            $data['items'] = $this->model->get_data($currentPage*$this->perPage, $this->perPage);
            $pagination = $this->pager->drawPager($this->perPage, $totalItems['cnt']);
            $data['pagination'] = $pagination;
            $this->view->render($this->content, $this ->template, $data);
    }
}