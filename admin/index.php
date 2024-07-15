<?php include('partials/menu.php') ?>

<!-- Main Content Section Start -->
<div class="main-content home-background">
    <div class="wrapper">
        <div class="">
            <h1 class="text-center">DASHBOARD</h1>

            <br><br>
            <?php
            if (isset($_SESSION['login'])) {
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }
            ?>
            <br><br>

            <div class="col-4 text-center">

                <?php
                $sql = "SELECT * FROM pizza_category";
                $res = mysqli_query($conn, $sql);

                $count = mysqli_num_rows($res);
                ?>
                <h1><?php echo $count; ?></h1>
                <br>
                Categories
            </div>

            <div class="col-4 text-center">

                <?php
                $sql2 = "SELECT * FROM pizza_item";
                $res2 = mysqli_query($conn, $sql2);

                $count2 = mysqli_num_rows($res2);
                ?>
                <h1><?php echo $count2; ?></h1>
                <br>
                Pizza
            </div>

            <div class="col-4 text-center">

                <?php
                $sql3 = "SELECT * FROM order_detail WHERE order_status='Ordered'";
                $res3 = mysqli_query($conn, $sql3);

                $count3 = mysqli_num_rows($res3);
                ?>
                <h1><?php echo $count3; ?></h1>
                <br>
                Orders
            </div>

            <div class="col-4 text-center">
                <?php
                $sql4 = "SELECT * FROM customer";
                $res4 = mysqli_query($conn, $sql4);

                $count4 = mysqli_num_rows($res4);
                ?>
                <h1><?php echo $count4; ?></h1>
                <br>
                Customers
            </div>

            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!-- Main Content Section End -->

<?php include('partials/footer.php') ?>