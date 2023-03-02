<?php
class User{
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

    static function selectUser($columns, $values){
        return "sus";
    }

    static function selectEmployer($columns, $values){
        return "sus";
    }
}
?>