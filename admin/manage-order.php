<?php include('partials/menu.php') ?>

<!-- Main Content Section Start -->
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Order</h1>

        <br>

        <?php
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }

        if (isset($_SESSION['order-not-found'])) {
            echo $_SESSION['order-not-found'];
            unset($_SESSION['order-not-found']);
        }
        ?>

        <br><br>

        <table class="tbl-full">
            <tr>
                <th>No</th>
                <th>Customer Name</th>
                <th>Pizza Title</th>
                <th>QTY</th>
                <th>Order Date</th>
                <th>Order Status</th>
                <th>Total</th>
                <th>Action</th>
            </tr>

            <?php
            //Get Data from DB

            $sql = "SELECT order_detail.*, customer.id_customer, customer.full_name, pizza_item.title AS pizza_title FROM order_detail 
            INNER JOIN customer ON customer.id_customer=order_detail.id_customer 
            INNER JOIN pizza_item ON pizza_item.id_pizza=order_detail.id_pizza 
            ORDER BY order_detail.order_date DESC";

            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);

            $sn = 1;

            if ($count > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $order_id = $row['id_order'];
                    $customer_name = $row['full_name'];
                    $pizza_title = $row['pizza_title'];
                    $qty = $row['item_qty'];
                    $order_date = $row['order_date'];
                    $status = $row['order_status'];
                    $total = $row['total_bill'];

            ?>
                    <tr>
                        <td><?php echo $sn++; ?></td>
                        <td><?php echo $customer_name; ?></td>
                        <td><?php echo $pizza_title; ?></td>
                        <td><?php echo $qty; ?></td>
                        <td><?php echo $order_date; ?></td>

                        <td>
                            <?php
                            if($status=="Ordered")
                            {
                                echo "<lable  class='status-ordered'>$status</lable>";
                            }
                            elseif($status=="On Delivery")
                            {
                                echo "<lable class='status-ondelivery'>$status</lable>";
                            }
                            elseif($status=="Delivered")
                            {
                                echo "<lable class='status-delivered'>$status</lable>";
                            }
                            elseif($status=="Cancelled")
                            {
                                echo "<lable class='status-cancelled'>$status</lable>";
                            }
                             
                             ?>
                        </td>


                        <td><?php echo $total; ?></td>
                        <td>
                            <a href="<?php echo SITEURL; ?>/admin/update-order.php?id=<?php echo $order_id; ?>" class="btn-primary">Update Order</a>
                            <a href="<?php echo SITEURL; ?>/admin/order-detail.php?id=<?php echo $order_id; ?>" class="btn-secondary">Order Detail</a>
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

<?php include('partials/footer.php') ?>