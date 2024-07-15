<?php include('partials/menu.php') ?>

<!-- Main Content Section Start -->
<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>

        <br>
        <span id="showallerror"></span>
        <br>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td>
                        <input type="text" name="full_name" id="fname" placeholder="Enter Your Full Name" onkeyup="validName()">
                    </td>
                    <td><span id="error-fullname"></span></td>
                </tr>

                <tr>
                    <td>User Name:</td>
                    <td>
                        <input type="text" name="username" id="username" placeholder="Enter User Name" onkeyup="Validusern()">
                    </td>
                    <td><span id="error-username"></span></td>
                </tr>

                <tr>
                    <td>Password:</td>
                    <td>
                        <input type="password" name="password" id="pass" placeholder="Enter Password" onkeyup="validPass()">
                    </td>
                    <td><span id="error-pass"></span></td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary" onclick="return validForm()">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<!-- Main Content Section End -->

<?php include('partials/footer.php') ?>


<!-- Process form data -->
<?php

//check submit button clicked
if (isset($_POST['submit'])) {
    
    //get form data
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);  //encrypt password. this is one way encryption. can not decrypt back

    //SQL Query
    $sql = "INSERT INTO admin_account SET
    full_name = '$full_name',
    username='$username',
    password='$password'
    ";

    //Execute query
    $res = mysqli_query($conn, $sql);

    //Check Query Success or Not

    if($res==TRUE)
    {
        $_SESSION['add'] = "<div class='success text-center'>Admin Added Successfully</div>";

        //Redirect Page
        header("location:".SITEURL.'admin/manage-admin.php');
    }
    else
    {
        $_SESSION['add'] = "<div class='error text-center'>Failed to add Admin</div>";

        //Redirect Page
        header("location:".SITEURL.'admin/add-admin.php');
    }
}
?>