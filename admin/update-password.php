<?php include('partials/menu.php') ?>
<!-- Main Content Section Start -->
<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>

        <br>
        <span id="form_error"></span><br>

        <?php
        $id = $_GET['id'];
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>New Password:</td>
                    <td>
                        <input type="password" id="npassword" name="new_password" placeholder="Enter New Password" onkeyup="validateNpass()">
                    </td><td><span id="error_nPassword"></span></td>
                </tr>

                <tr>
                    <td>Confirm Password:</td>
                    <td>
                        <input type="password" id="cpassword" name="confirm_password" placeholder="Enter New Password Again" onkeyup="validCpass()">
                    </td><td><span id="error_cPassword"></span></td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-secondary" onclick="return validUpdatePassSubmit()">
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
    $id = $_POST['id'];
    $new_password = md5($_POST['new_password']);
    $confirm_password = md5($_POST['confirm_password']);

    $sql = "SELECT * FROM admin_account WHERE id_admin=$id";
    $res = mysqli_query($conn, $sql);

    if ($res == TRUE) {
        $count = mysqli_num_rows($res);

        //check wheter an admin account have under the selected id
        if ($count == 1) {
            if ($new_password == $confirm_password) {

                $sql2 = "UPDATE admin_account SET password = '$new_password' WHERE id_admin='$id'";
                $res2 = mysqli_query($conn, $sql2);

                //Check Query Success or Not
                if ($res2 == TRUE) {
                    $_SESSION['change-password'] = "<div class='success text-center'>Password Change Successfully</div>";
                    header("location:" . SITEURL . 'admin/manage-admin.php');
                }
                else
                {
                    $_SESSION['change-password'] = "<div class='error text-center'>Failed to Change Password</div>";
                    header("location:" . SITEURL . 'admin/manage-admin.php');
                }
            }
            else
            {
                $_SESSION['password-not-matched'] = "<div class='error text-center'>Failed to Change Password: Password not Matched</div>";
                header("location:" . SITEURL . 'admin/manage-admin.php');
            }
        }
        else
        {
            //if no admin account have redirect to manage admin page
            $_SESSION['user-not-found'] = "<div class='error text-center'>Failed to Change Password: Admin Account not Found</div>";
            header("location:" . SITEURL . 'admin/manage-admin.php');
        }
    }
}
?>