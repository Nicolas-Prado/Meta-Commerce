<?php
    require_once "../model/usermodel.php";
    class UserController{

        static function findUsersByParameters($columns, $logicOperators, $values){
            return User::findUsersByParameters($columns, $logicOperators, $values);
        }
        
    }
?>