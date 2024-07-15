<?php
include('partials/menu.php');

$cus_id = 0;

if(isset($_SESSION['customer_login_id'])) // check user logged in
{
    $cus_id = $_SESSION['customer_login_id'];
}
?>

<!-- Start of Pizza Search Heading  -->
<section class="food-search text-center">
    <div class="container">

        <?php
        $search = $_POST['search'];
        ?>

        <h2>Foods on Your Search <a href="#" class="text-white">"<?php echo $search; ?>"</a></h2>
    </div>
</section>
<!-- End of Pizza Search Heading  -->




<!-- Start of Pizza Search Result Area -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>


        <!-- Get Search Keywords  -->
        <?php

        $sql = "SELECT * FROM pizza_item WHERE title LIKE '%$search%' OR description LIKE '%$search%'";
        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);

        if ($count > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                $id = $row['id_pizza'];
                $title = $row['title'];
                $price = $row['price'];
                $description = $row['description'];
                $image_name = $row['image_name'];

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
            echo "<div class='error text-center'>No Pizza Found</div>";
        }
        ?>
        <div class="clearfix"></div>
    </div>
</section>
<!-- End of Pizza Search Result Area -->

<?php include('partials/footer.php'); ?>