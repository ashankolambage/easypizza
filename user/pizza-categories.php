<?php include('partials/menu.php'); ?>

<!-- Start of Pizza Category Display -->
<section class="categories">
    <div class="container">
        <h2 class="text-center">Pizza Category</h2>

        <!-- Get Categories from DB -->
        <?php
        $sql = "SELECT * FROM pizza_category WHERE active='Yes'";
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
<!-- End of Pizza Category Display -->

<?php include('partials/footer.php'); ?>