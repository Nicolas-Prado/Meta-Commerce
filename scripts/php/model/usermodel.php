<?php
require_once "repository.php";
class User extends Repository{
    private $pk_id_user;
    private $nm_user;
    private $cd_password;
    private $ds_email;
    private $dt_born;
    private $nm_img;
    private $cd_cep;
    private $ds_country;
    private $ds_state;
    private $ds_city;
    private $ds_address;
    private $nr_address;
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
        return $this->nm_user;
    } 

    public function getPassword(){
        return $this->cd_password;
    } 


    //DAO Methods
    private static function getUserDynamicPreparetedSelect($columns, $logicOperators){
        return parent::getGeneralDynamicPreparetedSelect('user', $columns, $logicOperators);
    }

    private static function getUserDynamicInsert($values){
        return parent::getDynamicGeneralInsert('user', $values);
    }

    private static function fetchInUserObject($statement){
        return parent::fetchInObjectTemplate($statement, 'user');
    }

    static function findUsersByParameters($columns, $logicOperators, $values){
        $select = self::getUserDynamicPreparetedSelect($columns, $logicOperators);

        $statement = parent::executePreparetedQuery($select, $values);

        $usersArray = self::fetchInUserObject($statement);

        return $usersArray;
    }

    static function insertIntoUsersWithUserObject(User $user){
        $values = parent::castObjectIntoArrayOfValuesFormattedForQuery($user);
        
        $insert = self::getUserDynamicInsert($values);

        return parent::executeQuery($insert);
    }

    /*
    static function findEmployerByParameters($columns, $values){
        //parent::$db;
    }*/
}
/*$count=0;
        $select=" " . $columns[$count] . " = ?";
        foreach($columns as $column){
            $count++;
            $select= $select . " and " . $column . " = ?";
        }//paramos aqui! Arrumar*/
?>


