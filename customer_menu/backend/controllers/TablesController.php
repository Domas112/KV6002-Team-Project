<?php
    require_once('../repositories/TablesRepository.php');

    class TablesController{
        private $tablesRepo;
        function __construct()
        {
            $this->tablesRepo = new TablesRepository();
        }

        function getAllTables(){
            $tables = $this->tablesRepo->selectAllTables();
            return json_encode($tables);
        }

        function postTable($tableRaw){
            $table = json_decode($tableRaw);
            
            $mappedTable = [
                "seatCount" => $table->seatCount,
                "VIP" => $table->VIP
            ];

            $this->tablesRepo->insertTable($mappedTable);
        }

        function deleteTable($id){
            $this->tablesRepo->deleteTable($id);
        }

        function updateTable($updatedTableRaw){
            $updatedTable = json_decode($updatedTableRaw);
            $mappedTable = array(
                "seatCount" => $updatedTable->seatCount,
                "VIP" => $updatedTable->VIP,
                "tableID" => $updatedTable->tableID,
            );
            $this->tablesRepo->updateTable($mappedTable);
        }

        function getAllTableIds(){
            $tableIds = $this->tablesRepo->selectAllTableIds();
            return json_encode($tableIds);
        }

    }
?>