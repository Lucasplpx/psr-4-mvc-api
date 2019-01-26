<?php
namespace Models;

use \Core\Model;
use \Models\Users;

class Photos extends Model {

    public function getRandomPhotos($per_page, $excludes = array()){
        $array = array();

        foreach($excludes as $k => $item){
            $excludes[$k] = intval($item);
        }

        if(count($excludes) > 0){
            $sql = "SELECT * FROM photos WHERE id NOT IN (".implode(',', $excludes).") ORDER by RAND() LIMIT ".$per_page;
        } else {
            $sql = "SELECT * FROM photos ORDER by RAND() LIMIT ".$per_page;       
        }
        $sql = $this->db->query($sql);

        if($sql->rowCount() > 0){
            $array = $sql->fetchAll(\PDO::FETCH_ASSOC);

            foreach($array as $k => $item){
                $array[$k]['url'] = BASE_URL.'media/photos/'.$item['url'];
                $array[$k]['like_count'] = $this->getLikeCount($item['id']);
                $array[$k]['comments'] = $this->getComments($item['id']);

            }
        }

        return $array;
    }

    public function getPhotosFromUser($id_user, $offset, $per_page){
        $array = array();

        $sql = "SELECT * FROM photos WHERE id_user = :id ORDER BY id DESC LIMIT ".$offset.",".$per_page;
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id_user);
        $sql->execute();

        if($sql->rowCount() > 0){
            $array = $sql->fetchAll(\PDO::FETCH_ASSOC);

            foreach($array as $k => $item){
                $array[$k]['url'] = BASE_URL.'media/photos/'.$item['url'];
                $array[$k]['like_count'] = $this->getLikeCount($item['id']);
                $array[$k]['comments'] = $this->getComments($item['id']);

            }

           
        }

        return $array;
    }

    public function getFeedCollection($ids, $offset, $per_page){
        $array = array();
        $users = new Users();

        if(count($ids) > 0){
            $sql = "SELECT * FROM photos 
            WHERE id_user IN (".implode(",", $ids).") 
            ORDER by id DESC
            LIMIT ".$offset.", ".$per_page;

            $sql = $this->db->query($sql);

            if($sql->rowCount() > 0){

                $array = $sql->fetchAll(\PDO::FETCH_ASSOC);

                foreach($array as $k => $item){
                    $user_info = $users->getInfo($item['id_user']);
                    $array[$k]['name'] = $user_info['name'];
                    $array[$k]['avatar'] = $user_info['avatar'] ;
                    $array[$k]['url'] = BASE_URL.'media/photos/'.$item['url'];

                    $array[$k]['like_count'] = $this->getLikeCount($item['id']);
                    $array[$k]['comments'] = $this->getComments($item['id']);
                }

            }
        }

        return $array;
    }

    public function getPhoto($id_photo){
        $array = array();

        $array = array();
        $users = new Users();

        $sql = "SELECT * FROM photos WHERE id = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id_photo);
        $sql->execute();

        if($sql->rowCount() > 0){

            $array = $sql->fetch(\PDO::FETCH_ASSOC);
        
            $user_info = $users->getInfo($array['id_user']);
            $array['name'] = $user_info['name'];
            $array['avatar'] = $user_info['avatar'];
            $array['url'] = BASE_URL.'media/photos/'.$array['url'];

            $array['like_count'] = $this->getLikeCount($array['id']);
            $array['comments'] = $this->getComments($array['id']);
            
        }
        return $array;
    }   

    public function getComments($id_photo){
        $array = array();

        $sql = "SELECT photos_comments.*, users.name FROM photos_comments LEFT JOIN users 
        ON users.id = photos_comments.id_user WHERE photos_comments.id_photo = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id_photo);
        $sql->execute();
        
        if($sql->rowCount() > 0){
            $array = $sql->fetchAll(\PDO::FETCH_ASSOC);
        }

        return $array;
    }

    public function getLikeCount($id_photo){
        $sql = "SELECT COUNT(*) as c FROM photos_likes WHERE id_photo = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id_photo);
        $sql->execute();
        $info = $sql->fetch();

        return $info['c'];
    }

    public function getPhotosCount($id_user){
        $sql = "SELECT COUNT(*) as c FROM photos WHERE id_user = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id_user);
        $sql->execute();
        $info = $sql->fetch();

        return $info['c'];
    }


    public function deleteAll($id){
        $sql = "DELETE FROM photos WHERE id_user = :id_user";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id_user", $id);
        $sql->execute();

        $sql = "DELETE FROM photos_comments WHERE id_user = :id_user";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id_user", $id);
        $sql->execute();

        $sql = "DELETE FROM photos_likes WHERE id_user = :id_user";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id_user", $id);
        $sql->execute();

    }
}