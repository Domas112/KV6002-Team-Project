<?php

class UIElement
{
    protected $resourceBasePath = FOODMENUMANAGEMENT_RESOURCEBASEPATH;
    protected $viewPath = FOODMENUMANAGEMENT_VIEWPATH;
    protected $logPath = FOODMENUMANAGEMENT_LOGPATH;
    protected $errPath = ERROR_BASEPATH;

    /**
     * generateHeader
     *
     * To generate the header of the webpage.
     *
     * @visibility protected
     * @return string The generated header component
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
                    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css' integrity='sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T' crossorigin='anonymous'>
                    <link rel='stylesheet' href='https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css'>
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
     *
     * To generate the footer of the webpage.
     *
     * @visibility protected
     * @return string The generated footer component
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
     *
     * To generate the logo section of the webpage.
     *
     * @visibility protected
     * @return string The generated logo component
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
     *
     * To add the specified text in the parameter into the body as a
     * title using <h1> tag.
     *
     * @visibility protected
     * @param string $title The text to be added into the body as new title
     * @return string The generated title component
     */
    protected function generateTitle($title){
        return "<h1>$title</h1>";
    }

    /**
     * generateSubtitle
     *
     * To add the specified text in the parameter into the body as a
     * subtitle using <p> tag.
     *
     * @visibility protected
     * @param string $subtitle The text to be added into the body as new subtitle
     * @return string The generated subtitle component
     */
    protected function generateSubtitle($subtitle){
        return "<p>$subtitle</p>";
    }

    /**
     * generateHorizontalLine
     *
     * To generate a horizontal line using <hr>.
     *
     * @visibility protected
     * @return string The <hr> tag element
     */
    protected function generateHorizontalLine(){
        return "<hr>";
    }

    /**
     * generateDataTable
     *
     * @visibility protected
     * @param $tableName
     * @return string
     */
    protected function generateDataTable($tableName){
        return "<div class='container-fluid' id='$tableName'>Loading data...</div>";
    }

    /**
     * generateModal
     *
     * @visibility protected
     * @param $id
     * @param $title
     * @param $modalContent
     * @return string
     */
    protected function generateModal($id,$title,$modalContent){
        $labelID = $id . "Label";
        $modal = <<<EOT
            <!-- $title Modal -->
            <div class="modal fade" id="$id" tabindex="-1" aria-labelledby="$labelID" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="$labelID">$title</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                        </div>
                        <div class="modal-body">
EOT;
        for($i = 0; $i<count($modalContent); $i++){
            $modal .= $modalContent[$i];
        }
        $modal .= <<<EOT
                        </div>
                    </div>
                </div>
            </div>
EOT;

        return $modal;
    }

    /**
     * checkClass
     *
     * To check if a class has been provided to be included as an attribute
     *
     * This function is used to check if a class is provided, if the class parameter
     * is not null, it will add a 'class' attribute into the tags, as shown in the
     * example below.
     *
     * (Example code to generate a paragraph:)
     * public function addParagraph($text,$class){
     *      return "<p " . $this->checkClass($class) . ">$text</p>";
     * }
     *
     * (Result:)
     * <p class="main-container"></p> (with class provided)
     * <p></p> (without class provided / NULL)
     *
     * @visibility private
     * @param string $class The name of the class to a specific CSS
     * @return string This will return a class attribute or null if $class is NULL
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
     *
     * To create a division to wrap around HTML contents
     *
     * This function could be used to wrap division around contents.
     * (Example Code:)
     * generateDiv(
     *      array(
     *          addHeader("Hello World");
     *          addParagraph("Hello World 2");
     *      )
     * );
     *
     * (Result:)
     * <div>
     *      <h1>Hello World</h1>
     *      <p>Hello World 2</p>
     * </div>
     *
     * @visibility protected
     * @param array $containerContent accepting array of generated HTML contents
     * @param string $class The class of the div element
     * @return string This will return the generated division
     */
    protected function generateDiv(array $containerContent, $class){
        $div = "<div {$this->checkClass($class)}'>";
        for($i = 0; $i<count($containerContent); $i++){
            $div .= $containerContent[$i];
        }
        $div .= "</div>";

        return $div;
    }

    /**
     * includeJavascript
     *
     * @param $scriptPath
     * @return string
     */
    protected function includeJavascript($scriptPath){
        return "<script type='text/javascript' src='".$scriptPath."'></script>";
    }

    /**
     * getResourceBasePath
     *
     * @visibility protected
     * @return string
     */
    protected function getResourceBasePath(){
        return $this->resourceBasePath;
    }
}