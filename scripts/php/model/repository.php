<?php
    class Repository{
        static function getDB(){
            return new PDO("mysql:host=localhost;port=3307;dbname=meta_commerce;", "root", "pradopgworcnaz0");
        }

        static function getDynamicGeneralSelect($table, $columns, $logicOperators){
            $rawSelect="select * from " . $table . " where ";

            $whereString = $columns[0] . " = ?";
            for($index=1; $index<count($columns); $index++){
                $whereString = $whereString . " " . $logicOperators[$index-1] . " " . $columns[$index] . " = ?";
            }

            return $rawSelect . $whereString;
        }

        static function fetchInObjectTemplate($statement, $class){
            $objectArray=array();
            while($row = $statement->fetchObject($class)){
                $objectArray[]=$row;
            }
            return $objectArray;
        }
    }
?>
