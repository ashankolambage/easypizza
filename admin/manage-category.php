<?php include('partials/menu.php') ?>

<!-- Main Content Section Start -->
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Category</h1>

        <br>

        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];  //Display Message
            unset($_SESSION['add']);  //Clear the message for next window refresh
        }

        if (isset($_SESSION['remove'])) {
            echo $_SESSION['remove'];
            unset($_SESSION['remove']);
        }

        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }

        if (isset($_SESSION['no-category'])) {
            echo $_SESSION['no-category'];
            unset($_SESSION['no-category']);
        }

        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }

        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }

        if (isset($_SESSION['remove-image'])) {
            echo $_SESSION['remove-image'];
            unset($_SESSION['remove-image']);
        }
        ?>

        <br><br>

        <!-- Button to Add Admin -->
        <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Add Category</a>
        <br><br><br>

        <table class="tbl-full">
            <tr>
                <th>No.</th>
                <th>Title</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>

            <?php
            $sql = "SELECT * FROM pizza_category";
            $res = mysqli_query($conn, $sql);

            $sn = 1;

            $count = mysqli_num_rows($res);
            if ($count > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id_category'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];

            ?>

                    <tr>
                        <td><?php echo $sn++; ?></td>
                        <td><?php echo $title; ?></td>

                        <td>
                            <?php
                            //Check image file available or not
                            if($image_name!="")
                            {
                                ?>

                                <img src="<?php echo SITEURL;?>images/category/<?php echo $image_name;?>" width="100px">

                                <?php
                            }
                            else
                            {
                                echo "<div class='error text-center'>Image Not Added</div>";
                            }
                             ?>
                        </td>

                        <td><?php echo $featured; ?></td>
                        <td><?php echo $active; ?></td>
                        <td>
                            <a href="<?php echo SITEURL; ?>/admin/update-category.php?id=<?php echo $id; ?>" class="btn-secondary">Update Category</a>
                            <a href="<?php echo SITEURL; ?>/admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Category</a>
                        </td>
                    </tr>


                <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="6">
                        <div class="error text-center">No Category Added</div>
                    </td>
                </tr>
            <?php
            }
            ?>
        </table>
    </div>
</div>
<!-- Main Content Section End -->

<?php include('partials/footer.php') ?>