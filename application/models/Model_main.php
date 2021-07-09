<?php
namespace Models;

    use Core\Model;
    use PDO;
    class Model_main extends Model {

            public function get_data()
            {
                $connection = $this->connect_to_db();
                $sql = "SELECT a.name, a.patronymic, a.surname, wi.pages, wi.public_date, w.name as book_name, rwg.genre
                          FROM authors a
                          join rel_author_work raw on a.id = raw.fid_author
                          join works w on raw.fid_work = w.id
                          join rel_work_genre rwg on rwg.fid_work = w.id
                          join work_info wi on wi.fid_work = w.id";
                $query = $connection->prepare($sql);
                $query->execute();
                $res = $query->fetch(PDO::FETCH_ASSOC);
                return $res;
            }
    }