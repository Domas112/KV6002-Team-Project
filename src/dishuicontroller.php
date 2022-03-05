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

    //UI Generating Function
    private function generateViewDishUI(){
        $viewPage = $this->generateTitle("View All Dish");
        $viewPage .= $this->generateSubtitle("View and manage all available dish");
        $viewPage .= $this->generateDishTable();

        echo $viewPage;
    }

    private function generateAddDishUI(){
        $addPage = $this->generateTitle("Add New Dish");
        $addPage .= $this->generateSubtitle("Adding new dish into the system");
        $addPage .= $this->generateDishManageForm(null);

        echo $addPage;

        if(isset($_POST['submit'])){
            $addNewDish = new DishDBHandler();
            $dish = new Dish(null,$_POST['name'],$_POST['description'],$_POST['category'],$_POST['ingredient'],$this->uploadImage(),"1",$_POST['price']);
            $addNewDish->addDish($dish);
        }
    }

    private function generateEditDishUI(){
        $editPage = $this->generateTitle("Edit Dish");
        $editPage .= $this->generateSubtitle("Editing dish information from the system");
        $editDish = "";
        if(isset($_GET['id'])){
            $retrieveDishData = new DishDBHandler();
            $result = $retrieveDishData->retrieveOneDish($_GET['id']);
            foreach($result as $row){
                $editDish = new Dish($row['dishID'],$row['dishName'],$row['dishDescription'],$row['dishCategoryID'],
                                 $row['dishIngredient'],$row['dishImg'],$row['dishAvailability'],$row['dishPrice']);
            }
            $editPage .= $this->generateDishManageForm($editDish);
        }else{
            $editPage .= $this->generateSubtitle("No data has been selected!");
        }

        echo $editPage;
    }

    //UI Elements Function
    private function generateTitle($title){
        return "<h1>$title</h1>";
    }

    private function generateSubtitle($subtitle){
        return "<p>$subtitle</p>";
    }

    private function generateDishTable(){
        //Generating table header
        $table = <<<EOT
            <table>
                <tbody>
                    <tr>
                        <th>Dish ID</th>
                        <th>Dish Name</th>
                        <th>Dish Description</th>
                        <th>Dish Category</th>
                        <th>Dish Price</th>
                        <th>Dish Image</th>
                        <th>Dish Availability</th>
                        <th>Management</th>
                    </tr>
EOT;

        //Initialise DB Handler
        $viewDish = new DishDBHandler();

        //Retrieve data from database
        $result = $viewDish->retrieveDish();

        //Append table with retrieved data
        foreach($result as $rows){
            $dish = new Dish($rows['dishID'],$rows['dishName'],$rows['dishDescription'],$rows['dishCategoryID'],$rows['dishIngredient'],$rows['dishImg'],$rows['dishAvailability'],$rows['dishPrice']);
            $table .= <<<EOT
                <tr>
                    <td>{$dish->getDishID()}</td>
                    <td>{$dish->getDishName()}</td>
                    <td>{$dish->getDishDescription()}</td>
                    <td>{$dish->getDishCategory()}</td>
                    <td>{$dish->getDishPrice()}</td>
                    <td><img width='auto' height='200px' src='data:image;base64,{$dish->getDishImg()}'/></td>
                    <td>{$this->availabilityInterpreter($dish->getDishAvailability())}</td>
                    <td>
                        <li><a href="/kv6002/dishmanagement.php/edit?id={$dish->getDishID()}">Edit</a></li>
                    </td>
                </tr>
EOT;
        }

        return $table;
    }

    private function generateDishManageForm($dish){
        $dishForm = <<<EOT
            <form name="dishForm" method="post" enctype="multipart/form-data">
                <label>Name:</label>
                <input type="text" name="name" {$this->setValue($dish, "name")} required><br>
                <label>Description:</label>
                <textarea name="description" required>{$this->setValue($dish, "description")}</textarea><br>
                <label>Category:</label>
EOT;
        $dishForm .= $this->generateCategoryDropdown($this->setValue($dish, "category"));
        $dishForm .= <<<EOT
                <br>
                <label>Ingredient:</label>
                <input type="text" name="ingredient" {$this->setValue($dish, "ingredient")} required><br>
                <label>Image Path:</label>
                <input type="file" name="imgPath"><br>
                <label>Price:</label>
                <input type="text" name="price" {$this->setValue($dish, "price")} required><br>
                <input type="submit" name="submit" value="Add Dish">
            </form>
EOT;
        return $dishForm;
    }

    private function generateCategoryDropdown($selected){
        $category = new CategoryDBHandler();
        $result = $category->retrieveAllCategory();
        $categoryDropdown = "<select name=\"category\" id=\"category\">";
        foreach($result as $rows){
            $categoryDropdown .= "<option value=\"{$rows['CategoryID']}\" {$this->isSelected($selected, $rows['CategoryID'])}>{$rows['CategoryName']}</option>";
        }
        $categoryDropdown .= "</select>";

        return $categoryDropdown;
    }

    //System Function
    private function uploadImage(){
        if(!empty($_FILES)){
            $image = $_FILES['imgPath']['tmp_name'];
            return base64_encode(file_get_contents(addslashes($image)));
        }else{
            return null;
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

    private function availabilityInterpreter($availability){
        if($availability == 1){
            return "Available";
        }else if($availability == 0){
            return "Not Available";
        }
    }
}