<?php
include('partials/menu.php');

if (isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];

    $sql = "SELECT title FROM pizza_category WHERE id_category=$category_id";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($res);
    $category_title = $row['title'];
} else {
    header('location:' . SITEURL . 'user');
}

$cus_id = 0;

if(isset($_SESSION['customer_login_id'])) // check user logged in
{
    $cus_id = $_SESSION['customer_login_id'];
}
?>


<!-- Start of Selected Category Heading -->
<section class="food-search text-center">
    <div class="container">
        <h2>Foods on <a href="#" class="text-white">"<?php echo $category_title; ?>"</a></h2>
    </div>
</section>
<!-- End of Selected Category Heading -->


<!-- Start of Category Result Display Area -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>


        <?php

        $sql2 = "SELECT * FROM pizza_item WHERE id_category=$category_id";
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
            echo "<div class='error text-center'>No Pizza Found</div>";
        }
        ?>
        <div class="clearfix"></div>
    </div>
</section>
<!-- End of Category Result Display Area -->

<?php include('partials/footer.php'); ?>