<?php

class DishUIElement
{
    protected $resourceBasePath = FOODMENUMANAGEMENT_RESOURCEBASEPATH;
    protected $viewPath = FOODMENUMANAGEMENT_VIEWPATH;
    protected $addPath = FOODMENUMANAGEMENT_ADDPATH;
    protected $logPath = FOODMENUMANAGEMENT_LOGPATH;

    protected function generateHeader(){
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
                    <title>Food Menu Management</title>
                </head>
                <body>
EOT;
    }

    protected function generateFooter(){
        return <<<EOT
                    <footer class="container-fluid">
                        <hr>
                        <p>© Amaysia Restaurant | Food Menu Management | Developed by Teck Xun Tan</p>
                    </footer>
                </body>
            </html>
EOT;
    }

    protected function generateLogo(){
        return <<<EOT
        <div class="container-sm-logo">
            <img src="{$this->resourceBasePath}/assets/logo.png" alt="Amaysia Restaurant The Uniquely Asian" id="logo">
        </div>
EOT;
    }

    protected function generateNavigation(){
        return <<<EOT
        <div class="nav-container">
            <nav class="navbar navbar-expand-lg navbar-light">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href={$this->viewPath}>View All Dish</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href={$this->addPath}>Add New Dish</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href={$this->logPath}>System Log</a>
                        </li>
                    </ul>
                </div>
            </nav>
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
                    <span class="input-group-text" id="inputGroup-sizing-default">🔍 Search</span>
                </div>
                <input type="text" class="form-control" id='search' name='search' placeholder="Search anything here!">
            </div>
EOT;

    }

    protected function generatePageEntries(){
        return "<div id='page-entries'></div>";
    }

    protected function generatePageNavigator(){
        return <<<EOT
            <div class="container-fluid" id="page-navigator">
                <div id="pageNumber"></div>
                <div class="d-flex justify-content-center" id="pagination"></div>
            </div>
EOT;
    }

    protected function generateHorizontalLine(){
        return "<hr>";
    }

    protected function generateDishManageForm($mode){
        $dishForm = <<<EOT
            <form class='container-fluid' name='dishForm' method='post' enctype='multipart/form-data'>
                <div class='form-group'>
                    <label>Name:</label>
                    <input class='form-control' type='text' name='name' id='name' required>
                </div>
                <div class='form-group'>
                    <label>Description:</label>
                    <textarea class='form-control' name='description' id='description' required></textarea>
                </div>
                <div class='form-group'>
                    <label>Category:</label>
EOT;
        $dishForm .= $this->generateCategoryDropdown();
        $dishForm .= <<<EOT
                </div>
                <div class='form-group'>
                    <label>Image Path:</label>
                    <input class='form-control-file' type='file' name='imgPath'>
                </div>
                <hr>
                <div class='option'>
                    <input class="btn btn-lg" type='button' id='addOption' value='+ Add New Option'>
                    <hr>
                    {$this->generateHiddenInput($mode)}
                </div>
                <div>
                    <input class="btn btn-lg" type='submit' name='submit' id='submit' value='{$this->submitTextChange($mode)}'>
                </div>
            </form>
EOT;
        return $dishForm;
    }

    protected function generateConfirmation($confirmationFormName, $redirectPath){
        return <<<EOT
            <form name="$confirmationFormName" method="post">
                <input class='btn btn-sm' type="submit" name="yes" id='yes' value="Yes">
                <input class='btn btn-sm' type="button" name="no" id='no' value="No" onclick="location.href='$redirectPath';">
            </form>
EOT;

    }

    protected function generateCategoryDropdown(){
        $category = new CategoryDBHandler();
        $result = $category->retrieveAllCategory();
        $categoryDropdown = "<select class='form-control' name='category' id='category'>";
        foreach($result as $rows){
            $categoryDropdown .= "<option value='{$rows['categoryID']}'>{$rows['categoryName']}</option>";
        }
        $categoryDropdown .= "</select>";

        return $categoryDropdown;
    }

    protected function generateDataTable($tableName){
        return "<div class='container-fluid' id='$tableName'>Loading data...</div>";
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