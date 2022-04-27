<?php

/**
 * managementuicontroller.php
 * The class will be used to control and generate the appropriate webpage according to the path parameter received.
 * For example, if the path requested for 'view' webpage, the class will call the generateViewDishUI function to
 * generate the view all dishes webpage. The class is extended to CustomerUIElement class in reason to use the element
 * generation function implemented there (refer to managementuielement.php).
 *
 * @author Teck Xun Tan W20003691
 */
class ManagementUIController extends ManagementUIElement
{
    /**
     * Default constructor function to generate necessary header, logo and footer. The function also call the appropriate
     * function to generate the webpage UI depending on the path request received in the parameter.
     */
    public function __construct($path){
        //Start the session
        session_start();
        ob_start();

        //Check if the user is logged in
        if(isset($_SESSION['username'])){

            //Check if user have the correct account type (1 = Admin, 2 = Chef)
            if($_SESSION['accountType'] == 1){
                //If user is logged in and have the correct account type, generate the webpage
                //Generating the necessary components
                echo $this->generateHeader("Food Menu Management");
                echo $this->generateLogo();
                echo $this->generateNavigation($path);

                //Generate the appropriate UI depending to the path requested
                switch($path){
                    case "view":
                        echo $this->generateViewDishUI();
                        break;
                    case "log":
                        echo $this->generateLoggingUI();
                        break;
                }

                //Include the necessary JavaScript
                echo $this->includeJavascript("../js/logout.js");

                //Generate footer
                echo $this->generateFooter("Food Menu Management");

            }else{
                //If the user doesn't have the correct account type, redirect to error page with error 403 (Not authorised)
                header('Location: http://unn-w19030982.newnumyspace.co.uk/kv6002/error.php?error=403');
            }
        }else{
            //If the user is not logged in, redirect to error page with error 401 (Not logged in)
            header('Location: http://unn-w19030982.newnumyspace.co.uk/kv6002/error.php?error=401');
        }
    }

    /**
     * generateViewDishUI
     * The function is used to generate UI for path "view" which is the View Dish view for administrator to view all
     * the dishes that have been added to the database.
     */
    private function generateViewDishUI(){

        $viewPage = $this->generateDiv(array(
            $this->generateDiv(array(
                //Generate the title and subtitle
                $this->generateDiv(array(
                    $this->generateTitle("View All Dishes"),
                    $this->generateSubtitle("View all the available dishes here.")
                ),"title"),

                //Generating the add new dish button
                $this->generateDiv(array(
                    $this->generateAddButton()
                ),"add-button"),

            ),null),

            //Adding the break tag to fix the problem with float
            "<br style='clear:both;'>",
            $this->generateHorizontalLine(),

            //Generating the search bar
            $this->generateDiv(array(
                $this->generateSearchBar()
            ),"d-flex justify-content-end")
        ),"container-fluid");

        //Generating the empty div to hold item later retrieved using JavaScript
        $viewPage .= $this->generateDataTable("dishDataTable");
        $viewPage .= $this->generatePageNavigator();

        //Generating the modals
        $viewPage .= $this->generateModalAdd();
        $viewPage .= $this->generateModalEdit();
        $viewPage .= $this->generateModalDelete();
        $viewPage .= $this->generateModalAvailability();

        //Include all the necessary JavaScript
        $viewPage .= $this->includeJavascript($this->getResourceBasePath()."/js/dataRetrieve.js");
        $viewPage .= $this->includeJavascript($this->getResourceBasePath()."/js/dynamicForm.js");
        $viewPage .= $this->includeJavascript($this->getResourceBasePath()."/js/dynamicModal.js");
        $viewPage .= $this->includeJavascript($this->getResourceBasePath()."/js/retrieveOneDish.js");
        $viewPage .= $this->includeJavascript($this->getResourceBasePath()."/js/retrieveDish.js");

        //Return the generated UI
        return $viewPage;
    }

    private function generateLoggingUI()
    {
        $logPage = $this->generateDiv(array(
            //Generate the title and subtitle
            $this->generateTitle("System Log"),
            $this->generateSubtitle("View all the changes made to the system"),
            $this->generateHorizontalLine(),

            //Generating the search bar
            $this->generateDiv(array(
                $this->generateSearchBar()
            ),"d-flex justify-content-end")
        ), "container-fluid");

        //Generating the empty div to hold item later retrieved using JavaScript
        $logPage .= $this->generateDataTable("logDataTable");
        $logPage .= $this->generatePageNavigator();

        //Generating the modal
        $logPage .= $this->generateModalLogDetail();

        //Include all the necessary JavaScript
        $logPage .= $this->includeJavascript($this->getResourceBasePath() . "/js/dataRetrieve.js");
        $logPage .= $this->includeJavascript($this->getResourceBasePath()."/js/dynamicModal.js");
        $logPage .= $this->includeJavascript($this->getResourceBasePath() . "/js/retrieveLog.js");
        $logPage .= $this->includeJavascript($this->getResourceBasePath() . "/js/retrieveLogDetail.js");

        //Return the generated UI
        return $logPage;
    }
}