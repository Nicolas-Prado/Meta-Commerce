<?php
    require_once "../../model/marketmodel.php";
    class MarketController{
        static function findMarketsByParameters($columns, $logicOperators, $values){
            return Market::findMarketsByParameters($columns, $logicOperators, $values);
        }
        
        static function insertIntoMarketsWithMarketObject(Market $market){
            return Market::insertIntoMarketsWithMarketObject($market);
        }
    }
?>