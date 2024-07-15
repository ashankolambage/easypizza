<?php
include('partials/menu.php');
include('partials/search-bar.php');

$cus_id = 0;

if(isset($_SESSION['customer_login_id'])) // check user logged in
{
    $cus_id = $_SESSION['customer_login_id'];
}
?>

<br><br>

<?php
if(isset($_SESSION['order']))
{
    echo $_SESSION['order'];
    unset($_SESSION['order']);
}

if(isset($_SESSION['customer_account_create']))
{
    echo $_SESSION['customer_account_create'];
    unset($_SESSION['customer_account_create']);
}

if(isset($_SESSION['customer_account_update']))
{
    echo $_SESSION['customer_account_update'];
    unset($_SESSION['customer_account_update']);
}

if(isset($_SESSION['login']))
{
    echo $_SESSION['login'];
    unset($_SESSION['login']);
}

if(isset($_SESSION['change-password']))
{
    echo $_SESSION['change-password'];
    unset($_SESSION['change-password']);
}

if(isset($_SESSION['password-not-matched']))
{
    echo $_SESSION['password-not-matched'];
    unset($_SESSION['password-not-matched']);
}

if(isset($_SESSION['user-not-found']))
{
    echo $_SESSION['user-not-found'];
    unset($_SESSION['user-not-found']);
}

if(isset($_SESSION['already-logged-in']))
{
    echo $_SESSION['already-logged-in'];
    unset($_SESSION['already-logged-in']);
}
?>

<!-- Start of Category Section -->
<section class="categories">
    <div class="container">
        <h2 class="text-center">Explore Pizza Categories</h2>

        <!-- Get Categories from DB -->
        <?php
        $sql = "SELECT * FROM pizza_category WHERE featured='Yes' AND active='Yes' LIMIT 3";
        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);

        if ($count > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                $id = $row['id_category'];
                $title = $row['title'];
                $image_name = $row['image_name'];

        ?>

                <a href="<?php SITEURL; ?>category-pizza.php?category_id=<?php echo $id; ?>">
                    <div class="box-3 float-container">
                        <?php
                        if ($image_name == "") {
                            echo "<div class='error text-center'>Image Not Available</div>";
                        } else {
                        ?>
                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">
                        <?php
                        }
                        ?>
                        <h3 class="float-text text-white"><?php echo $title; ?></h3>
                    </div>
                </a>
        <?php
            }
        } else {
            echo "<div class='error text-center'>Category not Added</div>";
        }
        ?>
        <div class="clearfix"></div>
    </div>
</section>
<!-- End of Category Section -->



<!-- Start of Pizza Type Section -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Pizza Menu</h2>

        <!-- Get Pizza Type from DB -->
        <?php
        $sql2 = "SELECT * FROM pizza_item WHERE featured='Yes' AND active='Yes' LIMIT 6";
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

    <p class="text-center">
        <a href="#">See All Foods</a>
    </p>
</section>
<!-- End of Pizza Type Section -->

<?php include('partials/footer.php'); ?>