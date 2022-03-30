<?php

class DishUIElement
{
    private $resourceBasePath = FOODMENUMANAGEMENT_RESOURCEBASEPATH;
    private $viewPath = FOODMENUMANAGEMENT_VIEWPATH;
    private $addPath = FOODMENUMANAGEMENT_ADDPATH;
    private $logPath = FOODMENUMANAGEMENT_LOGPATH;

    protected function generateHeader(){
        return <<<EOT
        <!doctype html>
            <html lang="en">
                <head>
                    <meta charset="utf-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1">
                    <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
                    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css' integrity='sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T' crossorigin='anonymous'>
                    <link rel="stylesheet" href="{$this->resourceBasePath}/css/dishmanagement.css">
                    <title>Dish Management</title>
                </head>
                <body>
EOT;
    }

    protected function generateFooter(){
        return <<<EOT
                </body>
            </html>
EOT;
    }

    protected function generateLogo(){
        return <<<EOT
        <div class='container-fluid'>
            <div class="container-sm-logo">
                <img src="{$this->resourceBasePath}/assets/logo.png" alt="Amaysia Restaurant The Uniquely Asian" id="logo">
            </div>
        </div>
EOT;
    }

    protected function generateNavigation(){
        return <<<EOT
        <div class='container-fluid'>
            <div class="nav-container">
                <nav class="navbar navbar-expand-md" style="background-color: rgba(239,183,26);">
                    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                        <ul class="navbar-nav">
                            <li><a class="nav-item nav-link" href={$this->viewPath}>View All Dish</a></li>
                            <li><a class="nav-item nav-link" href={$this->addPath}>Add New Dish</a></li>
                            <li><a class="nav-item nav-link" href={$this->logPath}>System Log</a></li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
EOT;

    }

    protected function generateTitle($title){
        return "<h1>$title</h1>";
    }

    protected function generateSubtitle($subtitle){
        return "<p>$subtitle</p>";
    }

    protected function generateSearchBar(){
        return <<<EOT
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Search</span>
                </div>
                <input type="text" class="form-control" id='search' name='search' aria-label="Default" aria-describedby="inputGroup-sizing-default place" placeholder="Search by ID or Name">
            </div>
EOT;

    }

    protected function generatePageNavigator(){
        return <<<EOT
            <div class="d-flex justify-content-center" id="page-navigator">
                <input type="button" class="btn btn-sm" name="previous" value="Previous">
                <span class='align-self-center' id="pageNumber"></span>
                <input type="button" class="btn btn-sm" name="next" value="Next">
            </div>
EOT;
    }

    protected function generateDishManageForm($mode){
        $dishForm = <<<EOT
            <form name="dishForm" method="post" enctype="multipart/form-data">
                <div id="dishForm-child">
                    <label>Name:</label>
                    <input type="text" name="name" id="name" required>
                </div>
                <div id="dishForm-child">
                    <label style="float:left">Description:</label>
                    <textarea name="description" id="description" required></textarea>
                </div>
                <div id="dishForm-child">
                    <label>Category:</label>
EOT;
        $dishForm .= $this->generateCategoryDropdown();
        $dishForm .= <<<EOT
                </div>
                <div id="dishForm-child">
                    <label>Image Path:</label>
                    <input type="file" name="imgPath">
                </div>
                <br><br>
                <div class="option">
                    <input type="button" id="addOption" value="Add New Option">
                    {$this->generateHiddenInput($mode)}
                </div>
                <br><br>
                <input type="submit" name="submit" value="{$this->submitTextChange($mode)}">
            </form>
EOT;
        return $dishForm;
    }

    protected function generateCategoryDropdown(){
        $category = new CategoryDBHandler();
        $result = $category->retrieveAllCategory();
        $categoryDropdown = "<select name=\"category\" id=\"category\">";
        foreach($result as $rows){
            $categoryDropdown .= "<option value=\"{$rows['categoryID']}\">{$rows['categoryName']}</option>";
        }
        $categoryDropdown .= "</select>";

        return $categoryDropdown;
    }

    protected function generateSortByDropdown($sortList){
        $sortByDropdown = <<<EOT
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Sort By</span>
                </div>
EOT;

        $sortByDropdown .= "<select class='custom-select' name='sort' id='sort'>";
        for($i = 0; $i<count($sortList); $i++){
            $sortByDropdown .= "<option value='".$sortList[$i]."'>".$sortList[$i]."</option>";
        }
        $sortByDropdown .= "</select></div>";

        return $sortByDropdown;
    }

    protected function generateDiv(array $containerContent, $class){
        $div = "<div {$this->checkClass($class)}'>";
        for($i = 0; $i<count($containerContent); $i++){
            $div .= $containerContent[$i];
        }
        $div .= "</div>";

        return $div;
    }

    protected function includeJavascript($scriptPath){
        return "<script type='text/javascript' src='".$scriptPath."'></script>";
    }

    protected function getResourceBasePath(){
        return $this->resourceBasePath;
    }

    private function submitTextChange($mode){
        if($mode == "add"){
            return "Add Dish";
        }else if($mode == "edit"){
            return "Edit Dish";
        }
    }

    private function generateHiddenInput($mode){
        if($mode == "add"){
            return null;
        }else if($mode == "edit"){
            return "<input type='hidden' id='deletedOption' name='deletedOption'>";
        }
    }

    private function checkClass($class){
        if($class != null){
            return "class='$class'";
        }else{
            return null;
        }
    }
}