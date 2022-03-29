<?php

class DishUIElement
{
    protected function generateHeader(){
        return <<<EOT
        <!doctype html>
            <html lang="en">
                <head>
                    <meta charset="utf-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1">
                    <link rel="stylesheet" href="../css/dishmanagement.css">
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

    protected function generateNavigation(){
        return <<<EOT
        <nav class="navbar navbar-expand-sm" style="background-color: rgba(255, 229, 199, 0.5);">
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-item nav-link" href="../dishmanagement.php/view">View</a>
                    <a class="nav-item nav-link" href="../dishmanagement.php/add">Add Dish</a>
                    <a class="nav-item nav-link" href="../dishmanagement.php/log">Logging</a>
                </div>
            </div>
        </nav>
EOT;

    }

    protected function generateTitle($title){
        return "<h1>$title</h1>";
    }

    protected function generateSubtitle($subtitle){
        return "<p>$subtitle</p>";
    }

    protected function generateSearchBar(){
        return "Search: <input type='text' id='search' name='search'>";
    }

    protected function generatePageNavigator(){
        return <<<EOT
            <input type="button" name="next" value="Next">
            <span id="pageNumber"></span>
            <input type="button" name="previous" value="Previous">
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
        $sortByDropdown = "Sort By: <select name='sort' id='sort'>";
        for($i = 0; $i<count($sortList); $i++){
            $sortByDropdown .= "<option value='".$sortList[$i]."'>".$sortList[$i]."</option>";
        }
        $sortByDropdown .= "</select>";

        return $sortByDropdown;
    }

    protected function includeJavascript($scriptPath){
        return "<script type='text/javascript' src='".$scriptPath."'></script>";
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
}