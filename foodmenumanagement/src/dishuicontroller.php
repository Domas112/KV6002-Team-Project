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
            $this->generateHorizontalLine(),
            $this->generateSearchBar(),
            $this->generateHorizontalLine(),
            $this->generatePageEntries()
        ),"container-fluid");
        $viewPage .= $this->generateDataTable("dishDataTable");
        $viewPage .= $this->generatePageNavigator();
        $viewPage .= $this->includeJavascript($this->getResourceBasePath()."/js/pagination.js");
        $viewPage .= $this->includeJavascript($this->getResourceBasePath()."/js/retrieveDish.js");

        echo $viewPage;
    }

    private function generateAddDishUI()
    {
        $addPage = $this->generateDiv(array(
            $this->generateTitle("Add New Dish"),
            $this->generateSubtitle("Adding new dish into the system"),
            $this->generateHorizontalLine()
        ),"container-fluid");
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
        $editPage = $this->generateDiv(array(
            $this->generateTitle("Edit Dish"),
            $this->generateSubtitle("Editing dish information from the system"),
            $this->generateHorizontalLine()
        ),"container-fluid");
        if(isset($_GET['id'])){
            $editPage .= $this->generateDishManageForm("edit");
            $editPage .= $this->includeJavascript($this->getResourceBasePath()."/js/optionDynamicForm.js");
            $editPage .= $this->includeJavascript($this->getResourceBasePath()."/js/retrieveOneDish.js");
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
        $deletePage = $this->generateDiv(array(
            $this->generateTitle("Delete Dish"),
            $this->generateSubtitle("Deleting dish information from the system"),
            $this->generateHorizontalLine()
        ),"container-fluid");
        if(isset($_GET['id'])){
            $deletePage .= $this->generateDiv(array(
                $this->generateSubtitle("Are you sure you want to delete this dish?"),
                $this->generateSubtitle("Selected dish ID: ".$_GET['id']),
                $this->generateConfirmation("deletionForm",$this->viewPath)
            ),"container-fluid");
        }else{
            $deletePage .= $this->generateDiv(array(
                $this->generateSubtitle("No data has been selected!")
            ),"container-fluid");
        }

        echo $deletePage;

        if(isset($_POST['yes'])){
            $dishDB = new DishDBHandler();
            if($dishDB->deleteDish($_GET['id'])){
                header('Location: '.$this->viewPath);
            }
        }
    }

    private function generateAvailabilityUI()
    {
        $availabilityPage = $this->generateDiv(array(
            $this->generateTitle("Change Dish Availability"),
            $this->generateSubtitle("Changing the dish availability"),
            $this->generateHorizontalLine()
        ),"container-fluid");
        if(isset($_GET['id'])){
            $availabilityPage .= $this->generateDiv(array(
                $this->generateSubtitle("Are you sure you want to change the availability of the selected dish?"),
                $this->generateSubtitle("Selected dish ID: " . $_GET['id']),
                $this->generateConfirmation("availabilityForm",$this->viewPath)
            ),"container-fluid");
        }else{
            $availabilityPage .= $this->generateDiv(array(
                $this->generateSubtitle("No data has been selected!")
            ),"container-fluid");
        }

        echo $availabilityPage;

        if(isset($_POST['yes'])){
            $dishDB = new DishDBHandler();
            if($dishDB->updateDishAvailability($_GET['id'])){
                header('Location: '.$this->viewPath);
            }
        }
    }

    private function generateLoggingUI(){
        $logPage = $this->generateDiv(array(
            $this->generateTitle("System Log"),
            $this->generateSubtitle("View all the changes made to the system"),
            $this->generateHorizontalLine(),
            $this->generateSearchBar(),
            $this->generateHorizontalLine(),
            $this->generatePageEntries()
        ),"container-fluid");
        $logPage .= $this->generateDataTable("logDataTable");
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