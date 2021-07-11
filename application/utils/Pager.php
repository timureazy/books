<?php
namespace Utils;

class Pager {

    public function drawPager($perPage, $totalItems)
    {
        $pages = ceil($totalItems / $perPage);
        if(isset($_GET['page']) || intval($_GET['page'] == 0)){
            $page = 1;
        } elseif (intval($_GET['page'] > $totalItems)){
            $page = $pages;
        } else {
            $page = $_GET['page'];
        }

        $pager =  "<nav aria-label='Page navigation'>";
        $pager .= "<ul class='pagination'>";
        $pager .= "<li class='page-item'><a class='page-link' href='/main?page=1' aria-label='Previous'><span aria-hidden='true'>«</span> Начало</a></li>";
        for($i=2; $i<=$pages-1; $i++) {
            $pager .= "<li class='page-item'><a class='page-link' href='/main?page=". $i."'>" . $i ."</a></li>";
        }
        $pager .= "<li><a class='page-link' href='/main?page=". $pages ."' aria-label='Next'>Конец <span aria-hidden='true'>»</span></a></li>";
        $pager .= "</ul>";

        return $pager;
    }

}