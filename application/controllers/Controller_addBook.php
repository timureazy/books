<?php
namespace Controllers;
use Core\Controller;
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
         if($_SERVER['REQUEST_METHOD'] == 'POST') {
             $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
         }
         $bookName = $_POST['bookName'];
         $authorName = $_POST['authorName'];
         $genre = $_POST['genre'];
         $public_date = $_POST['public_date'];
         $data['isAuthorExists'] = $this->checker->isAuthorExists($authorName);
         $data['isBookExists'] = $this->checker->isBookExists($bookName);
         if(empty($data['isAuthorExists'])){
             $data['authorError'] = 'Такого автора нет в базе авторов' . '<br>' . 'Сначала внесите автора в базу';
         } elseif (empty($data['isBookExists']) != 1){
             $data['bookError'] = 'Книга с таким названием уже есть' . '<br>' . 'Книги в списке должны быть уникальными';
         } else {
             $this->model->addBook($bookName, $public_date, $genre, $authorName);
         }
         $this->view->render($this->content, $this ->template, $data);
     }
}