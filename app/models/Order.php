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

    public function find_all_by_designer($designer_id = ''){
        $query = "SELECT o.id as order_id, o.status_id, item_category.category, item_type.type, o.info, o.title, user.username FROM pai_project.`order` as o
        INNER JOIN `item` on o.item_id = item.id 
        INNER JOIN item_category on item.category_id = item_category.id
        INNER JOIN item_type on item.type_id = item_type.id
        INNER JOIN user on o.user_id = user.id";

        if (empty($designer_id)){
            $query .= " where designer_id is null";
            $stmt = $this->db->prepare($query);
        }else{
            $query .= " where designer_id = :designer_id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(":designer_id", $designer_id);
        }

        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function set_designer($order_id, $designer_id){
        $query = "UPDATE `pai_project`.`order`
                  SET `designer_id` = :designer_id
                  WHERE `id` = :order_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":designer_id", $designer_id);
        $stmt->bindParam(":order_id", $order_id);
        $stmt->execute();

        return $stmt->rowCount();
    }

    public function find_by_id($id){
        $query = "SELECT o.id as order_id,o.user_id, o.title, o.description, o.thumbnail, 
        `order_status`.`id` as status_id, `status`, `url`, `category`, `type`,item_id, d.username as `designer_name` FROM `order` o 
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

    public function update(){
        $order = $this->find_by_id($_POST['order_id']);

        $this->db->beginTransaction();
        try{
            $query = "UPDATE `item`
                  SET url = :url WHERE `id` = :item_id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(":url", $_POST['url']);
            $stmt->bindParam(":item_id", $order['item_id']);
            $stmt->execute();

            $query = "UPDATE `order`
                  SET `title` = :title, `thumbnail` = :thumbnail, `description` = :description
                  WHERE `id` = :order_id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(":title", $_POST['title']);
            $stmt->bindParam(":thumbnail", $_POST['thumbnail']);
            $stmt->bindParam(":description", $_POST['description']);
            $stmt->bindParam(":order_id", $_POST['order_id']);
            $stmt->execute();

            $this->db->commit();

            return true;
        }catch (PDOException $e){
            $this->db->rollback();
            throw $e;
        }
    }

    public function get_note($order_id){
        $query = "SELECT * FROM modification
                  Where item_id = (
                    SELECT item_id FROM `order`
                    WHERE id = :order_id
                  )";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":order_id", $order_id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    public function save_note($data){
        $order_id = $data['order_id'];
        $note = $data['note'];

        if ($result = $this->get_note($order_id)){
            // update
            $query = "UPDATE `modification`
                  SET `modification` = :note
                  WHERE `id` = :note_id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(":note", $note);
            $stmt->bindParam(":note_id", $result['id']);
            if ($stmt->execute()){
                return true;
            }else{
                return false;
            }
        }else {
            // insert
            $query = "INSERT INTO `modification` (`id`, `created_at`, `modification`, `item_id`)
                      VALUES (
                        null, 
                        now(), 
                        :note, 
                        (SELECT item_id FROM `order` where id = :order_id)
                      ) ";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(":note", $note);
            $stmt->bindParam(":order_id", $order_id);
            if ($stmt->execute()){
                return true;
            }else{
                return false;
            }
        }
    }

    public function accept($data){
        $order_id = $data['order_id'];
        $query = "UPDATE `order`
                  SET `status_id` = 1
                  WHERE `id` = :order_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":order_id", $order_id);
        if ($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

}