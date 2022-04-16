<?php

/**
 * categorydbhandler.php
 * The class will be used to retrieve categories available on the database
 *
 * @author Teck Xun Tan W20003691
 */
class CategoryDBHandler extends Database
{
    /**
     * retrieveAllCategory
     * To retrieve all the available categories from the database
     */
    public function retrieveAllCategory(){
        try {
            //Preparing SQL query
            $query = "SELECT * FROM category";

            //Execute the SQL
            $result = $this->executeSQL($query)->fetchAll(PDO::FETCH_ASSOC);

            //Check if result is empty
            if (!empty($result)) {
                //Return the result
                return $result;

            } else {
                //Return false if empty
                return false;
            }
        }catch(Exception $e){
            //Return false if exception has been caught
            return false;
        }
    }
}