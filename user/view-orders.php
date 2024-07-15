<?php
include('partials/menu.php');
include('partials/login-check.php');

$customer_id = $_SESSION['customer_login_id'];
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
        <h1>View Order</h1>

        <br>

        <?php
        if (isset($_SESSION['no-order'])) {
            echo $_SESSION['no-order'];
            unset($_SESSION['no-order']);
        }

        if (isset($_SESSION['cancle'])) {
            echo $_SESSION['cancle'];
            unset($_SESSION['cancle']);
        }
        ?>

        <br><br>

        <table class="tbl-full">
            <tr>
                <th>No</th>
                <th>Order ID</th>
                <th>Order Date</th>
                <th>Order Status</th>
                <th>Total</th>
                <th>Action</th>
            </tr>

            <?php
            //Get Data from DB
            $sql = "SELECT * FROM order_detail WHERE id_customer='$customer_id' ORDER BY id_order DESC";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);

            $sn = 1;

            if ($count > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $order_id = $row['id_order'];
                    $order_date = $row['order_date'];
                    $status = $row['order_status'];
                    $total = $row['total_bill'];

            ?>
                    <tr>
                        <td><?php echo $sn++; ?></td>
                        <td><?php echo $order_id; ?></td>
                        <td><?php echo $order_date; ?></td>

                        <td>
                            <?php
                            if ($status == "Ordered") {
                                echo "<lable  class='status-ordered'>$status</lable>";
                            } elseif ($status == "On Delivery") {
                                echo "<lable class='status-ondelivery'>$status</lable>";
                            } elseif ($status == "Delivered") {
                                echo "<lable class='status-delivered'>$status</lable>";
                            } elseif ($status == "Cancelled") {
                                echo "<lable class='status-cancelled'>$status</lable>";
                            }

                            ?>
                        </td>


                        <td><?php echo $total; ?></td>
                        <td>
                            <a href="<?php echo SITEURL; ?>user/cancle-order.php?id=<?php echo $order_id; ?>" class="btn-secondary">Cancel Order</a>
                        </td>
                    </tr>
            <?php
                }
            } else {
                echo "<tr><td colspan='6' class='error text-center'>Orders not Available</td></tr>";
            }
            ?>
        </table>
    </div>
</div>
<!-- Main Content Section End -->




    </div>
</div>





<?php include('partials/footer.php') ?>