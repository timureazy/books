<?php
namespace Controllers;
use Core\Controller;
use Core\Request;
use Core\View;
use Models\Model_changeBook;
use Utils\Checker;

class Controller_changeBook extends Controller
{
    private $content = 'ChangeBook_view.php';
    private $successPage = 'SuccessChange_view.php';
    private $template = 'Template_view.php';

    public function __construct()
    {
        $this->model = new Model_changeBook();
        $this->view = new View();
        $this->checker = new Checker();
    }

    public function action_index()
    {
        $id = intval(Request::get('book'));
        $data = $this->model->getBookById($id);
        $this->view->render($this->content, $this->template, $data);
    }

    public function action_change()
    {
        $id = intval(Request::get('book'));
        $old_data = $this->model->getBookById($id);
        $data = [];
        if(Request::isPost()) {
            $data = Request::post();
        }
            $authorNameValidation = "/[^а-яА-Я]+$/msiu";
            $bookNameValidation = "/[^а-яА-Я\s]+/msiu";
            $genreValidation = "/[^а-яА-Я\s]+/msiu";
            $authorsCnt = 0;
            foreach ($data["authorName"] as $value){
                if(empty($value) == false){
                    $authorsCnt++;}
                };
            foreach ($data['authorName'] as $value) {
                if (preg_match($authorNameValidation, $value)) {
                    $data['Error'] = "Имя автора должно содержать только кириллицу в верхнем или нижнем регистре";
                    $data['authorName'] = $old_data['name'];
                    $this->view->render($this->content, $this->template, $data);
                }
            };
            if($authorsCnt < 1){
                $data['Error'] = 'Имя автора не может быть пустым!';
                $this->view->render($this->content, $this->template, $data);
            }elseif (preg_match($bookNameValidation, $data['book_name']) || preg_match($genreValidation, $data['genre'])){
                $data['Error'] = 'Название книги или жанра должно содержать только кириллицу в верхнем или нижнем регистре';
                $data['authorName'] = $old_data['name'];
                $this->view->render($this->content, $this->template, $data);
            }
    try {
        $data_ = explode(',', $old_data['name']);
        $tmpArr = implode(',', $data['authorName']);
        $data__ = explode(',', $tmpArr);
        $cnt = count($data__);
        for ($i = 0; $i < $cnt; $i++) {
                if ($data__[$i] !== '') {
                    $isAuthorExists = $this->checker->isAuthorExists($data__[$i]);
                    if ($isAuthorExists) {
                        $authorId = $this->model->getAuthorId($data__[$i]);
                        $relId = $data['rel_id'];
                        $this->model->updateAuthor($authorId, $relId);
                }
                }elseif($data__[$i] === '') {
                        $tmp_name = $data_[$i];
                        $authorId = $this->model->getAuthorId($tmp_name);
                        $this->model->deleteAuthor($authorId['id'], $id);
                    }
                }
        $isBookExists = $this->checker->isBookExists($data['book_name']);
        if (empty($isBookExists)) {
            $this->model->updateBook($data['bookName'], $id);
        }
        $this->model->updateGenre($data['genre'], $id);
        $this->model->updatePublicDate($data['public_date'], $id);
        $this->view->render($this->successPage, $this->template);
    } catch (\Exception $e) {
            $data['Error'] = $e->getMessage();
            $data['authorName'] = $old_data['name'];
            $this->view->render($this->content, $this->template, $data);
    }
    }

}