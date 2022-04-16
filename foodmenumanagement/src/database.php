<?php
/**
 * database.php
 * The class contains a few method to handle functionality for the database such as setting up the connection to the
 * database and executing the SQL query. The class will also be used to retrieve data
 * from the database or managing the database.
 *
 * @author Teck Xun Tan W20003691
 */
class Database
{
    private $connection;

    /**
     * A default constructor to set up the connection on default
     */
    public function __construct(){
        //Set the connection
        $this->setConnection();
    }

    /**
     * setConnection
     * The connection is set up using PDO. The method will also catch any error and throw an error if problem has
     * occurred.
     */
    public function setConnection(){
        try{
            //Start connecting to database using PDO
            $this->connection = new PDO("mysql:host=localhost;dbname=unn_w19030982", "unn_w19030982", "qwerty81");
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        }catch(PDOException $e){
            //Exit with error if PDOException has been caught
            echo "Database Connection Error: " . $e->getMessage();
            exit();
        }
    }

    /**
     * executeSQL
     * The method is used to execute the SQL query prepared along with the parameter if it is given.
     */
    public function executeSQL($sql, $params=[]){
        try{
            //Prepare the SQL
            $stmt = $this->connection->prepare($sql);

            //Bind and execute the query
            $stmt->execute($params);

            //Return the result
            return $stmt;

        }catch(PDOException $pdo){
            //Return false if PDOException are caught
            return false;
        }
    }
}