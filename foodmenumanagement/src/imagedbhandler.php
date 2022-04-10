<?php
class ImageDBHandler extends Database
{
    public function uploadImage($img){
        try {
            $query = "INSERT INTO image (imageData) VALUES (:img)";
            $parameter = ["img" => $img];
            if ($this->executeSQL($query, $parameter)) {
                return true;
            } else {
                return false;
            }
        }catch(Exception $e){
            return false;
        }
    }

    public function deleteImage($imgID){
        try {
            $query = "DELETE FROM image WHERE imageID = :id";
            $parameter = ["id" => $imgID];
            if ($this->executeSQL($query, $parameter)) {
                return true;
            } else {
                return false;
            }
        }catch(Exception $e){
            return false;
        }
    }

    public function updateImage($id, $img){
        try {
            $query = "UPDATE image SET imageData = :img WHERE imageID = :id";
            $parameter = ["img" => $img, "id" => $id];
            if ($this->executeSQL($query, $parameter)) {
                return true;
            } else {
                return false;
            }
        }catch(Exception $e){
            return false;
        }
    }

    public function retrieveImageID($blob){
        try {
            $query = "SELECT MAX(imageID) AS imageID FROM image WHERE imageData = :data";
            $parameter = ["data" => $blob];
            $result = $this->executeSQL($query, $parameter)->fetch();
            if (!empty($result)) {
                return $result[0];
            } else {
                return false;
            }
        }catch(Exception $e){
            return false;
        }
    }
}