<?php
class Order{
    public $orderID;
    public $tableID;
    public $dishName;
    public $optionName;
    public $amount;
    public $completed;
}

class OrderCustomerView extends Order{
    public $optionPrice;
}
?>