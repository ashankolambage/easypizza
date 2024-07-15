<?php
include('partials/menu.php');
include('partials/login-check.php');

$customer_id = $_SESSION['customer_login_id'];

$sql3 = "SELECT * FROM customer WHERE id_customer=$customer_id";
$res3 = mysqli_query($conn, $sql3);
$count3 = mysqli_num_rows($res3);
$row3 = mysqli_fetch_assoc($res3);

$full_name = $row3['full_name'];
$address = $row3['address'];
$contact_number = $row3['contact_number'];
$email = $row3['email'];
$username = $row3['username'];

?>


<div class="main-content">
    <div class="wrapper">
        <div>
            <a href="<?php echo SITEURL; ?>user/update-account.php" class="btn-user">Update Profile</a>
            <a href="<?php echo SITEURL; ?>user/update-password.php" class="btn-user">Change Password</a>
            <a href="<?php echo SITEURL; ?>user/view-orders.php" class="btn-user">View Orders</a>
        </div>

        <br><br><br>



        <!-- Main Content Section Start -->
        <div class="main-content">
            <div class="wrapper">
                <h1>Update User Profile</h1>

                <br><span id="err_sub"></span><br><br>

                <form action="" method="POST">
                    <table class="tbl-50">
                        <tr>
                            <td>Full Name:</td>
                            <td>
                                <input type="text" id="fname" name="full_name" value="<?php echo $full_name; ?>" onkeyup="validFullname()">
                            </td>
                            <td><span id="error_fullname"></span></td>
                        </tr>

                        <tr>
                            <td>Address:</td>
                            <td>
                                <textarea name="address" id="address" onkeyup="validateAddress()" cols="30" rows="5"><?php echo $address; ?></textarea>
                            </td>
                            <td><span id="error_address"></span></td>
                        </tr>

                        <tr>
                            <td>Contact Number:</td>
                            <td>
                                <input type="text"  id="contact_number" name="contact_number" value="<?php echo $contact_number; ?>"  onkeyup="validateContact()">
                            </td><td><span id="error_contact"></span></td>
                        </tr>

                        <tr>
                            <td>Email:</td>
                            <td>
                                <input type="text" name="email" value="<?php echo $email; ?>" id="emai" onkeyup="validEmail()">
                            </td>
                            <td><span id="error_email"></span></td>
                        </tr>

                        <tr>
                            <td>User Name:</td>
                            <td>
                                <input type="text" name="username" id="uname" value="<?php echo $username; ?>" onkeyup="validUserName()">
                            </td>
                            <td><span id="error_userName"></span></td>
                        </tr>
                        <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $customer_id; ?>">
                            <input type="submit" name="submit" value="Update Profile" class="btn-secondary" onclick="return validSubmit()">
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
            $customer_id = $_POST['id'];
            $full_name = $_POST['full_name'];
            $address = $_POST['address'];
            $contact_number = $_POST['contact_number'];
            $email = $_POST['email'];
            $username = $_POST['username'];

            //SQL Query
            $sql = "UPDATE customer SET
    full_name = '$full_name',
    address = '$address',
    contact_number = '$contact_number',
    email = '$email',
    username='$username'
    WHERE id_customer=$customer_id
    ";

            //Execute query
            $res = mysqli_query($conn, $sql);

            //Check Query Success or Not

            if ($res == TRUE) {
                $_SESSION['customer_account_update'] = "<div class='success text-center'>Acount Updated Successfully</div>";

                //Redirect Page
                header("location:" . SITEURL . 'user/');
            } else {
                $_SESSION['customer_account_update'] = "<div class='error text-center'>Failed to Update Account</div>";

                //Redirect Page
                header("location:" . SITEURL . 'user/');
            }
        }
        ?>












    </div>
</div>