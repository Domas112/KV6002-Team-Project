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
            $tableIds = $this->ordersRepo->selectAllTables();
            $orders = array();
            foreach ($tableIds as $key => $value) {
                $ordersOfTable = $this->ordersRepo->selectAllOrdersByTableId($value[0]);
                $orders[$value[0]] = $ordersOfTable;
            }
            return json_encode($orders);
        }

        function getAllTables(){
            $tables = $this->ordersRepo->selectAllTables();
            return json_encode($tables);
        }

        function getAllOrdersByTableId($id){
            $orders = $this->ordersRepo->selectAllOrdersByTableId($id);
            return json_encode($orders);
        }

        function completeOrder($orderID){
            $this->ordersRepo->completeOrder($orderID);
        }

        function deleteTable($tableID){
            $this->ordersRepo->deleteTable($tableID);
        }

        function viewOrder($tableID){
            $this->ordersRepo->viewOrder($tableID);
        }
    }
?>