<?php
require_once "repository.php";
class Market extends Repository{
    private $pk_id_market;
    private $nm_market;
    private $ds_email;
    private $nm_img;
    private $dt_market_creation;
    private $ds_market;
    private $ie_status;
    private $dt_creation;
    private $dt_update;

//Contructors
function __construct(array $array = null) {
    if($array != null){
        foreach($array as $key => $value){
        $this->{$key} = $value;
        }
    }
}

//Getters and Setters
public function getNmUser(){
    return $this->nm_market;
} 

public function getEmail(){
    return $this->ds_email;
}

//DAO Methods
private static function getMarketDynamicPreparetedSelect($columns, $logicOperators){
    return parent::getGeneralDynamicPreparetedSelect('market', $columns, $logicOperators);
}

private static function getMarketDynamicInsert($values){
    return parent::getDynamicGeneralInsert('market', $values);
}

private static function fetchInMarketObject($statement){
    return parent::fetchInObjectTemplate($statement, 'market');
}

static function findMarketsByParameters($columns, $logicOperators, $values){
    $select = self::getMarketDynamicPreparetedSelect($columns, $logicOperators);

    $statement = parent::executePreparetedQuery($select, $values);

    $usersArray = self::fetchInMarketObject($statement);

    return $usersArray;
}

static function insertIntoMarketsWithMarketObject(Market $market){
    $values = parent::castObjectIntoArrayOfValuesFormattedForQuery($market);
    
    $insert = self::getMarketDynamicInsert($values);

    return parent::executeQuery($insert);
}

}
?>