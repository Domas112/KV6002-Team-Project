<?php

class DishUIController extends DishUIElement
{
    public function __construct($path){
        echo $this->generateHeader();
        echo $this->generateLogo();
        echo $this->generateNavigation();
        switch($path){
            case "view":
                $this->generateViewDishUI();
                break;
            case "add":
                $this->generateAddDishUI();
                break;
            case "edit":
                $this->generateEditDishUI();
                break;
            case "delete":
                $this->generateDeleteDishUI();
                break;
            case "availability":
                $this->generateAvailabilityUI();
                break;
            case "log":
                $this->generateLoggingUI();
                break;
        }
        echo $this->generateFooter();
    }

    //UI Generating
    private function generateViewDishUI(){
        $viewPage = $this->generateDiv(array(
            $this->generateTitle("View All Dish"),
            $this->generateSubtitle("View and manage all available dish"),
            $this->generateSearchBar(),
            $this->generateSortByDropdown(array(
                "dishID","dishName","dishDescription","dishCategoryID","dishAvailability"
            ))
        ),"container-fluid");
        $viewPage .= "<div class='container-fluid' id='dishDataTable'>Loading data...</div>";
        $viewPage .= $this->generatePageNavigator();
        $viewPage .= $this->includeJavascript($this->getResourceBasePath()."/js/pagination.js");
        $viewPage .= $this->includeJavascript($this->getResourceBasePath()."/js/retrieveDish.js");

        echo $viewPage;
    }

    private function generateAddDishUI()
    {
        $addPage = $this->generateTitle("Add New Dish");
        $addPage .= $this->generateSubtitle("Adding new dish into the system");
        $addPage .= $this->generateDishManageForm("add");
        $addPage .= $this->includeJavascript("../js/optionDynamicForm.js");

        echo $addPage;

        if (isset($_POST['submit'])) {
            $dishDB = new DishDBHandler();
            $dish = new Dish(null, $_POST['name'], $_POST['description'], $_POST['category'], $this->imageToBlob(), null, $this->checkEmptyOption("optionName"), $this->checkEmptyOption("optionPrice"));
            $dishDB->addDish($dish);
        }
    }

    private function generateEditDishUI(){
        $editPage = $this->generateTitle("Edit Dish");
        $editPage .= $this->generateSubtitle("Editing dish information from the system");
        if(isset($_GET['id'])){
            $editPage .= $this->generateDishManageForm("edit");
            $editPage .= $this->includeJavascript("js/optionDynamicForm.js");
            $editPage .= $this->includeJavascript("js/retrieveOneDish.js");
        }else{
            $editPage .= $this->generateSubtitle("No data has been selected!");
        }

        if(isset($_POST['submit'])){
            $dishDB = new DishDBHandler();
            $dish = new Dish($_GET['id'],$_POST['name'],$_POST['description'],$_POST['category'],$this->imageToBlob(),null,$this->checkEmptyOption("optionName"), $this->checkEmptyOption("optionPrice"));
            $dish->setRetrievedOption($this->checkEmptyOption("retrievedOption"));
            $dish->setRetrievedPrice($this->checkEmptyOption("retrievedPrice"));
            $dish->setRetrievedID($this->checkEmptyOption("retrievedID"));
            $dishDB->editDish($dish,$this->checkEmptyOption("removedOption"));
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
                <input type="button" name="no" value="No" onclick="location.href='../dishmanagement.php/view';">
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
                <input type="button" name="no" value="No" onclick="location.href='../dishmanagement.php/view';">
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

    private function generateLoggingUI(){
        $logPage = $this->generateDiv(array(
            $this->generateTitle("System Log"),
            $this->generateSubtitle("View all the changes made to the system"),
            $this->generateSearchBar(),
            $this->generateSortByDropdown(array(
                "logID","logTimestamp","userID","logDescription"
            ))
        ),"container-fluid");
        $logPage .= "<div class='container-fluid' id='logDataTable'>Loading data...</div>";
        $logPage .= $this->generatePageNavigator();
        $logPage .= $this->includeJavascript($this->getResourceBasePath()."/js/pagination.js");
        $logPage .= $this->includeJavascript($this->getResourceBasePath()."/js/retrieveLog.js");

        echo $logPage;
    }

    //Function
    private function imageToBlob(){
        if(!is_uploaded_file($_FILES['imgPath']['tmp_name'])){
            return 1;
        }else{
            $image = $_FILES['imgPath']['tmp_name'];
            return base64_encode(file_get_contents(addslashes($image)));
        }
    }

    private function checkEmptyOption($value){
        if($value == "optionName"){
            if(isset($_POST['optionName'])){
                return $_POST['optionName'];
            }else{
                return null;
            }
        }else if($value == "optionPrice"){
            if(isset($_POST['price'])){
                return $_POST['price'];
            }else{
                return null;
            }
        }else if($value == "retrievedOption"){
            if(isset($_POST['retrievedName'])){
                return $_POST['retrievedName'];
            }else{
                return null;
            }
        }else if($value == "retrievedPrice"){
            if(isset($_POST['retrievedPrice'])){
                return $_POST['retrievedPrice'];
            }else{
                return null;
            }
        }else if($value == "retrievedID"){
            if(isset($_POST['retrievedID'])){
                return $_POST['retrievedID'];
            }else{
                return null;
            }
        }else if($value == "removedOption"){
            if(isset($_POST['deletedOption'])){
                return $_POST['deletedOption'];
            }else{
                return null;
            }
        }
    }
}