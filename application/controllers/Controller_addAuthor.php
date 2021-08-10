<?php
namespace Controllers;
use Core\Controller;
use Core\Request;
use Core\View;
use Forms\FormAddAuthor;
use Models\Author;
use Repositories\AuthorRepository;
use Utils\Checker;

class Controller_addAuthor extends Controller
{
    private $content = 'AddAuthor_view.php';
    private $template = 'Template_view.php';
    private $contentNewAuthor = 'AddNewAuthor_view.php';

    public function __construct()
    {
        $this->repository = new AuthorRepository();
        $this->view = new View();
        $this->checker =new Checker();
    }

    public function action_index()
    {
        $this->view->render($this->contentNewAuthor, $this ->template);
    }

    public function action_add()
    {
        if(Request::isPost()) {

            $form = new FormAddAuthor();
            $form->load(Request::post());
            try {
                $this->checker->validateAuthorAdd($form->authorName, true);
                $author = Author::create($form->authorName);
                $this->repository->save($author);
            } catch (\Exception $exception) {
                $error = $exception->getMessage();
            }
            $this->view->render($this->contentNewAuthor, $this ->template, null, $form, $error);
        }

        }

    public function action_addAnother()
    {
        $bookId =  Request::get('book');
        echo $bookId;
        $this->view->render($this->content, $this ->template, $bookId);
    }

    public function action_addRel()
    {
        if(Request::isPost()){

            $form = new FormAddAuthor();
            $form->load(Request::post());
            $bookId = Request::post('book_id');
            try {
                $this->checker->validateAuthorAdd($form->authorName, false, true);
                $author = Author::create($form->authorName);
                $this->repository->getId($author);
                $this->repository->addRel($author, $bookId);
            } catch (\Exception $exception) {
                $error = $exception->getMessage();
            }
            $this->view->render($this->content, $this ->template, null, $form, $error);
        }
    }
}
