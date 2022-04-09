<?php
require_once 'database.php';
class removeActive extends Database
{
    function removeActive(){
        $database = new Database();
        //makes the table active 0 
        $query = "UPDATE Tables 
        SET Active = '0'
        WHERE ID = {$_SESSION['table']}";
        $result = $database->executeSQL($query);
        return $result;
    }
}