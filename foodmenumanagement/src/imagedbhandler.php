<?php
class ImageDBHandler extends Database
{
    public function uploadImage($img){
        $query = "INSERT INTO image (imageData) VALUES (:img)";
        $parameter = ["img" => $img];
        if($this->executeSQL($query,$parameter)){
            return true;
        }else{
            return false;
        }
    }

    public function deleteImage($imgID){
        $query = "DELETE FROM image WHERE imageID = :id";
        $parameter = ["id" => $imgID];
        if($this->executeSQL($query,$parameter)){
            return true;
        }else{
            return false;
        }
    }

    public function updateImage($id, $img){
        $query = "UPDATE image SET imageData = :img WHERE imageID = :id";
        $parameter = ["img" => $img, "id" => $id];
        if($this->executeSQL($query,$parameter)){
            return true;
        }else{
            return false;
        }
    }

    public function retrieveImageID($blob){
        $query = "SELECT MAX(imageID) AS imageID FROM image WHERE imageData = :data";
        $parameter = ["data" => $blob];
        $result = $this->executeSQL($query,$parameter)->fetch();
        if(!empty($result)){
            return $result[0];
        }else{
            return false;
        }
    }
}