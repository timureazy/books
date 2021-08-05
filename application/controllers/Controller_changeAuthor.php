<?php
namespace Controllers;
use Core\Controller;
use Core\Request;
use Core\View;
use Models\Author;
use Models\Model_changeAuthor;
use Repositories\AuthorRepository;
use Utils\Checker;

class Controller_changeAuthor extends Controller
{
    private $content = 'ChangeAuthor_view.php';
    private $template = 'Template_view.php';

    public function __construct()
    {
        $this->author = new Author();
        $this->authorRepository = new AuthorRepository();
        $this->view = new View();
        $this->checker =new Checker();
    }
    public function action_index()
    {
        $name = urldecode(Request::get('name'));
        $data['name'] = $name;
        $this->view->render($this->content, $this->template, $data);
    }
    public function action_change()
    {
        $data = [];
        if(Request::isPost()) {
            $data['authorName'] = Request::post('name');
            $data['oldName'] = Request::post('old_name');
        }
            $data['Errors'] = $this->checker->validateAuthor($data, false);
            if (!empty($data['Errors']['authorNameError'])) {
                $data['authorName'] = '';
                $this->view->render($this->content, $this->template, $data);
            } elseif (empty($data['Errors']['authorNameError'])) {
                $this->author->setName($data['authorName']);
                $this->author->setOldName($data['oldName']);
                $this->authorRepository->save($this->author, true);
               // $this->model->changeAuthor($data['authorName'], $data['oldName']);
                $data['successMessage'] = 'Автор '.$data['oldName']. ' изменен на '.$data['authorName'];
                $this->view->render($this->content, $this->template, $data);
            }
        }
}
