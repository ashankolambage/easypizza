<?php
include('partials/menu.php');
include('partials/search-bar.php');

$cus_id = 0;

if(isset($_SESSION['customer_login_id'])) // check user logged in
{
    $cus_id = $_SESSION['customer_login_id'];
}
?>

<!-- Start of Pizza Menu Display -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Pizza Menu</h2>

        <!-- Get Pizza Type from DB -->
        <?php
        $sql2 = "SELECT * FROM pizza_item WHERE active='Yes'";
        $res2 = mysqli_query($conn, $sql2);
        $count2 = mysqli_num_rows($res2);

        if ($count2 > 0) {
            while ($row2 = mysqli_fetch_assoc($res2)) {
                $id = $row2['id_pizza'];
                $title = $row2['title'];
                $price = $row2['price'];
                $description = $row2['description'];
                $image_name = $row2['image_name'];
        ?>
                <div class="food-menu-box">
                    <div class="food-menu-img">
                        <?php
                        if ($image_name == "") {
                            echo "<div class='error text-center'>Image Not Available</div>";
                        } else {
                        ?>
                            <img src="<?php echo SITEURL; ?>images/pizza/<?php echo $image_name; ?>" class="img-responsive img-curve">
                        <?php
                        }
                        ?>
                    </div>

                    <div class="food-menu-desc">
                        <h4><?php echo $title; ?></h4>
                        <p class="food-price">Rs.<?php echo $price; ?></p>
                        <p class="food-detail">
                            <?php echo $description; ?>
                        </p>
                        <br>

                        <a href="<?php echo SITEURL; ?>user/order.php?pizza_id=<?php echo $id; ?>&customer_id=<?php echo $cus_id; ?>" class="btn btn-primary">Order Now</a>
                    </div>
                </div>
        <?php
            }
        } else {
            echo "<div class='error text-center'>Pizza Types not Added</div>";
        }
        ?>
        <div class="clearfix"></div>
    </div>
</section>
<!-- End of Pizza Menu Display -->

<?php include('partials/footer.php'); ?>