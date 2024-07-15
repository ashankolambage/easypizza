<?php include('partials/menu.php') ?>

<!-- Main Content Section Start -->
<div class="main-content">
    <div class="wrapper">
        <h1>Order Details</h1>
        <br>

        <br><br>

        <?php
        $order_id = $_GET['id'];


        $sql = "SELECT order_detail.*, customer.*, pizza_item.* FROM order_detail 
        INNER JOIN customer ON customer.id_customer=order_detail.id_customer INNER JOIN pizza_item ON pizza_item.id_pizza=order_detail.id_pizza WHERE order_detail.id_order=$order_id";

        //$sql = "SELECT * FROM order_detail WHERE id_order=$order_id";
        $res = mysqli_query($conn, $sql);

        if ($res == TRUE) {
            $count = mysqli_num_rows($res);

            //check wheter an admin account have under the selected id
            if ($count == 1) {
                $row = mysqli_fetch_assoc($res);

                $item_price = $row['item_price'];
                $item_qty = $row['item_qty'];
                $order_date = $row['order_date'];
                $order_status = $row['order_status'];
                $delivery_address = $row['delivery_address'];
                $payment_method = $row['payment_method'];
                $total_bill = $row['total_bill'];

                $full_name = $row['full_name'];
                $contact_number = $row['contact_number'];
                $email = $row['email'];

                $pizza_title = $row['title'];
                $pizza_description = $row['description'];

                $sql = "SELECT * FROM order_detail WHERE id_order=$order_id";
                $res = mysqli_query($conn, $sql);
            } else {
                //if no admin account have redirect to manage admin page
                $_SESSION['user-not-found'] = "<div class='error text-center'>Failed to Update Admin: Admin Account not Found</div>";
                header("location:" . SITEURL . 'admin/manage-admin.php');
            }
        }
        ?>

        <table class="tbl-30">
            <tr>
                <td class="td_order_detail">Customer Name:</td>
                <td><?php echo $full_name; ?></td>
            </tr>

            <tr>
                <td class="td_order_detail">Delivery Address:</td>
                <td><?php echo $delivery_address; ?></td>
            </tr>

            <tr>
                <td class="td_order_detail">Email:</td>
                <td><?php echo $email; ?></td>
            </tr>

            <tr>
                <td class="td_order_detail">Contact Number:</td>
                <td><?php echo $contact_number; ?></td>
            </tr>

            <tr>
                <td class="td_order_detail">Pizza Name:</td>
                <td><?php echo $pizza_title; ?></td>
            </tr>

            <tr>
                <td class="td_order_detail">Pizza Description:</td>
                <td><?php echo $pizza_description; ?></td>
            </tr>

            <tr>
                <td class="td_order_detail">Quantity:</td>
                <td><?php echo $item_qty; ?></td>
            </tr>

            <tr>
                <td class="td_order_detail">Item Price:</td>
                <td><?php echo $item_price; ?></td>
            </tr>

            <tr>
                <td class="td_order_detail">Total Bill:</td>
                <td><?php echo $total_bill; ?></td>
            </tr>

            <tr>
                <td class="td_order_detail">Order Date & Time:</td>
                <td><?php echo $order_date; ?></td>
            </tr>

            <tr>
                <td class="td_order_detail">Payment Method:</td>
                <td><?php echo $payment_method; ?></td>
            </tr>

            <tr>
                <td class="td_order_detail">Status:</td>
                <td><?php echo $order_status; ?></td>
            </tr>
        </table>

    </div>
</div>
<!-- Main Content Section End -->

<?php include('partials/footer.php') ?>