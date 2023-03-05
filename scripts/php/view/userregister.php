<?php

function findUserByEmail($email){
    $columns = array('ds_email');
    $logicalOperatores = array();
    $values = array($email);

    return User::findUsersByParameters($columns, $logicalOperatores, $values);
}
function isValidEmail($email){
    return filter_var($email, FILTER_VALIDATE_EMAIL) && empty(findUserByEmail($email));
}
function manageImgFromForm($email)
{
    // Here we have an weakness for DoS attack, because i dont limit the size of archive sended from form

    // Get reference to uploaded image
    $image_file = $_FILES['image'];

    // Exit if no file uploaded
    if (!isset($image_file)) {
        die('No file uploaded.');
    }

    // Exit if is not a valid image file
    $image_type = exif_imagetype($image_file["tmp_name"]);
    if (!$image_type) {
        die('Uploaded file is not an image.');
    }

    // Generate img name
    $image_name="img" .$email . substr($image_file["name"], strrpos($image_file["name"], '.'), strlen($image_file["name"]) - 1);

    // Move the file his correct place
    move_uploaded_file(
        $image_file["tmp_name"],
        __DIR__ . "/../../../resources/usersimg/" . $image_name
    );

    return $image_name;
}

if (isset($_POST['submit'])) {
    if(isValidEmail(htmlentities($_POST['ds_email']))){
        $imgName = manageImgFromForm($_POST['ds_email']);

        $_POST['pk_id_user'] = 0;
        //$_POST['nm_user'] = $;
        //$_POST['cd_password'] = $;
        //$_POST['ds_email'] = $;
        //$_POST['dt_born'] = $;
        $_POST['nm_img'] = $imgName;
        //$_POST['cd_cep'] = $;
        //$_POST['ds_country'] = $;
        //$_POST['ds_state'] = $;
        //$_POST['ds_city'] = $;
        //$_POST['ds_address'] = $;
        //$_POST['nr_address'] = $;
        $_POST['dt_creation'] = date('Y-m-d');
        $_POST['dt_update'] = date('Y-m-d');

        unset($_POST['submit']);

        $user = new User($_POST);

        //So mandar o user pra inserir e fim
    }

}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Register</title>
    <link rel="stylesheet" href="../../../styles/style.css">
</head>

<body>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
        <div id="image-container"></div>
        <!--pk_id_user preenchemos no db com auto_increment-->
        <label for="image">Image: </label>
        <input type="file" name="image" id="image" accept="image/*"><br>

        <label for="image">Name: </label>
        <input type="text" name="nm_user" id="nm_user" isvalid="false"><br>

        <label for="image">Password: </label>
        <input type="password" name="cd_password" id="cd_password"><br>

        <label for="image">Repeat password: </label>
        <input type="password" name="cd_password_repeat" id="cd_password_repeat"><br>

        <label for="image">Email: </label>
        <input type="text" name="ds_email" id="ds_email"><br>

        <label for="image">Birth date: </label>
        <input type="date" name="dt_born" id="dt_born"><br>

        <!--nm_img preenchemos no back-end-->

        <label for="image">Cep: </label>
        <input type="text" name="cd_cep" id="cd_cep"><br>

        <label for="image">Country: </label>
        <input type="text" name="ds_country" id="ds_country"><br>

        <label for="image">State: </label>
        <input type="text" name="ds_state" id="ds_state"><br>

        <label for="image">City: </label>
        <input type="text" name="ds_city" id="ds_city"><br>

        <label for="image">Address: </label>
        <input type="text" name="ds_address" id="ds_address"><br>

        <label for="image">Address complement: </label>
        <input type="number" name="nr_address" id="nr_address"><br>
        <!--dt_creation preenchemos no back-end-->
        <!--dt_update preenchemos no back-end-->

        <input type="submit" name="submit" value="Submit">
    </form>
</body>

</html>