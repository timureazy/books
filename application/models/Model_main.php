<?php
namespace Models;

    use Core\Model;
    use PDO;
    class Model_main extends Model {

            public function get_data($limit=5, $offset=0)
            {
                $connection = $this->connect_to_db();
                $sql = "SELECT raw.id, a.name, a.patronymic, a.surname, wi.pages, wi.public_date, w.name as book_name, rwg.genre
                          FROM authors a
                          join rel_author_work raw on a.id = raw.fid_author
                          join works w on raw.fid_work = w.id
                          join rel_work_genre rwg on rwg.fid_work = w.id
                          join work_info wi on wi.fid_work = w.id";
                $query = $connection->prepare($sql);
               /** $query->bindValue(":limit", $limit, PDO::PARAM_INT);
                $query->bindValue(":offset", $offset, PDO::PARAM_INT);**/
                $query->execute();
                while($row = $query->fetch(PDO::FETCH_ASSOC)){
                    $res[$row['id']] = $row;
                }
                return $res;
            }
    }