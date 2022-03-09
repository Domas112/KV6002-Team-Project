<?php

class DishUIController extends DishUIElement
{
    private $path;
    private $basepath = FOODMANAGEMENT_BASEPATH;

    public function __construct(){
        $this->setPath();
        if($this->path == "view"){
            $this->generateViewDishUI();
        }
        else if($this->path == "add"){
            $this->generateAddDishUI();
        }
        else if($this->path == "edit"){
            $this->generateEditDishUI();
        }
        else if($this->path == "delete"){
            $this->generateDeleteDishUI();
        }
        else if($this->path == "availability"){
            $this->generateAvailabilityUI();
        }
    }

    //UI Generating
    private function generateViewDishUI(){
        $viewPage = $this->generateTitle("View All Dish");
        $viewPage .= $this->generateSubtitle("View and manage all available dish");
        $viewPage .= "<div id='dishDataTable'>Loading data...</div>";
        $viewPage .= $this->includeJavascript("../js/retrieveAllDish.js");

        echo $viewPage;
    }

    private function generateAddDishUI(){
        $addPage = $this->generateTitle("Add New Dish");
        $addPage .= $this->generateSubtitle("Adding new dish into the system");
        $addPage .= $this->generateDishManageForm("add");

        echo $addPage;

        if(isset($_POST['submit'])){
            $dishDB = new DishDBHandler();
            $dish = new Dish(null,$_POST['name'],$_POST['description'],$_POST['category'],$this->imageToBlob(),"1",$_POST['price']);
            $dishDB->addDish($dish);
        }
    }

    private function generateEditDishUI(){
        $editPage = $this->generateTitle("Edit Dish");
        $editPage .= $this->generateSubtitle("Editing dish information from the system");
        if(isset($_GET['id'])){
            $editPage .= $this->generateDishManageForm("edit");
            $editPage .= $this->includeJavascript("../js/retrieveOneDish.js");
        }else{
            $editPage .= $this->generateSubtitle("No data has been selected!");
        }

        if(isset($_POST['submit'])){
            $dishDB = new DishDBHandler();
            $dish = new Dish($_GET['id'],$_POST['name'],$_POST['description'],$_POST['category'],$this->imageToBlob(),null,$_POST['price']);
            if($dishDB->editDish($dish)){
                header('Location: /kv6002/dishmanagement.php/view');
            }
        }

        echo $editPage;
    }

    private function generateDeleteDishUI(){
        $deletePage = $this->generateTitle("Delete Dish");
        if(isset($_GET['id'])){
            $deletePage .= $this->generateSubtitle("Are you sure you want to delete this dish?");
            $deletePage .= $this->generateSubtitle("Selected dish ID: ".$_GET['id']);

            $deletePage .= <<<EOT
            <form name="deletionForm" method="post">
                <input type="submit" name="yes" value="Yes">
                <input type="button" name="no" value="No" onclick="location.href='/kv6002/dishmanagement.php/view';">
            </form>
EOT;
        }else{
            $deletePage .= $this->generateSubtitle("No data has been selected!");
        }


        echo $deletePage;

        if(isset($_POST['yes'])){
            $dishDB = new DishDBHandler();
            if($dishDB->deleteDish($_GET['id'])){
                header('Location: /kv6002/dishmanagement.php/view');
            }
        }
    }

    private function generateAvailabilityUI()
    {
        $availabilityPage = $this->generateTitle("Change Dish Availability");
        if(isset($_GET['id'])){
            $availabilityPage .= $this->generateSubtitle("Are you sure you want to change the availability of the selected dish?");
            $availabilityPage .= $this->generateSubtitle("Selected dish ID: " . $_GET['id']);

            $availabilityPage .= <<<EOT
            <form name="deletionForm" method="post">
                <input type="submit" name="yes" value="Yes">
                <input type="button" name="no" value="No" onclick="location.href='/kv6002/dishmanagement.php/view';">
            </form>
EOT;
        }else{
            $availabilityPage .= $this->generateSubtitle("No data has been selected!");
        }

        echo $availabilityPage;

        if(isset($_POST['yes'])){
            $dishDB = new DishDBHandler();
            if($dishDB->updateDishAvailability($_GET['id'])){
                header('Location: /kv6002/dishmanagement.php/view');
            }
        }
    }

    //Conversion
    private function imageToBlob(){
        if(!is_uploaded_file($_FILES['imgPath']['tmp_name'])){
            return 1;
        }else{
            $image = $_FILES['imgPath']['tmp_name'];
            return base64_encode(file_get_contents(addslashes($image)));
        }
    }

    //Request
    private function setPath(){
        $this->path = parse_url($_SERVER["REQUEST_URI"])['path'];
        $this->path = str_replace($this->basepath, "", $this->path);
        $this->path = trim($this->path,"/");
        $this->path = strtolower($this->path);
    }
}