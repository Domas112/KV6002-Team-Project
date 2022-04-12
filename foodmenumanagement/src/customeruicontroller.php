<?php

class CustomerUIController extends CustomerUIElement
{
    public function __construct($path){
        echo $this->generateHeader("Amaysia Restaurant Food Menu");
        echo $this->generateLogo();
        echo $this->generateNavigation();
        switch($path){
            case "menu":
                $this->generateMenuUI();
                break;
        }
        echo $this->generateFooter("Amaysia Restaurant Food Menu");
    }

    private function generateMenuUI(){
        $menuPage = $this->generateDiv(array(
            $this->generateTitle("Amaysia Restaurant Food Menu"),
            $this->generateSubtitle("Take a look at the dishes available in our restaurant now!"),
            $this->generateHorizontalLine(),
        ),"container-fluid");
        $menuPage .= $this->generateMenuItem("foodMenu");
        $menuPage .= $this->includeJavascript($this->getResourceBasePath()."/js/retrieveMenuItem.js");
        $menuPage .= $this->includeJavascript($this->getResourceBasePath()."/js/dataRetrieve.js");
        $menuPage .= $this->includeJavascript($this->getResourceBasePath()."/js/pagination.js");

        echo $menuPage;
    }
}