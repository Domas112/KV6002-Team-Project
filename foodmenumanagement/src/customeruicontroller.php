<?php

/**
 * customeruicontroller.php
 * The class will be used to generate the appropriate webpage according to the path parameter received. For example,
 * if the path requested for 'menu' webpage, the class will call the generateMenuUI function to generate the food menu
 * webpage. The class is extended to CustomerUIElement class in reason to use the element generation function implemented
 * there (refer to customeruielement.php).
 *
 * @author Teck Xun Tan W20003691
 */
class CustomerUIController extends CustomerUIElement
{
    /**
     * Default constructor function to generate necessary header, logo and footer. The function also call the appropriate
     * function to generate the webpage UI depending on the path request received in the parameter.
     */
    public function __construct($path){
        //Generating the necessary components
        echo $this->generateHeader("Amaysia Restaurant Food Menu");
        echo $this->generateLogo();
        echo $this->generateNavigation();

        //Generate the appropriate UI depending to the path requested
        switch($path){
            case "menu":
                echo $this->generateMenuUI();
                break;
        }

        //Generate footer
        echo $this->generateFooter("Amaysia Restaurant Food Menu");
    }

    /**
     * generateMenuUI
     * The function is used to generate UI for path "menu" which is the Food Menu view for customer to view all
     * the dishes currently available in the restaurant without the requirement of logging in.
     */
    private function generateMenuUI(){
        //Generate the title and subtitle
        $menuPage = $this->generateDiv(array(
            $this->generateTitle("Amaysia Restaurant Food Menu"),
            $this->generateSubtitle("Take a look at the dishes available in our restaurant now!"),
            $this->generateHorizontalLine(),
        ),"container-fluid");

        //Generating the empty div to hold item later retrieved using JavaScript
        $menuPage .= $this->generateMenuItem("foodMenu");

        //Include all the necessary JavaScript
        $menuPage .= $this->includeJavascript($this->getResourceBasePath()."/js/retrieveMenuItem.js");
        $menuPage .= $this->includeJavascript($this->getResourceBasePath()."/js/dataRetrieve.js");
        $menuPage .= $this->includeJavascript($this->getResourceBasePath()."/js/pagination.js");

        //Return the generated UI
        return $menuPage;
    }
}