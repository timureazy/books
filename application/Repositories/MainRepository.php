<?php

namespace Repositories;
use Core\Database;
use Models\MainPage;
use PDO;
    class MainRepository {

            public function getData(MainPage $mainPage): void
            {
                $connection = Database::getConnect();
                $sql = "  SELECT group_concat(distinct a.name) as name, max(wi.public_date) as public_date, max(wi.genre) as genre, max(wi.id) as rel_id, book_name
                          FROM work_info wi
                          join rel_author_work raw on wi.id = raw.fid_work
                          join authors a on a.id = raw.fid_author
                          group by book_name
                          LIMIT :left, :right";
                $query = $connection->prepare($sql);
                $query->bindValue(":left", $mainPage->currentPage*$mainPage->perPage, PDO::PARAM_INT);
                $query->bindValue(":right", $mainPage->perPage, PDO::PARAM_INT);
                $query->execute();
                while($row = $query->fetch(PDO::FETCH_ASSOC)){
                    $res[$row['book_name']]=$row;
                }
                $mainPage->setData($res);
            }

            public function countAll(MainPage $mainPage): MainPage
            {
                $connection = Database::getConnect();
                $sql = "SELECT count(*) as cnt
                          FROM work_info";
                $query = $connection->prepare($sql);
                $query->execute();
                $res = $query->fetch(PDO::FETCH_ASSOC);
                $mainPage->setCount($res);
                return $mainPage;
            }
    }