<?php
    require_once "../../model/marketmodel.php";

    class MarketController{
        static function findMarketsByParameters($showColumns, $tables, $relationColumns, $logicOperators, $values){
            return Market::findMarketsByParameters($showColumns, $tables, $relationColumns, $logicOperators, $values);
        }
        
        static function insertIntoMarketsWithMarketObject(Market $market){
            return Market::insertIntoMarketsWithMarketObject($market);
        }

        static function getEmployerMarkets($id_user){
            return Market::getEmployerMarkets($id_user);
        }
    }
?>