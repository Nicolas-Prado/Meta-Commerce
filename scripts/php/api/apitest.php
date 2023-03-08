<?php
    $arr = array('message', 'sugoma'); //etc

    /*$arr = array("nome_array"=>array(
        'message', 'sugoma'
    )); //etc*/

    header('HTTP/1.1 201 Created');
    echo json_encode($arr);
?>