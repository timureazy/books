<?php
namespace Controllers;
use Core\Controller;
use Core\View;
use Models\Model_changeAuthor;
use Utils\Checker;

class Controller_changeAuthor extends Controller
{
    private $content = 'ChangeAuthor_view.php';
    private $template = 'Template_view.php';

    public function __construct()
    {
        $this->model = new Model_changeAuthor();
        $this->view = new View();
        $this->checker =new Checker();
    }
    public function action_index()
    {
        $name = urldecode($_GET['name']);
        $data = $this->model->getAuthorByName($name);
        $this->view->render($this->content, $this->template, $data);
    }
    public function action_change()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'authorName' => $_POST['name'],
                'oldName' => $_POST['old_name'],
                'successMessage' => ''
            ];

            $data['Errors'] = $this->checker->validateAuthor($data, false);
            if (empty($data['Errors']['authorNameError']) == 0) {
                $data['authorName'] = '';
                $this->view->render($this->content, $this->template, $data);
            } elseif (empty($data['Errors']['authorNameError']) == 1) {
                $this->model->changeAuthor($data['authorName'], $data['oldName']);
                $data['successMessage'] = 'Автор '.$data['oldName']. ' изменен на '.$data['authorName'];
                $this->view->render($this->content, $this->template, $data);
            }
        }
    }
}
