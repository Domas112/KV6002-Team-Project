<?php

class DishUIElement
{
    protected function generateTitle($title){
        return "<h1>$title</h1>";
    }

    protected function generateSubtitle($subtitle){
        return "<p>$subtitle</p>";
    }

    protected function generateDishManageForm($mode){
        $dishForm = <<<EOT
            <form name="dishForm" method="post" enctype="multipart/form-data">
                <label>Name:</label>
                <input type="text" name="name" id="name" required><br>
                <label>Description:</label>
                <textarea name="description" id="description" required></textarea><br>
                <label>Category:</label>
EOT;
        $dishForm .= $this->generateCategoryDropdown();
        $dishForm .= <<<EOT
                <br>
                <label>Image Path:</label>
                <input type="file" name="imgPath"><br>
                <label>Price:</label>
                <input type="text" name="price" id="price" required><br>
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
}