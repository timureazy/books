<?php
/**
 * задел на будущее
 * хотел результаты некоторых запросов заносить в сессию,
 * чтобы повторно не обращаться к базе и все  работало быстрее,
 * но так не разобрался как это правильно сделать
 */

namespace Utils;


class Session extends \SessionHandler
{
    public static function start_session()
    {
        parent::open();
    }
}