<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);

//CONSTANTS
define("MARKETS_IMG_LOCAL", "/../../../../resources/marketsimg/");

require_once '../../controller/marketcontroller.php';
require_once '../../controller/usercontroller.php';
require_once '../../controller/genericcontroller.php';

if (isset($_POST['submit'])) {
    if (isValidEmail(htmlentities($_POST['ds_email']))) {
        unset($_POST['submit']);

        $user = getUser();

        insertIntoMarket();

        $market = getMarket();

        insertIntoMarketEmployerRelation($user, $market);

        header('Location: marketlogin.php');
        die();
    } else {
        echo "<p id=\"error\">Invalid email or already in use!</p>";
    }
}

function findMarketByEmail($email){
    $whereClause = "ds_email = " . "'" . $email . "'" . " and " . "ie_deleted = 'NO'";
    return MarketController::select($whereClause);
}
function isValidEmail($email){
    return filter_var($email, FILTER_VALIDATE_EMAIL) && empty(findMarketByEmail($email));
}
function manageImgFromForm($email){
    // Here we have an weakness for DoS attack, because i dont limit the size of archive sended from form

    // Exit if no file uploaded
    if ($_FILES['image']['name'][0] == "") {
        die('No file uploaded.');
    }

    // Get reference to uploaded image
    $image_file = $_FILES['image'];

    // Exit if is not a valid image file
    $image_type = exif_imagetype($image_file["tmp_name"]);
    if (!$image_type) {
        die('Uploaded file is not an image.');
    }

    // Generate img name
    $image_name = "img" . $email . substr($image_file["name"], strrpos($image_file["name"], '.'), strlen($image_file["name"]) - 1);

    // Move the file his correct place
    move_uploaded_file(
        $image_file["tmp_name"],
        __DIR__ . MARKETS_IMG_LOCAL . $image_name
    );

    return $image_name;
}
function insertIntoMarket(){
    $imgName = manageImgFromForm($_POST['ds_email']);

    $_POST['pk_id_market'] = 0;

    $_POST['nm_img'] = $imgName;

    $_POST['ds_market'] = '';

    $_POST['ie_status'] = 'Active';

    $_POST['dt_creation'] = date('Y-m-d');
    $_POST['dt_update'] = date('Y-m-d');
    $_POST['ie_deleted'] = "NO";

    $market = new Market($_POST);

    MarketController::persist($market);

    return $market;
}
function getUser(){
    $ds_email = $_POST['ds_email_user'];
    $cd_password = $_POST['cd_password'];

    $whereClause = "ds_email = " . "'" . $ds_email . "'" . " and " . "cd_password = " . "'" . $cd_password . "'" . " and " . "ie_deleted = 'NO'";

    $users = UserController::select($whereClause);

    unset($_POST['ds_email_user']);
    unset($_POST['cd_password']);

    return $users[0];
}
function getMarket(){
    $nm_market = $_POST['nm_market'];

    $whereClause = "nm_market = " . "'" . $nm_market . "'" . " and " . "ie_deleted = 'NO'";

    $markets = MarketController::select($whereClause);

    return $markets[0];
}

function insertIntoMarketEmployerRelation($user, $market){
    $employer = new stdClass();

    $employer->pk_employer_relation = 0;
    $employer->fk_id_user = $user->getPkIdUser();
    $employer->fk_id_market = $market->getPkIdMarket();
    $employer->ds_role = "'Boss'";
    $employer->dt_hiring = "'" . date('Y-m-d') . "'";
    $employer->vl_salary = 0;
    $employer->dt_creation = "'" . date('Y-m-d') . "'";
    $employer->dt_update = "'" . date('Y-m-d') . "'";
    $employer->ie_deleted = "'NO'";

    GenericController::persist("employer", $employer);
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Market Register</title>
    <link rel="stylesheet" href="../../../../styles/style.css">
    <link rel="stylesheet" href="../../../../styles/button.css">
    <link rel="stylesheet" href="../../../../styles/input.css">
    <link rel="stylesheet" href="../../../../styles/forminput.css">
    <link rel="stylesheet" href="../../../../styles/defaultimgpicker.css">
    <link rel="stylesheet" href="../../../../styles/defaultregister.css">
    <link rel="stylesheet" href="../../../../styles/marketregister.css">
</head>

<body>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
        <div class="register-header">
            <p>Market Register</p>
        </div>

        <div class="user-selector">
            <div class="input-wrapper">
                <label for="ds_email_user">Boss User: </label>
                <input type="text" name="ds_email_user" id="ds_email_user">
            </div>
          
            <div class="input-wrapper">
                <label for="cd_password">Password: </label>
                <input type="password" name="cd_password" id="cd_password">
            </div>
        </div>

        <div class="market-inputs">
            <div class="img-wrapper">
                <label class="image-choicer" for="image">
                    <img src="" alt="">
                    <p id="new-img">+</p>
                </label>
                <input type="file" name="image" id="image" accept="image/*" onchange="previewFile(this);">
            </div>

            <div class="input-wrapper">
                <label for="nm_market">Market Name: </label>
                <input type="text" name="nm_market" id="nm_market">
            </div>

            <div class="input-wrapper">
                <label for="ds_email">Email: </label>
                <input type="text" name="ds_email" id="ds_email">
            </div>

            <div class="input-wrapper">
                <label for="dt_market_creation">Creation date: </label>
                <input type="date" name="dt_market_creation" id="dt_market_creation">
            </div>
        </div>

        <div class="submit-wrapper">
            <input class="btn" type="submit" name="submit" value="Submit">
        </div>
    </form>

    <script src="../../../javascript/defaultregister.js"></script>
</body>

</html>