<?php

/**
 * uielement.php
 * This PHP script has been used to handle all the webpage elements such as creating title with <h1>, subtitle with <p>,
 * and more to minimise redundant code by reusing the code to generate elements necessary to the website and to keep the
 * code consistency over the pages.
 *
 * @author Teck Xun Tan W20003691
 */

class UIElement
{
    protected $resourceBasePath = FOODMENUMANAGEMENT_RESOURCEBASEPATH;
    protected $viewPath = FOODMENUMANAGEMENT_VIEWPATH;
    protected $logPath = FOODMENUMANAGEMENT_LOGPATH;
    protected $errPath = ERROR_BASEPATH;
    protected $adminPath = ADMINPANEL_BASEPATH;

    /**
     * generateHeader
     * To generate the header of the webpage.
     */
    protected function generateHeader($title){
        return <<<EOT
        <!doctype html>
            <html lang="en">
                <head>
                    <!-- Required meta tags -->
                    <meta charset="utf-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1">
                    
                    <!-- Importing CSS -->
                    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
                    <link rel='stylesheet' href='https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css'>
                    <link rel="stylesheet" type="text/css" href="https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css">
                    <link rel="stylesheet" href="{$this->resourceBasePath}/css/dishmanagement.css">
                    
                    <!-- Importing Scripts -->
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
                    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
                    
                    <!-- Title of the page -->
                    <title>$title</title>
                </head>
                <body>
EOT;
    }

    /**
     * generateFooter
     * To generate the footer of the webpage.
     */
    protected function generateFooter($footerTitle){
        return <<<EOT
                    <!-- Footer -->
                    <footer class="container-fluid">
                        <hr>
                        <p>© Amaysia Restaurant | $footerTitle | Developed by Teck Xun Tan</p>
                    </footer>
                </body>
            </html>
EOT;
    }

    /**
     * generateLogo
     * To generate the logo section of the webpage.
     */
    protected function generateLogo(){
        return <<<EOT
        <div class="container-sm-logo">
            <img src="{$this->resourceBasePath}/assets/logo.png" alt="Amaysia Restaurant The Uniquely Asian" id="logo">
        </div>
EOT;
    }

    /**
     * generateTitle
     * To add the specified text in the parameter into the body as a title using <h1> tag.
     */
    protected function generateTitle($title){
        return "<h1>$title</h1>";
    }

    /**
     * generateSubtitle
     * To add the specified text in the parameter into the body as a subtitle using <p> tag.
     */
    protected function generateSubtitle($subtitle){
        return "<p>$subtitle</p>";
    }

    /**
     * generateHorizontalLine
     * To generate a horizontal line using <hr>.
     */
    protected function generateHorizontalLine(){
        return "<hr>";
    }

    /**
     * generateDataTable
     * To generate a div for holding datatable.
     */
    protected function generateDataTable($tableName){
        return "<div class='container-fluid' id='$tableName'>Loading data...</div>";
    }

    /**
     * generateModal
     * To generate a modal and preset all the properties
     */
    protected function generateModal($id,$title,$modalContent){
        //Presetting the label ID variable
        $labelID = $id . "Label";

        //Generating the modal
        $modal = <<<EOT
            <!-- $title Modal -->
            <div class="modal fade" id="$id" tabindex="-1" aria-labelledby="$labelID" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="$labelID">$title</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
EOT;

        //Add each contents into the modal container
        for($i = 0; $i<count($modalContent); $i++){
            $modal .= $modalContent[$i];
        }

        //Generating closing tags for the modal
        $modal .= <<<EOT
                        </div>
                    </div>
                </div>
            </div>
EOT;

        //Return the generated modal
        return $modal;
    }

    /**
     * checkClass
     * This function is used to check if a class is provided, if the class parameter is not null, it will add a 'class'
     * attribute into the tags, as shown in the example below.
     */
    protected function checkClass($class){
        if($class != null){
            return "class='$class'";
        }else{
            return null;
        }
    }

    /**
     * generateDiv
     * To create a division to wrap around HTML contents
     */
    protected function generateDiv(array $containerContent, $class){
        //Generate the container and uses checkClass to check if a class property has been provided (Check checkClass function)
        $div = "<div {$this->checkClass($class)}'>";

        //Add each content provided into the container
        for($i = 0; $i<count($containerContent); $i++){
            $div .= $containerContent[$i];
        }

        //Generate the closing tag
        $div .= "</div>";

        //Return the generated container
        return $div;
    }

    /**
     * includeJavascript
     * To generate tags to include a JavaScript
     */
    protected function includeJavascript($scriptPath){
        return "<script type='text/javascript' src='".$scriptPath."'></script>";
    }

    /**
     * getResourceBasePath
     * A getter function to retrieve the resource base path
     */
    protected function getResourceBasePath(){
        return $this->resourceBasePath;
    }
}