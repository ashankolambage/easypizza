<?php
include('partials/menu.php');
include('partials/login-check.php');

if (isset($_GET['pizza_id'])) {
    $pizza_id = $_GET['pizza_id'];
    $customer_id = $_GET['customer_id'];

    $sql = "SELECT * FROM pizza_item WHERE id_pizza=$pizza_id";
    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);

    $sql3 = "SELECT * FROM customer WHERE id_customer=$customer_id";
    $res3 = mysqli_query($conn, $sql3);
    $count3 = mysqli_num_rows($res3);
    $row3 = mysqli_fetch_assoc($res3);

    $full_name = $row3['full_name'];
    $address = $row3['address'];
    $contact_number = $row3['contact_number'];
    $email = $row3['email'];



    if ($count == 1) {
        $row = mysqli_fetch_assoc($res);
        $Pizza_id = $row['id_pizza'];
        $title = $row['title'];
        $price = $row['price'];
        $image_name = $row['image_name'];
    } else {
        header('location:' . SITEURL . 'user');
    }
} else {
    header('location:' . SITEURL . 'user');
}
?>

<!-- Start of Order Place Section -->
<section class="food-search">
    <div class="container">

        <h2 class="text-center text-white">Enter Order Delivery Details</h2>

        <form action="" method="POST" class="order">
            <fieldset>
                <legend>Selected Food</legend>

                <div class="food-menu-img">

                    <?php
                    if ($image_name == "") {
                        echo "<div class='error text-center'>Image Not Available</div>";
                    } else {
                    ?>
                        <img src="<?php echo SITEURL; ?>images/pizza/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">
                    <?php
                    }
                    ?>
                </div>

                <div class="food-menu-desc">

                    <input type="hidden" name="pizza_id" value="<?php echo $Pizza_id; ?>">

                    <h3><?php echo $title; ?></h3>

                    <p class="food-price"><?php echo $price; ?></p>
                    <input type="hidden" name="price" value="<?php echo $price; ?>">

                    <div class="order-label">Quantity</div>
                    <input type="number" name="qty" class="input-responsive" value="1" required>

                </div>

            </fieldset>

            <fieldset>
                <legend>Delivery Details</legend>
                <div class="order-label">Full Name</div>
                <input type="text" name="full-name" class="input-responsive" readonly value="<?php echo $full_name; ?>" required>

                <div class="order-label">Phone Number</div>
                <input type="tel" name="contact" class="input-responsive" readonly value="<?php echo $contact_number; ?>" required>

                <div class="order-label">Email</div>
                <input type="email" name="email" class="input-responsive" readonly value="<?php echo $email; ?>" required>

                <div class="order-label">Address</div>
                <textarea name="address" rows="5" class="input-responsive" required><?php echo $address; ?></textarea>

                <div class="order-label">Payment Method</div>
                <select name="payment_method">
                    <option value="Cash on Delivery">Cash on Delivery</option>
                </select><br><br>

                <input type="hidden" name="id" value="<?php echo $customer_id; ?>">
                <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
            </fieldset>

        </form>


        <!-- Start of From Submit Process -->

        <?php
        if (isset($_POST['submit'])) {
            $customer_id = $_POST['id'];
            $pizza_id = $_POST['pizza_id'];
            $price = $_POST['price'];
            $qty = $_POST['qty'];
            $address = $_POST['address'];
            $payment_method = $_POST['payment_method'];

            date_default_timezone_set("Asia/Calcutta");
            $order_date = date("Y-m-d H:i:s");

            $order_status = "Ordered"; // Ordered, On Delivery, Delivered, Cancelled

            $total_bill = $qty * $price;

            $sql2 = "INSERT INTO order_detail SET 
            id_customer=$customer_id, 
            id_pizza=$pizza_id, 
            item_price=$price,
            item_qty=$qty,
            order_date='$order_date',
            order_status='$order_status',
            delivery_address='$address',
            payment_method='$payment_method',
            total_bill=$total_bill
            ";

            $res2 = mysqli_query($conn, $sql2);

            if ($res2 == TRUE) {
                $_SESSION['order'] = "<div class='success text-center'>Food Ordered Successfully.</div>";
                header('location:' . SITEURL . 'user');
            }
        }
        ?>

        <!-- End of From Submit Process -->

    </div>
</section>
<!-- End of Order Place Section -->

<?php include('partials/footer.php'); ?>