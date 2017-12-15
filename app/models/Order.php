<?php
/**
 * Created by PhpStorm.
 * User: michalkabionek
 * Date: 15.12.2017
 * Time: 18:31
 */

class Order extends Model {

    public function __construct(){
        parent::__construct();
    }


    public function all($user_id = ''){
        $query = "SELECT o.id, o.title, o.description, o.thumbnail, `status`, `url` FROM `order` o 
        INNER JOIN `item` on o.item_id = item.id 
        inner join item_category on item.category_id = item_category.id
        INNER JOIN item_type on item.type_id = item_type.id
        INNER JOIN order_status on o.status_id = order_status.id";
        if (!empty($user_id)){
            $query .= " WHERE `user_id` = :user_id";
        }

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function find_by_id($id){
        $query = "SELECT o.id as order_id, o.title, o.description, o.thumbnail, 
        `order_status`.`id` as status_id, `status`, `url`, `category`, `type`, d.username as `designer_name` FROM `order` o 
        INNER JOIN `item` on o.item_id = item.id 
        INNER JOIN item_category on item.category_id = item_category.id
        INNER JOIN item_type on item.type_id = item_type.id
        INNER JOIN order_status on o.status_id = order_status.id
        LEFT JOIN designer on o.designer_id = designer.id
        LEFT JOIN user d on designer.user_id = d.id
        WHERE o.id = :order_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":order_id", $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    public function get_all_categories(){
        $query = "SELECT * FROM item_category";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function get_all_types(){
        $query = "SELECT * FROM item_type";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function insert($data){
        if(empty($data['title']) || empty($data['info'])){
            $_SESSION['title'] = $data['title'];
            $_SESSION['info'] = $data['info'];
            $errors = [];
            if(empty($data['title'])){
                $errors[] = "Title cannot be blank";
            }
            if(empty($data['info'])){
                $errors[] = "Info cannot be blank";
            }
            $_SESSION['errors'] = $errors;
            return false;
        }else {
            $user_id = $_SESSION['user_id'];
            $status_id = 0; // pending
            $title = trim($data['title']);
            $thumbnail = "app/assets/img/img1.jpeg";
            $info = trim($data['title']);

            $this->db->beginTransaction();
            try {
                $query = "INSERT INTO item (`id`, `type_id`, `category_id`, `url`)
                                VALUES(null, :type_id , :category_id, null)";

                $stmt = $this->db->prepare($query);
                $stmt->bindParam(":type_id", $data['type']);
                $stmt->bindParam(":category_id", $data['category']);
                $stmt->execute();
                $item_id  = $this->db->lastInsertId();

                $query = "INSERT INTO `order` (`id`,`user_id`,`designer_id`,`status_id`, `item_id`,`title`,`thumbnail`,`description`,`info`)
                        VALUES(UUID(), :user_id, null, :status_id, :item_id, :title, :thumbnail, null, :info)";

                $stmt = $this->db->prepare($query);
                $stmt->bindParam(":user_id", $user_id);
                $stmt->bindParam(":status_id", $status_id);
                $stmt->bindParam(":item_id", $item_id);
                $stmt->bindParam(":title", $title);
                $stmt->bindParam(":thumbnail", $thumbnail);
                $stmt->bindParam(":info", $info);
                $stmt->execute();

                $this->db->commit();

                return true;
            }catch (PDOException $e){
                $this->db->rollback();
                throw $e;
            }
        }
    }

}