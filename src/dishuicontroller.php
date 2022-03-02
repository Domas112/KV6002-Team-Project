<?php

class DishUIController
{
    public function __construct($function)
    {
        if($function == "view"){
            $this->generateViewDish();
        }
        else if($function == "add"){
            $this->generateAddDish();
        }
    }

    private function generateViewDish(){
        $viewPage = <<<EOT
            <h1>View All Dish</h1>
            <p>View all available dishes</p>
EOT;
        $viewPage .= $this->generateDishTable();

        echo $viewPage;
    }

    private function generateAddDish(){
        $addPage = <<<EOT
            <h1>Add</h1>
            <form method="post">
                <label>Name:</label>
                <input type="text" name="name" id="name"><br>
                <label>Description:</label>
                <textarea name="description" id="description"></textarea><br>
                <label>Category:</label>
EOT;
        $addPage .= $this->generateCategoryDropdown();
        $addPage .= <<<EOT
                <br>
                <label>Ingredient:</label>
                <input type="text" name="ingredient" id="ingredient"><br>
                <label>Image Path:</label>
                <input type="text" name="imgPath" id="imgPath"><br>
                <label>Price:</label>
                <input type="text" name="price" id="price"><br>
                <input type="submit" value="Add Dish">
            </form>
EOT;

        echo $addPage;

        if(isset($_POST['value'])){
            $addDish = new DishDBHandler();
            $dish = new Dish();
            $dish->setDishName($_POST['value']);
            $addDish->addDish($dish);
        }
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
}