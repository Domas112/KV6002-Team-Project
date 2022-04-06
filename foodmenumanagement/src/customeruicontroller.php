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
            $this->generateTitle("View All Dishes"),
            $this->generateSubtitle("View and manage all available dishes"),
            $this->generateHorizontalLine(),
        ),"container-fluid");
        $menuPage .= $this->includeJavascript($this->getResourceBasePath()."/js/retrieveMenuItem.js");

        echo $menuPage;
    }
}