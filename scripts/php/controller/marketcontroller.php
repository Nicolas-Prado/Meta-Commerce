<?php
    require_once "../model/marketmodel.php";
    require_once "../model/usermodel.php";
    require_once "usercontroller.php";

    class MarketController{
        static function findMarketsByParameters($columns, $logicOperators, $values){
            return Market::findMarketsByParameters($columns, $logicOperators, $values);
        }
        
        static function insertIntoMarketsWithMarketObject(Market $market){
            return Market::insertIntoMarketsWithMarketObject($market);
        }

        static function getEmployerMarkets($ds_email){
            $columns = array('ds_email');
            $logicOperators = array();
            $values = array($ds_email);

            $employer = UserController::findUsersByParameters($columns, $logicOperators, $values)[0];

            $columns = array('fk_id_user');
            $logicOperators = array();
            $values = array($employer->getPkIdUser());

            //Melhorar este metodo de receber os codigos? Como implementar isto de maneira mais generica possivel?
            $marketCodes = Market::findMarketsCodes();

            /*Logica de for construindo as columns com pk_id_market o quanto for necessario 
            pela quantidade de marketCodes. Alem disso, construir os logicOperators obviamente com 'OR' e por 
            fim os valores que receberemos do $marketCodes*/

            $markets = Market::findMarketsByParameters();
        }
    }
?>