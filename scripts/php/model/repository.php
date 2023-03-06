<?php
//CONSTANTS
define("HOST", "localhost");
define("PORT", 3307);
define("DBNAME", "meta_commerce");
define("USER", "root");
define("PASSWORD", "pradopgworcnaz0");
    class Repository{
        static function getDB(){
            return new PDO("mysql:" 
            . "host=" . HOST . ";"
            . "port=" . PORT . ";" 
            . "dbname=" . DBNAME . ";"

            , USER, PASSWORD);
        }

        static function executePreparetedQuery($query, $values){
            $db = self::getDB();
            
            $statement = $db->prepare($query);
            $statement->execute($values);
    
            return $statement;
        }
    
        static function executeQuery($query){
            $db = self::getDB();
            
            $result = $db->query($query);
    
            return $result;
        }

        static function getGeneralDynamicPreparetedSelect($table, $columns, $logicOperators){
            $rawSelect="select * from " . $table . " where ";

            $whereString = $columns[0] . " = ?";
            for($index=1; $index<count($columns); $index++){
                $whereString = $whereString . " " . $logicOperators[$index-1] . " " . $columns[$index] . " = ?";
            }

            return $rawSelect . $whereString;
        }

        static function getDynamicGeneralInsert($table, $values){
            $insert = 'INSERT INTO ' . $table . " VALUES('" . $values . "')";
            return $insert;
        }

        static function fetchInObjectTemplate($statement, $class){
            $objectArray=array();
            while($row = $statement->fetchObject($class)){
                $objectArray[]=$row;
            }
            return $objectArray;
        }
        
        static function castObjectIntoArrayOfValuesFormattedForQuery(Object $obj){
            $arrayObj = (array) $obj;
            $values = implode("','", $arrayObj);
            return $values;
        }
    }
?>
