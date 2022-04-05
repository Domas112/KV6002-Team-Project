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

    private function generateLoggingUI()
    {
        $logPage = $this->generateDiv(array(
            $this->generateTitle("System Log"),
            $this->generateSubtitle("View all the changes made to the system"),
            $this->generateHorizontalLine(),
            $this->generateSearchBar(),
            $this->generateHorizontalLine()
        ), "container-fluid");
        $logPage .= $this->generateDataTable("logDataTable");
        $logPage .= $this->generatePageNavigator();
        $logPage .= $this->generateModalLogDetail();
        $logPage .= $this->includeJavascript($this->getResourceBasePath() . "/js/dataRetrieve.js");
        $logPage .= $this->includeJavascript($this->getResourceBasePath()."/js/dynamicModal.js");
        $logPage .= $this->includeJavascript($this->getResourceBasePath() . "/js/retrieveLog.js");
        $logPage .= $this->includeJavascript($this->getResourceBasePath() . "/js/retrieveLogDetail.js");

        echo $logPage;
    }
}