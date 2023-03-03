<?php
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

    static function findUsersByParameters($columns, $values){
        $rawSelect="SELECT * FROM user WHERE";

        $count=0;
        $select=" " . $columns[$count] . " = ?";
        foreach($columns as $column){
            $count++;
            $select= $select . " and " . $column . " = ?";
        }//paramos aqui! Arrumar

        parent::$db;

        $usersArray=array();
        while($row = $statement->fetch()){
            $usersArray[]=$row;
        }
        return $usersArray;
    }

    static function findEmployerByParameters($columns, $values){
        //parent::$db;
    }
}
?>