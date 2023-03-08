<?php
require_once "../controller/marketcontroller.php";

getMarketsByEmail();

function getMarketsByEmail(){
    $ds_email = $_POST['email'];

    //Retorna algo como = ["nicolasaprado@gmail.com", "nicola@gmail.com"] tipo um json mesmo
    $markets = MarketController::getEmployerMarkets($ds_email);
    
    header('HTTP/1.1 200 Ok');
    echo json_encode($markets); 

    return $markets;
}

?>