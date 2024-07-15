<?php
include('partials/menu.php');

if(isset($_SESSION['customer_login'])) // check user logged in
{
    $_SESSION['already-logged-in'] =  "<div class='error text-center'>Please Logout to Create New Account</div>";
    header("location:" . SITEURL . 'user');
}

?>

<!-- Main Content Section Start -->
<div class="main-content">
    <div class="wrapper">
        <div class="container1">
            <form action="" method="POST">
                <h1> User Registration </h1>
                <span id="err_sub"></span><br>
                <div class="form-group">
                    <label for="">Full Name</label><span id="error_fullname"></span> <br>
                    <input type="text" class="form-control" id="fname" name="full_name" onkeyup="validFullname()">
                </div>

                <div class="form-group">
                    <label for="">Address</label><span id="error_address"></span><br>
                    <textarea class="form-textarea" name="address" id="address" onkeyup="validateAddress()"></textarea>
                </div>

                <div class="form-group">
                    <label for="">Contact Number</label><span id="error_contact"></span><br>
                    <input type="text" name="contact_number" id="contact_number" class="form-control" onkeyup="validateContact()">
                </div>

                <div class="form-group">
                    <label for="">Email</label><span id="error_email"></span><br>
                    <input type="text" name="email" id="emai" class="form-control" onkeyup="validEmail()">
                </div>

                <div class="form-group">
                    <label for="">User Name</label><span id="error_userName"></span><br>
                    <input type="text" name="username" id="uname" class="form-control" onkeyup="validUserName()">
                </div>


                <div class="form-group">
                    <label for="">Password</label><span id="err_pass"></span><br>
                    <input type="password" name="password" id="pass" class="form-control" onkeyup="validPassword()">
                </div>
                <input type="submit" name="submit" class="btn" value="Create Account" onclick="return validSubmit()">
            </form>
        </div>
        <?php include('partials/footer.php') ?>
    </div>
</div>
<!-- Main Content Section End -->




<!-- Process form data -->
<?php

//check submit button clicked
if (isset($_POST['submit'])) {

    //get form data
    $full_name = $_POST['full_name'];
    $address = $_POST['address'];
    $contact_number = $_POST['contact_number'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);  //encrypt password. this is one way encryption. can not decrypt back

    //SQL Query
    $sql = "INSERT INTO customer SET
    full_name = '$full_name',
    address = '$address',
    contact_number = '$contact_number',
    email = '$email',
    username='$username',
    password='$password',
    active='Yes'
    ";

    //Execute query
    $res = mysqli_query($conn, $sql);

    //Check Query Success or Not

    if ($res == TRUE) {
        $_SESSION['customer_account_create'] = "<div class='success text-center'>Acount Created Successfully. Log In to the System</div>";

        //Redirect Page
        header("location:" . SITEURL . 'user/user-login.php');
    } else {
        $_SESSION['customer_account_create'] = "<div class='error text-center'>Failed to Create Account</div>";

        //Redirect Page
        header("location:" . SITEURL . 'user/user-register.php');
    }
}
?>