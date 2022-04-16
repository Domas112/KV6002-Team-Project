<?php

class ManagementUIController extends ManagementUIElement
{
    public function __construct($path){
        session_start();
        if(isset($_SESSION['username'])){
            if($_SESSION['accountType'] == 1){
                echo $this->generateHeader("Food Menu Management");
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
                echo $this->includeJavascript("../js/logout.js");
                echo $this->generateFooter("Food Menu Management");
            }else{
                header('Location: http://unn-w19030982.newnumyspace.co.uk/kv6002/error.php?error=403');
            }
        }else{
            header('Location: http://unn-w19030982.newnumyspace.co.uk/kv6002/error.php?error=401');
        }
    }

    //UI Generating
    private function generateViewDishUI(){
        $viewPage = $this->generateDiv(array(
            $this->generateDiv(array(
                $this->generateDiv(array(
                    $this->generateTitle("View All Dishes"),
                    $this->generateSubtitle("View all the available dishes here.")
                ),"title"),
                $this->generateDiv(array(
                    $this->generateAddButton()
                ),"add-button"),
            ),null),
            "<br style='clear:both;'>",
            $this->generateHorizontalLine(),
            $this->generateDiv(array(
                $this->generateSearchBar()
            ),"d-flex justify-content-end")
        ),"container-fluid");
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