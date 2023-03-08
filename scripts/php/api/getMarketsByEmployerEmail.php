<?php
    require_once "../controller/marketcontroller.php";
    require_once "../controller/usercontroller.php";

    $ds_email = $_POST['email'];

    $relationColumns = array('ds_email');
    $logicOperators = array();
    $values = array($ds_email);

    $employers = UserController::findUsersByParameters(null, null, $relationColumns, $logicOperators, $values);

    if (!empty($employers)) {
        $employer = $employers[0];

        $markets = MarketController::getEmployerMarkets($employer->getPkIdUser());

        header('HTTP/1.1 200 Ok');
        echo json_encode($markets);

        return $markets;
    } else {
        header('HTTP/1.1 200 Ok');
        echo json_encode('');
        return null;
    }
?>