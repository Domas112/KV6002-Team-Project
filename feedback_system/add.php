<!-- Gokul Gampala @ Team 30 | w18031735 | Northumbria University | Team Project and Professionalism KV6002-->
<!-- Php code to insert values into the database table -->
<?php
class Add{

    private $name,$email,$rating,$review,$image,$suggestion,$nps;

    public function uploadFeedback($name,$email,$rating,$review,$image,$suggestion,$nps){
        include 'database_conn.php';
        if($name != null){
            $this->name = $name;
        }else{
            $this->name = "Anonymous"; //Displays name as anonymous if the user didn't enter the name.
        }

        if($email != null){
            $this->email = $email;
        }else{
            $this->email = "Not Provided by the customer"; //Displays email as not provided if the user didn't enter the email address.
        }

        $this->rating = $rating;
        $this->review = $review;
        $this->image = $image;
        $this->suggestion = $suggestion;
        $this->nps = $nps;

        $insertSQL =

            "INSERT INTO feedback(name, email, rating, review, image, suggestion, nps)
    VALUES('$this->name','$this->email','$rating','$review','$image','$suggestion','$nps')"; // Inserts the values into the respective tables

        $success = $dbConn->query($insertSQL);
        if($success){
            return true;
        }else{
            return false;
        }
    }
}
?>
