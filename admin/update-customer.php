<?php include('partials/menu.php') ?>

<!-- Main Content Section Start -->
<div class="main-content">
    <div class="wrapper">
        <h1>Update Customer</h1>
        <br>

        <?php
        $customer_id = $_GET['id'];

        $sql3 = "SELECT * FROM customer WHERE id_customer=$customer_id";
        $res3 = mysqli_query($conn, $sql3);
        $count3 = mysqli_num_rows($res3);
        $row3 = mysqli_fetch_assoc($res3);

        $full_name = $row3['full_name'];
        $address = $row3['address'];
        $contact_number = $row3['contact_number'];
        $email = $row3['email'];
        $username = $row3['username'];
        $active = $row3['active'];
        ?>

        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];  //Display Message
            unset($_SESSION['add']);  //Clear the message for next window refresh
        }

        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];  //Display Message
            unset($_SESSION['delete']); //Clear the message for next window refresh
        }

        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }

        if (isset($_SESSION['user-not-found'])) {
            echo $_SESSION['user-not-found'];
            unset($_SESSION['user-not-found']);
        }

        if (isset($_SESSION['password-not-matched'])) {
            echo $_SESSION['password-not-matched'];
            unset($_SESSION['password-not-matched']);
        }

        if (isset($_SESSION['change-password'])) {
            echo $_SESSION['change-password'];
            unset($_SESSION['change-password']);
        }
        ?>

        <br><br>
        <br><br><br>

        <form action="" method="POST">
            <table class="tbl-50">
                <tr>
                    <td>Full Name:</td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Address:</td>
                    <td>
                        <textarea name="address" cols="30" rows="5"><?php echo $address; ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Contact Number:</td>
                    <td>
                        <input type="text" name="contact_number" value="<?php echo $contact_number; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Email:</td>
                    <td>
                        <input type="text" name="email" value="<?php echo $email; ?>">
                    </td>
                </tr>

                <tr>
                    <td>User Name:</td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Status:</td>
                    <td>
                        <input <?php if ($active == "Yes") {
                                    echo "checked";
                                } ?> type="radio" name="active" value="Yes">Yes
                        <input <?php if ($active == "No") {
                                    echo "checked";
                                } ?> type="radio" name="active" value="No">No
                    </td>
                </tr>

                <td colspan="2">
                    <input type="hidden" name="id" value="<?php echo $customer_id; ?>">
                    <input type="submit" name="submit" value="Update Profile" class="btn-secondary">
                </td>
                </tr>
            </table>
        </form>

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
            $active = $_POST['active'];

            //SQL Query
            $sql = "UPDATE customer SET
    full_name = '$full_name',
    address = '$address',
    contact_number = '$contact_number',
    email = '$email',
    username='$username',
    active='$active'
    WHERE id_customer=$customer_id
    ";

            //Execute query
            $res = mysqli_query($conn, $sql);

            //Check Query Success or Not

            if ($res == TRUE) {
                $_SESSION['customer_account_update'] = "<div class='success text-center'>Acount Updated Successfully</div>";

                //Redirect Page
                header("location:" . SITEURL . 'admin/manage-customer.php');
            } else {
                $_SESSION['customer_account_update'] = "<div class='error text-center'>Failed to Update Account</div>";

                //Redirect Page
                header("location:" . SITEURL . 'admin/manage-customer.php');
            }
        }
        ?>


    </div>
</div>
<!-- Main Content Section End -->

<?php include('partials/footer.php') ?>