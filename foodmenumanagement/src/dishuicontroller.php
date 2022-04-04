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
            case "log":
                $this->generateLoggingUI();
                break;
        }
        echo $this->generateFooter();
    }

    //UI Generating
    private function generateViewDishUI(){
        $viewPage = $this->generateDiv(array(
            $this->generateTitle("View All Dishes"),
            $this->generateSubtitle("View and manage all available dishes"),
            $this->generateHorizontalLine(),
            $this->generateSearchBar(),
            $this->generateHorizontalLine()
        ),"container-fluid");
        $viewPage .= $this->generateAddButton();
        $viewPage .= $this->generateDataTable("dishDataTable");
        $viewPage .= $this->generatePageNavigator();
        $viewPage .= $this->generateModalAdd();
        $viewPage .= $this->generateModalEdit();
        $viewPage .= $this->generateModalDelete();
        $viewPage .= $this->generateModalAvailability();
        $viewPage .= $this->includeJavascript($this->getResourceBasePath()."/js/dataRetrieve.js");
        $viewPage .= $this->includeJavascript($this->getResourceBasePath()."/js/dynamicForm.js");
        $viewPage .= $this->includeJavascript($this->getResourceBasePath()."/js/dynamicModal.js");
        $viewPage .= $this->includeJavascript($this->getResourceBasePath()."/js/retrieveOneDish.js");
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

    private function generateLoggingUI(){
        $logPage = $this->generateDiv(array(
            $this->generateTitle("System Log"),
            $this->generateSubtitle("View all the changes made to the system"),
            $this->generateHorizontalLine(),
            $this->generateSearchBar(),
            $this->generateHorizontalLine()
        ),"container-fluid");
        $logPage .= $this->generateDataTable("logDataTable");
        $logPage .= $this->generatePageNavigator();
        $logPage .= $this->includeJavascript($this->getResourceBasePath()."/js/dataRetrieve.js");
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