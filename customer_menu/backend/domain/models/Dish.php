<?php
    class Dish
    {
        public $id;
        public $title;
        public $description;
        public $price;
        public $imagePath;
        function __construct($id, $title, $description, $price, $imagePath){
            $this->id = $id;
            $this->title = $title;
            $this->description = $description;
            $this->price = $price;
            $this->imagePath = $imagePath;
        }
    }

?>