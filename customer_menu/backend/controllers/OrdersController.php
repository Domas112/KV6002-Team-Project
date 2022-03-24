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
                    "amount"=>$order->amount,
                    "tableID"=>$order->tableId
                ];
                $this->ordersRepo->insertOrder($orderAsArray);
            }
        }

        function getAllOrders(){
            $tableIds = $this->ordersRepo->selectAllTableIds();
            $orders = array();
            foreach ($tableIds as $key => $value) {
                $ordersOfTable = $this->ordersRepo->selectAllOrdersByTableId($value[0]);
                $orders[$value[0]] = $ordersOfTable;
            }
            return json_encode($orders);
        }

        function getAllOrdersByTableId($id){
            $orders = $this->ordersRepo->selectAllOrdersByTableId($id);
            return json_encode($orders);
        }

        function completeOrder($orderID){
            $this->ordersRepo->completeOrder($orderID);
        }
    }
?>