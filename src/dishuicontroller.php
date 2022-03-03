<?php

class DishUIController
{
    public function __construct($function)
    {
        if($function == "view"){
            $this->generateViewDishUI();
        }
        else if($function == "add"){
            $this->generateAddDishUI();
        }
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
        $addPage .= $this->generateDishManageForm();
        echo $addPage;

        if(isset($_POST['submit'])){
//            if(!$this->checkEmptyForm()){
//                echo "Form filled!";
//            }else{
//                echo "Form could not be empty!";
//            }
            if(empty($_POST['description'])){
                echo "Empty!";
            }
//            $addDB = new DishDBHandler();
        }
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
                        <th>Dish Availability</th>
                    </tr>
EOT;

        //Initialise DB Handler
        $viewDish = new DishDBHandler();

        //Retrieve data from database
        $result = $viewDish->retrieveDish();

        //Append table with retrieved data
        foreach($result as $rows){
            $dish = new Dish($rows['dishID'],$rows['dishName'],$rows['dishDescription'],$rows['dishCategoryID'],$rows['dishIngredient'],$rows['dishImgPath'],$rows['dishAvailability'],$rows['dishPrice']);
            $table .= <<<EOT
                <tr>
                    <td>{$dish->getDishID()}</td>
                    <td>{$dish->getDishName()}</td>
                    <td>{$dish->getDishDescription()}</td>
                    <td>{$dish->getDishCategory()}</td>
                    <td>{$dish->getDishPrice()}</td>
                    <td>{$dish->getDishAvailability()}</td>
                </tr>
EOT;
        }

        return $table;
    }

    private function generateCategoryDropdown(){
        $category = new CategoryDBHandler();
        $result = $category->retrieveAllCategory();
        $categoryDropdown = "<select name=\"category\" id=\"category\">";
        foreach($result as $rows){
            $categoryDropdown .= "<option value=\"{$rows['CategoryID']}\">{$rows['CategoryName']}</option>";
        }
        $categoryDropdown .= "</select>";

        return $categoryDropdown;
    }

    private function generateDishManageForm(){
        $dishForm = <<<EOT
            <form name="dishForm" method="post" enctype="multipart/form-data">
                <label>Name:</label>
                <input type="text" name="name" required><br>
                <label>Description:</label>
                <textarea name="description" required></textarea><br>
                <label>Category:</label>
EOT;
        $dishForm .= $this->generateCategoryDropdown();
        $dishForm .= <<<EOT
                <br>
                <label>Ingredient:</label>
                <input type="text" name="ingredient" required><br>
                <label>Image Path:</label>
                <input type="file" name="imgPath"><br>
                <label>Price:</label>
                <input type="text" name="price" required><br>
                <input type="submit" name="submit" value="Add Dish">
            </form>
EOT;
        return $dishForm;
    }

    //System Function
    private function uploadImage(){
        $image = $_FILES['imgPath']['tmp_name'];
        return base64_encode(file_get_contents(addslashes($image)));

        //Note:
        //Image could be retrieved using "<img width='200px' height='200px' src=\"data:image;base64,".$rows['testValue']."\"/>";
    }

    private function checkEmptyForm(){
        if(empty($_POST['name']) || empty($_POST['description'] || empty($_POST['ingredient']) || empty($_POST['price']) || empty($_FILES['imgPath']['name']))){
            echo true;
        }else{
            echo false;
        }
    }

}