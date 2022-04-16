<?php

/**
 * managementuielement.php
 *
 * PHP class to handle and generating webpage component for Food Menu Management subsystem (Customer View).
 *
 * This PHP script has been used to handle all the webpage component such as creating navigation bar and generating
 * <div> section. The purpose of this class is to minimise redundant code by reusing the code to generate elements
 * necessary to the website and to keep the code consistency over the pages. The class is extended to UIElement class
 * (refer to uielement.php) to reuse the shared elements that will also be used in other sites.
 *
 * @author Teck Xun Tan W20003691
 */
class CustomerUIElement extends UIElement
{
    /**
     * generateNav
     * To generate the navigation section of the webpage.
     */
    protected function generateNavigation(){
        //Generate the container for navbar
        $menuNavigation = <<<EOT
        <div class="nav-container">
            <nav class="navbar navbar-expand-lg navbar-light">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="http://unn-w19030982.newnumyspace.co.uk/kv6002/index.php">Back to Homepage</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="0">All</a>
                        </li>
EOT;

        //Retrieve the category available
        $categoryDB = new CategoryDBHandler();

        //Generate a new nav item for each item available in the retrieved result
        foreach($categoryDB->retrieveAllCategory() as $category){
            $menuNavigation .= <<<EOT
                        <li class="nav-item">
                            <a class="nav-link" id="{$category['categoryID']}">{$category['categoryName']}</a>
                        </li>
EOT;
        }

        //Generate the closing tag
        $menuNavigation .= <<<EOT
                    </ul>
                </div>
            </nav>
        </div>
EOT;

        //Return the generated navbar
        return $menuNavigation;
    }

    /**
     * generateMenuItem
     * To generate an empty div container that will be used to handle all the food item in the menu retrieved using
     * JavaScript (refer to retrieveMenuItem.js).
     */
    protected function generateMenuItem($menuClass){
        //Return the generated <div> container
        return "<div class='container-fluid' id='$menuClass'></div>";
    }
}