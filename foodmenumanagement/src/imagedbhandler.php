<?php

/**
 * imagedbhandler.php
 * The class will be used to handle the images database request such as uploading, updating, deleting, and retrieving.
 *
 * @author Teck Xun Tan W20003691
 */
class ImageDBHandler extends Database
{
    /**
     * uploadImage
     * A function to handle uploading new image to the Image table of the database
     */
    public function uploadImage($img){
        try {
            //Preparing query and parameter
            $query = "INSERT INTO image (imageData) VALUES (:img)";
            $parameter = ["img" => $img];

            //Execute the query
            if (!$this->executeSQL($query, $parameter)) {
                //Return false if SQL execution caught error and returned false
                return false;
            }

            //Return true if no error occurred
            return true;

        }catch(Exception $e){
            //Return false if exception has been caught
            return false;
        }
    }

    /**
     * deleteImage
     * A function to handle deleting image from the database
     */
    public function deleteImage($imgID){
        try {
            //Preparing query and parameter
            $query = "DELETE FROM image WHERE imageID = :id";
            $parameter = ["id" => $imgID];

            //Execute the query
            if (!$this->executeSQL($query, $parameter)) {
                //Return false if SQL execution caught error and returned false
                return false;
            }

            //Return true if no error occurred
            return true;

        }catch(Exception $e){
            //Return false if exception has been caught
            return false;
        }
    }

    /**
     * updateImage
     * A function to handle updating image that are stored in the database
     */
    public function updateImage($id, $img){
        try {
            //Preparing query and parameter
            $query = "UPDATE image SET imageData = :img WHERE imageID = :id";
            $parameter = ["img" => $img, "id" => $id];

            if (!$this->executeSQL($query, $parameter)) {
                //Return false if SQL execution caught error and returned false
                return false;
            }

            //Return true if no error occurred
            return true;

        }catch(Exception $e){
            //Return false if exception has been caught
            return false;
        }
    }

    /**
     * retrieveImageID
     * A function to retrieve specific imageID from the database
     */
    public function retrieveImageID($blob){
        try {
            //Preparing query and parameter
            $query = "SELECT MAX(imageID) AS imageID FROM image WHERE imageData = :data";
            $parameter = ["data" => $blob];

            //Execute the query
            $result = $this->executeSQL($query, $parameter)->fetch();

            if (!empty($result)) {
                //Return the result if result is not empty
                return $result[0];
            } else {
                //Return false if the result is empty or caught error
                return false;
            }

        }catch(Exception $e){
            //Return false if exception has been caught
            return false;
        }
    }
}