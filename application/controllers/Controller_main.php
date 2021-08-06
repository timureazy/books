<?php
namespace Controllers;
use Core\Controller;
use Core\View;
use Core\Request;
use Models\MainPage;
use Repositories\MainRepository;
use Utils\Pager;


class Controller_main extends Controller
{
    private $content = 'Main_view.php';
    private $template = 'Template_view.php';
    private $perPage = 10;

    public function __construct()
    {
            $this->mainPage = new MainPage();
            $this->mainRepository = new MainRepository();
            $this->view = new View();
            $this->pager = new Pager();
    }

    public function action_index()
    {
            $mainPage = $this->mainPage::create();
            $mainPage->setCurrentPage(intval(Request::get('page')));
            $this->mainRepository->countAll($mainPage);
            if($mainPage->currentPage > 1){$mainPage->currentPage--;};
            $this->mainRepository->getData($mainPage);
            $pagination = $this->pager->drawPager($mainPage->perPage, $mainPage->getCount());
            $mainPage->setPagination($pagination);
            $this->view->render($this->content, $this ->template, $mainPage->getData());
    }
}