<?php
class Order{
    public $orderID;
    public $tableID;
    public $dishName;
    public $optionName;
    public $amount;
    public $completed;
    public $viewed;
}

class OrderCustomerView extends Order{
    public $optionPrice;
}
?>