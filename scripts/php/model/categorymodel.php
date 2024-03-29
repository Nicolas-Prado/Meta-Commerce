<?php
require_once "repository.php";
class Category extends Repository
{
    const TABLE_NAME = "category";
    const PROPERTIES_NECESSITY_OF_SINGLE_QUOTES = array(
        FALSE,  //pk_id_category
        FALSE,  //fk_id_market
        TRUE,   //nm_category
        TRUE,   //ds_category
        TRUE,   //cd_color
        TRUE,   //dt_creation
        TRUE,   //dt_update
        TRUE    //ie_deleted
    );
    
    private $pk_id_category;
    private $fk_id_market;
    private $nm_category;
    private $ds_category;
    private $cd_color;
    private $dt_creation;
    private $dt_update;
    private $ie_deleted;

    //Contructors
    function __construct(array $array = null){
        if ($array != null) {
            foreach ($array as $key => $value) {
                $this->{$key} = $value;
            }
        }
    }

    //Getters and Setters
    function getPkIdCategory(){
        return $this->pk_id_category;
    }
    function getNmCategory(){
        return $this->nm_category;
    }
    function getDsCategory(){
        return $this->ds_category;
    }
    function getCdColor(){
        return $this->cd_color;
    }
    function getDtCreation(){
        return $this->dt_creation;
    }

    /*DAO Methods*/

    //Select
    private static function getDynamicSelect($where){
        return parent::getTemplateDynamicSelect("*", self::TABLE_NAME, $where);
    }
    public static function select($where){
        $select = self::getDynamicSelect($where);

        $statement = parent::executeQuery($select);

        $categoriesArray = self::fetchInModelObjectArray($statement);

        return $categoriesArray;
    }   

    //Insert
    private static function getDynamicInsert($values){
        return parent::getTemplateDynamicInsert(self::TABLE_NAME, $values, self::PROPERTIES_NECESSITY_OF_SINGLE_QUOTES);
    }
    public static function persist($values){
        $insert = self::getDynamicInsert($values);

        parent::executeQuery($insert);
    }

    //Update
    private static function getDynamicUpdate($columns, $values, $whereClause){
        return parent::getTemplateDynamicUpdate(self::TABLE_NAME, $columns, $values, $whereClause);
    }
    private static function update($columns, $values, $whereClause=null){
        $update = self::getDynamicUpdate($columns, $values, $whereClause);

        parent::executeQuery($update);
    }

    //Misc
    private static function fetchInModelObjectArray($statement){
        return parent::fetchInAnyObjectArray($statement, self::TABLE_NAME);
    }

}

?>
