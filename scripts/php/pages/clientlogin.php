<?php
    require_once '../classes/user.php';

    //use User;

    if(isset($_POST['submit'])){
        $email      = $_POST['email'];
        $password   = $_POST['password'];
        
        $columns = array('email', 'password');
        $values = array($email, $password);

        $selectedClient = User::selectUser($columns, $values);
    }
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client login</title>
    <link rel="stylesheet" href="../../styles/style.css">
    <link rel="stylesheet" href="../../styles/clientlogin.css">

</head>

<body>
    <div class="login-box">
        <div class="login-content">
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                <label for="email">Email</label>
                <input type="text" name="email" id="email">
                <br>
                <label for="password">Password</label>
                <input type="text" name="password" id="password">
                <input type="submit" name="submit" value="Login">
            </form>
        </div>
        <div class="register-content">
            <p>Don't have an user account? Make right there!</p>
            <!--Coloca um botão ou hyper link no there-->
        </div>
    </div>
    <script src="../javascript/script.js"></script>
</body>

</html>