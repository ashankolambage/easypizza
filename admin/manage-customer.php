<?php include('partials/menu.php') ?>

<!-- Main Content Section Start -->
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Customer</h1>
        <br>

            <?php
            if (isset($_SESSION['delete'])) {
                echo $_SESSION['delete'];  //Display Message
                unset($_SESSION['delete']); //Clear the message for next window refresh
            }

            if (isset($_SESSION['customer_account_update'])) {
                echo $_SESSION['customer_account_update'];
                unset($_SESSION['customer_account_update']);
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

        <table class="tbl-full">
            <tr>
                <th>No.</th>
                <th>Full Name</th>
                <th>User Name</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>

            <?php
            //Get Account Data from DB
            $sql = "SELECT * FROM customer";
            $res = mysqli_query($conn, $sql);

            if ($res == TRUE) {
                $rows = mysqli_num_rows($res);  //Get Row count from DB table

                $no =1;

                if ($rows > 0) //Check DB table have any data
                {
                    while ($rows = mysqli_fetch_assoc($res)) //get all rows from DB table and assign to rows variable
                    {
                        // ASsign rows data to variable
                        $id = $rows['id_customer'];
                        $full_name = $rows['full_name'];
                        $username = $rows['username'];
                        $active = $rows['active'];

                        // Display all data from DB to web page table

            ?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $full_name ?></td>
                            <td><?php echo $username ?></td>
                            <td><?php echo $active ?></td>
                            <td>
                            <a href="<?php echo SITEURL; ?>admin/update-cus-password.php?id=<?php echo $id; ?>" class="btn-primary">Change Password</a>
                                <a href="<?php echo SITEURL;?>admin/update-customer.php?id=<?php echo $id;?>" class="btn-secondary">Update Customer</a>
                                <a href="<?php echo SITEURL; ?>admin/delete-customer.php?id=<?php echo $id; ?>" class="btn-danger">Delete Customer</a>
                            </td>
                        </tr>
            <?php
                    }
                }
            }
            ?>
        </table>
    </div>
</div>
<!-- Main Content Section End -->

<?php include('partials/footer.php') ?>