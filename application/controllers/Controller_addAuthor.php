<?php
namespace Controllers;
use Core\Controller;
use Core\Request;
use Core\View;
use Models\Author;
use Repositories\AuthorRepository;
use Utils\Checker;

class Controller_addAuthor extends Controller
{
    private $content = 'AddAuthor_view.php';
    private $template = 'Template_view.php';

    public function __construct()
    {
        $this->author = new Author();
        $this->repository = new AuthorRepository();
        $this->view = new View();
        $this->checker =new Checker();
    }
    public function action_index()
    {
        $this->view->render($this->content, $this ->template);
    }
    public function action_add()
    {
        if(Request::isPost()){
            $data = [
                'authorName' => Request::post('name'),
                'authorNameError' => ''
            ];
            $data['Errors'] = $this->checker->validateAuthor($data, true);
            if(!empty($data['Errors']['authorNameError'])){
                $data['authorName'] = '';
                $this->view->render($this->content, $this ->template, $data);
            }
            elseif(empty($data['Errors']['authorNameError'])){
                $author = $this->author::create($data['authorName']);
                $this->repository->save($author);
                $this->view->render($this->content, $this ->template, $data);
            }
        }
    }
    public function action_addAnother()
    {
        $data['action'] = 'addAnother';
        $data['book_id'] = Request::get('book');
        $this->view->render($this->content, $this ->template, $data);
    }
    public function action_addRel()
    {
        if(Request::isPost()){
            $data = [
                'authorName' => Request::post('name'),
                'bookId' => Request::post('book_id')
            ];
            $this->repository->getId($this->author);
            $data['authorId'] = $this->author->getId();
            $data['Errors'] = $this->checker->validateAuthor($data, false, true);
            if(!empty($data['Errors']['authorNameError'])){
                $data['authorName'] = '';
                $this->view->render($this->content, $this ->template, $data);
            }
            elseif(empty($data['Errors']['authorNameError'])){
                $this->repository->addRel($data['authorId']['id'], $data['bookId']);
                $data['action'] = 'addAnother';
                $this->view->render($this->content, $this ->template, $data);
            }
        }
    }
}
