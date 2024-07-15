<?php
include('../config/constants.php');
?>

<html>

<head>
    <title>Admin Login - EasyPizza</title>
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/validation_user.css">
    <script type="text/javascript" src="../Validation/validation_Login.js"></script>

</head>

<body>
    <div class="login">
        <h1 class="text-center">Admin Login</h1>
        <br>
        <span id="form_err"></span><br><br>

        <?php
        if (isset($_SESSION['login'])) {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }

        if (isset($_SESSION['no-logged-in'])) {
            echo $_SESSION['no-logged-in'];
            unset($_SESSION['no-logged-in']);
        }
        ?>

        <br><br>

        <!-- Start of Login Form -->
        <form action="" method="POST" class="text-center">
            User Name:
            <br>
            <input type="text" name="username" id="userName" placeholder="Enter Your User Name" onkeyup="validateName()">
            <br><span id="error_name"></span>
            <br><br>

            Password:
            <br>
            <input type="password" name="password" id="password" placeholder="Enter Your Password" onkeyup="validatePass()">
            <br><span id="error_pass"></span>
            <br><br><br>

            <input type="submit" name="submit" value="Login" class="btn-primary" style="padding: 2% 10%;" onclick="return validateForm()">
        </form>
        <!-- End of Login Form -->

        <br><br>
        <p class="text-center">Created By - Thunder Beasts</p>
    </div>
</body>

</html>


<!-- Start of Login Form Function -->

<?php
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM admin_account WHERE username='$username' and password='$password'";
    $res = mysqli_query($conn, $sql);

    if ($res == TRUE) {
        $count = mysqli_num_rows($res);

        if ($count == 1) {
            $_SESSION['login'] = "<div class='success text-center'>Login Successfull</div>";

            $_SESSION['admin_login'] = $username;  //login session starts
            header("location:" . SITEURL . 'admin/');
        } else {
            //if no admin account have redirect to manage admin page
            $_SESSION['login'] = "<div class='error text-center'>Login Failed: User Name or Password Incorrect</div>";
            header("location:" . SITEURL . 'admin/login.php');
        }
    }
}
?>

<!-- End of Login Form Function -->