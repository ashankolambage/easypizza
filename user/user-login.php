<?php
include('../config/constants.php');

if(isset($_SESSION['customer_login'])) // check user logged in
{
    $_SESSION['already-logged-in'] =  "<div class='error text-center'>Already Logged in</div>";
    header("location:" . SITEURL . 'user');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/inuser-login.css">
    <link rel="stylesheet" href="../css/validation_user.css">

    <script type="text/javascript" src="../Validation/validation_userLogin.js"></script>
    <title>User Login - Easy Pizza</title>
</head>

<body>
    <div class="container">

        <!-- Start of Login Form -->

        <form action="" method="POST">
            <h1> User Login </h1>

            <?php
            if (isset($_SESSION['login'])) {
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }

            if (isset($_SESSION['no-logged-in'])) {
                echo $_SESSION['no-logged-in'];
                unset($_SESSION['no-logged-in']);
            }

            if (isset($_SESSION['customer_account_create'])) {
                echo $_SESSION['customer_account_create'];
                unset($_SESSION['customer_account_create']);
            }
            ?>
            <span id="err_sub"> </span>
            <br>


            <div class="form-group">
                <label for="">User Name </label><span id="err_uname"> </span>
                <input type="text" name="username" id="uname" class="form-control" onkeyup="validUserName()">
            </div>

            <div class="form-group">
                <label for="">Password</label><span id="err_pass"> </span>
                <input type="password" id="pass" class="form-control" name="password" onkeyup="validPassword()">
            </div>
            <button name="submit" class="btn" value="login" onclick="return validSubmit()">login</button>

        </form>

        <!-- End of Login Form -->
        <p class="text-center">Created By - Thunder Beasts</p>
    </div>
</body>

</html>


<!-- Start of Login Form Function -->

<?php
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM customer WHERE username='$username' and password='$password' AND active='Yes'";
    $res = mysqli_query($conn, $sql);

    if ($res == TRUE) {
        $count = mysqli_num_rows($res);

        if ($count == 1) {

            $row = mysqli_fetch_assoc($res);
            $id = $row['id_customer'];

            $_SESSION['login'] = "<div class='success text-center'>Login Successfull</div>";

            $_SESSION['customer_login'] = $username;  //login session starts
            $_SESSION['customer_login_id'] = $id;
            header("location:" . SITEURL . 'user/');
        } else {
            //if no admin account have redirect to manage admin page
            $_SESSION['login'] = "<div class='error text-center'>Login Failed: User Name or Password Incorrect</div>";
            header("location:" . SITEURL . 'user/user-login.php');
        }
    }
}
?>

<!-- End of Login Form Function -->