<?php
namespace Controllers;
use Core\Controller;
use Core\View;
use Models\Model_main;

class Controller_main extends Controller
{
    private $content = 'Main_view.php';
    private $template = 'Template_view.php';

    public function __construct()
    {
            $this->model = new Model_main();
            $this->view = new View();
    }

    public function action_index()
    {
            $data = $this->model->get_data();
            $this->view->generate($this->content, $this ->template, $data);
    }
}