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

        $viewDish = new DishDBHandler();
        var_dump($viewDish->retrieveDish());

        echo $viewPage;
    }

    private function generateAddDish(){

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

        return $table;
    }
}