<?php
include('partials/menu.php');
include('partials/login-check.php');

$customer_id = $_SESSION['customer_login_id'];
?>


<div class="main-content">
    <div class="wrapper">
        <div>
            <a href="<?php echo SITEURL; ?>/user/update-account.php" class="btn-user">Update Profile</a>
            <a href="<?php echo SITEURL; ?>/user/update-password.php" class="btn-user">Change Password</a>
            <a href="<?php echo SITEURL; ?>user/view-orders.php" class="btn-user">View Orders</a>
        </div>

        <br><br><br>



        <!-- Main Content Section Start -->
        <div class="main-content">
            <div class="wrapper">
                <h1>Update User Password</h1>

                <br>
                <span id="form_error"></span>
                <br>

                <form action="" method="POST">
                    <table class="tbl-50">

                        <tr>
                            <td>Current Password:</td>
                            <td>
                                <input type="password" name="curent_password" id="curpass" placeholder="Enter Old Password" onkeyup="validcurpass()">
                            </td>
                            <td><span id="error_curPassword"></span></td>
                        </tr>
                        <tr>
                            <td>New Password:</td>
                            <td>
                                <input type="password" id="npassword" name="new_password" placeholder="Enter New Password" onkeyup="validateNpass()">
                            </td>
                            <td><span id="error_nPassword"></span></td>
                        </tr>

                        <tr>
                            <td>Confirm Password:</td>
                            <td>
                                <input type="password" name="confirm_password" placeholder="Enter New Password Again" id="cpassword" onkeyup="validCpass()">
                            </td>
                            <td><span id="error_cPassword"></span></td>
                        </tr>

                        <tr>
                            <td colspan="2">
                                <input type="hidden" name="id" value="<?php echo $customer_id; ?>">
                                <input type="submit" name="submit" value="Change Password" class="btn-secondary" onclick="return validUpdatePassSubmit()">
                            </td>
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

            $customer_id = $_POST['id'];
            $current_password = md5($_POST['curent_password']);
            $new_password = md5($_POST['new_password']);
            $confirm_password = md5($_POST['confirm_password']);



            //SQL Query

            $sql = "SELECT * FROM customer WHERE id_customer=$customer_id";
            $res = mysqli_query($conn, $sql);

            if ($res == TRUE) {
                $count = mysqli_num_rows($res);

                //check wheter an admin account have under the selected id
                if ($count == 1) {

                    $row = mysqli_fetch_assoc($res);
                    $old_password = $row['password'];

                    if ($old_password == $current_password) {

                        if ($new_password == $confirm_password) {

                            $sql2 = "UPDATE customer SET password = '$new_password' WHERE id_customer='$customer_id'";
                            $res2 = mysqli_query($conn, $sql2);

                            //Check Query Success or Not
                            if ($res2 == TRUE) {
                                $_SESSION['change-password'] = "<div class='success text-center'>Password Change Successfully</div>";
                                header("location:" . SITEURL . 'user/');
                            } else {
                                $_SESSION['change-password'] = "<div class='error text-center'>Failed to Change Password</div>";
                                header("location:" . SITEURL . 'user/');
                            }
                        } else {
                            $_SESSION['password-not-matched'] = "<div class='error text-center'>Failed to Change Password: Password not Matched</div>";
                            header("location:" . SITEURL . 'user/');
                        }
                    } else {
                        $_SESSION['password-not-matched'] = "<div class='error text-center'>Failed to Change Password: Password Incorrect</div>";
                        header("location:" . SITEURL . 'user/');
                    }
                } else {
                    $_SESSION['user-not-found'] = "<div class='error text-center'>Failed to Change Password: Admin Account not Found</div>";
                    header("location:" . SITEURL . 'user/');
                }
            }
        }
        ?>












    </div>
</div>