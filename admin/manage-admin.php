<?php include('partials/menu.php') ?>

<!-- Main Content Section Start -->
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Admin</h1>
        <br>

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

        <!-- Button to Add Admin -->
        <a href="add-admin.php" class="btn-primary">Add Admin</a>
        <br><br><br>

        <table class="tbl-full">
            <tr>
                <th>No.</th>
                <th>Full Name</th>
                <th>User Name</th>
                <th>Actions</th>
            </tr>

            <?php
            //Get Account Data from DB
            $sql = "SELECT * FROM admin_account";
            $res = mysqli_query($conn, $sql);

            if ($res == TRUE) {
                $rows = mysqli_num_rows($res);  //Get Row count from DB table

                $no =1;

                if ($rows > 0) //Check DB table have any data
                {
                    while ($rows = mysqli_fetch_assoc($res)) //get all rows from DB table and assign to rows variable
                    {
                        // ASsign rows data to variable
                        $id = $rows['id_admin'];
                        $full_name = $rows['full_name'];
                        $username = $rows['username'];

                        // Display all data from DB to web page table

            ?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $full_name ?></td>
                            <td><?php echo $username ?></td>
                            <td>
                            <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">Change Password</a>
                                <a href="<?php echo SITEURL;?>admin/update-admin.php?id=<?php echo $id;?>" class="btn-secondary">Update Admin</a>
                                <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a>
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