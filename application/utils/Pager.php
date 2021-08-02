<?php
namespace Utils;
use Core\Request;
class Pager {

    public function drawPager($perPage, $totalItems)
    {
        $totalItems = intval($totalItems);
        $pages = ceil($totalItems / $perPage);
        if(Request::get('page') || intval(Request::get('page') === 0)){
            $page = 1;
        } elseif (intval(Request::get('page') > $totalItems)){
            $page = $pages;
        } else {
            $page = Request::get('page');
        }

        $pager =  "<nav aria-label='Page navigation'>";
        $pager .= "<ul class='pagination'>";
        $pager .= "<li class='page-item'><a class='page-link' href='/main' aria-label='Previous'><span aria-hidden='true'>«</span> Начало</a></li>";
        for($i=2; $i<=$pages-1; $i++) {
            $pager .= "<li class='page-item'><a class='page-link' href='/main?page=". $i."'>" . $i ."</a></li>";
        }
        $pager .= "<li><a class='page-link' href='/main?page=". $pages ."' aria-label='Next'>Конец <span aria-hidden='true'>»</span></a></li>";
        $pager .= "</ul>";

        return $pager;
    }

}