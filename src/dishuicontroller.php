<?php

class DishUIController
{
    private $path;
    private $basepath = FOODMANAGEMENT_BASEPATH;

    public function __construct(){
        $this->setPath();
        if($this->path == "view"){
            $this->generateViewDishUI();
        }
        else if($this->path == "add"){
            $this->generateAddDishUI();
        }
        else if($this->path == "edit"){
            $this->generateEditDishUI();
        }
        else if($this->path == "delete"){
            $this->generateDeleteDishUI();
        }
    }

    //UI Generating Function
    private function generateViewDishUI(){
        $viewPage = $this->generateTitle("View All Dish");
        $viewPage .= $this->generateSubtitle("View and manage all available dish");
        $viewPage .= "<div id='dishDataTable'>Loading data...</div>";
        $viewPage .= "<script type='text/javascript' src='../js/retrieveAllDish.js'></script>";

        echo $viewPage;
    }

    private function generateAddDishUI(){
        $addPage = $this->generateTitle("Add New Dish");
        $addPage .= $this->generateSubtitle("Adding new dish into the system");
        $addPage .= $this->generateDishManageForm(null);

        echo $addPage;

        if(isset($_POST['submit'])){
            $dishDB = new DishDBHandler();

            $dish = new Dish(null,$_POST['name'],$_POST['description'],$_POST['category'],$this->uploadImage(),"1",$_POST['price']);
            $dishDB->addDish($dish);
        }
    }

    private function generateEditDishUI(){
        $editPage = $this->generateTitle("Edit Dish");
        $editPage .= $this->generateSubtitle("Editing dish information from the system");
        $editDish = "";
        if(isset($_GET['id'])){
            $editPage .= $this->generateDishManageForm();
            $editPage .= "<script type='text/javascript' src='../js/retrieveOneDish.js'></script>";
        }else{
            $editPage .= $this->generateSubtitle("No data has been selected!");
        }

        echo $editPage;
    }

    private function generateDeleteDishUI(){
        $deletePage = $this->generateTitle("Delete Dish");
        if(isset($_GET['id'])){
            $deletePage .= $this->generateSubtitle("Are you sure you want to delete this dish?");
            $deletePage .= $this->generateSubtitle("Selected dish ID: ".$_GET['id']);

            $deletePage .= <<<EOT
            <form name="deletionForm" method="post">
                <input type="submit" name="yes" value="Yes">
                <input type="button" name="no" value="No" onclick="location.href='/kv6002/dishmanagement.php/view';">
            </form>
EOT;
        }else{
            $deletePage .= $this->generateSubtitle("No data has been selected!");
        }


        echo $deletePage;

        if(isset($_POST['yes'])){
            $dishDB = new DishDBHandler();
            if($dishDB->deleteDish($_GET['id'])){
                header('Location: /kv6002/dishmanagement.php/view');
            };
        }
    }

    //UI Elements Function
    private function generateTitle($title){
        return "<h1>$title</h1>";
    }

    private function generateSubtitle($subtitle){
        return "<p>$subtitle</p>";
    }

    private function generateDishManageForm(){
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
                <input type="submit" name="submit" value="Add Dish">
            </form>
EOT;
        return $dishForm;
    }

    private function generateCategoryDropdown(){
        $category = new CategoryDBHandler();
        $result = $category->retrieveAllCategory();
        $categoryDropdown = "<select name=\"category\" id=\"category\">";
        foreach($result as $rows){
            $categoryDropdown .= "<option value=\"{$rows['categoryID']}\">{$rows['categoryName']}</option>";
        }
        $categoryDropdown .= "</select>";

        return $categoryDropdown;
    }

    //System Function
    private function uploadImage(){
        if(!is_uploaded_file($_FILES['imgPath']['tmp_name'])){
            return null;
        }else{
            $image = $_FILES['imgPath']['tmp_name'];
            return base64_encode(file_get_contents(addslashes($image)));
        }

        //Note:
        //Image could be retrieved using "<img width='200px' height='200px' src=\"data:image;base64,".$rows['testValue']."\"/>";
    }

    private function isSelected($retrievedCatID, $generatedCatID){
        if($retrievedCatID == $generatedCatID){
            return "selected";
        }else{
            return null;
        }
    }

    private function setValue($dishObj, $dataSelector){
        if($dishObj != null){
            switch($dataSelector){
                case "name":
                    return "value=\"{$dishObj->getDishName()}\"";
                case "description":
                    return $dishObj->getDishDescription();
                case "category":
                    return $dishObj->getDishCategory();
                case "ingredient":
                    return "value=\"{$dishObj->getDishIngredient()}\"";
                case "price":
                    return "value=\"{$dishObj->getDishPrice()}\"";
                default:
                    return null;
            }
        }else{
            return null;
        }
    }

    private function setPath(){
        $this->path = parse_url($_SERVER["REQUEST_URI"])['path'];
        $this->path = str_replace($this->basepath, "", $this->path);
        $this->path = trim($this->path,"/");
        $this->path = strtolower($this->path);
    }

    public function getPath(){
        return $this->path;
    }
}