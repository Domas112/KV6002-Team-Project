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
        $this->executeSQL($query,$parameter);
    }

    public function retrieveImageID($blob){
        $query = "SELECT MAX(imageID) AS imageID FROM image WHERE imageData = :data";
        $parameter = ["data" => $blob];
        $result = $this->executeSQL($query,$parameter)->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $row){
            return $row['imageID'];
        }
    }
}