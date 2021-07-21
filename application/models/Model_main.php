<?php
namespace Models;

    use Core\Model;
    use PDO;
    class Model_main extends Model {

            public function get_data($limitLeft, $limitRight)
            {
                $connection = $this->connect_to_db();
                $sql = "  SELECT group_concat(distinct a.name) as name, max(wi.public_date) as public_date, max(wi.genre) as genre, max(wi.id) as rel_id, book_name
                          FROM work_info wi
                          join rel_author_work raw on wi.id = raw.fid_work
                          join authors a on a.id = raw.fid_author
                          group by book_name
                          LIMIT :left, :right";
                $query = $connection->prepare($sql);
                $query->bindValue(":left", $limitLeft, PDO::PARAM_INT);
                $query->bindValue(":right", $limitRight, PDO::PARAM_INT);
                $query->execute();
                while($row = $query->fetch(PDO::FETCH_ASSOC)){
                    $res[$row['book_name']]=$row;
                }
                return $res;
            }

            public function count_all()
            {
                $connection = $this->connect_to_db();
                $sql = "SELECT count(*) as cnt
                          FROM work_info";
                $query = $connection->prepare($sql);
                $query->execute();
                $res = $query->fetch(PDO::FETCH_ASSOC);
                return $res;
            }
    }