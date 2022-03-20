<?php
    require_once('../repositories/OrdersRepository.php');

    class OrdersController{
        private $ordersRepo;
        function __construct()
        {
            $this->ordersRepo = new OrdersRepository();
        }

        function postOrder($ordersRaw){
            $orders = json_decode($ordersRaw);
            foreach ($orders as $key => $order) {
                $orderAsArray = [
                    "dishID"=>$order->dishId,
                    "optionID"=>$order->optionId,
                    "amount"=>$order->amount
                ];
                $this->ordersRepo->insertOrder($orderAsArray);
            }
        }
    }
?>