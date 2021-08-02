<?php
namespace Controllers;
use Core\Controller;
use Core\Request;
use Core\View;
use Models\Model_addBook;
use Utils\Checker;

class Controller_addBook extends Controller
{
     private $content = 'AddBook_view.php';
     private $template = 'Template_view.php';

     public function __construct()
     {
         $this->model = new Model_addBook();
         $this->view = new View();
         $this->checker = new Checker();
     }
     public function action_index()
     {
         $this->view->render($this->content, $this ->template);
     }
     public function action_add()
     {
         $data = [];
         if(Request::isPost()) {
             $data = Request::post();
         }
         $data['isAuthorExists'] = $this->checker->isAuthorExists($data['authorName']);
         $data['isBookExists'] = $this->checker->isBookExists($data['bookName']);
         if(empty($data['isAuthorExists'])){
             $data['authorError'] = 'Такого автора нет в базе авторов' . '<br>' . 'Сначала внесите автора в базу';
         } elseif (empty($data['isBookExists'])){
             $data['bookError'] = 'Книга с таким названием уже есть' . '<br>' . 'Книги в списке должны быть уникальными';
         } else {
             $this->model->addBook($data['bookName'], $data['public_date'], $data['genre'], $data['authorName']);
         }
         $this->view->render($this->content, $this ->template, $data);
     }
}