<?php
    require_once "../model/usermodel.php";
    function findUsersByParameters($columns, $values){
        return User::findUsersByParameters($columns, $values);
    }
?>