<?php include('partials/menu.php') ?>

<!-- Main Content Section Start -->
<div class="main-content">
    <div class="wrapper">

        <div>
            <a href="<?php echo SITEURL; ?>admin/best-selling.php" class="btn-user">Best Selling</a>
            <a href="<?php echo SITEURL; ?>admin/month-sale.php" class="btn-user">Monthly Sale</a>
        </div>

        <br><br>
        <h1>Monthly Sale</h1>
        <br><br>

        <table class="tbl-full">
            <tr>
                <th>No</th>
                <th>Pizza Title</th>
                <th>Pizza Category</th>
                <th>Total QTY</th>
                <th>Total Sale</th>
            </tr>

            <?php
            //Get Data from DB

            $sql = "SELECT 
                    order_detail.*, 
                    SUM(order_detail.item_qty) AS total_qty, 
                    SUM(order_detail.total_bill) AS total_sale, 
                    pizza_item.title AS pizza_title, 
                    pizza_category.title AS category_title 
                    FROM order_detail 
                    INNER JOIN pizza_item ON pizza_item.id_pizza=order_detail.id_pizza 
                    INNER JOIN pizza_category ON pizza_category.id_category=pizza_item.id_category 
                    WHERE order_detail.order_status='Delivered' 
                    AND YEAR(order_detail.order_date) = YEAR(CURRENT_DATE()) 
                    AND MONTH(order_detail.order_date) = MONTH(CURRENT_DATE())
                    GROUP BY order_detail.id_pizza 
                    ORDER BY SUM(order_detail.item_qty)  DESC;";

            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);

            $sn = 1;
            $final_sale = 0;

            if ($count > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $pizza_title = $row['pizza_title'];
                    $category_title = $row['category_title'];
                    $total_qty = $row['total_qty'];
                    $total_sale = $row['total_sale'];
                    $final_sale += $total_sale;

            ?>
                    <tr>
                        <td><?php echo $sn++; ?></td>
                        <td><?php echo $pizza_title; ?></td>
                        <td><?php echo $category_title; ?></td>
                        <td><?php echo $total_qty; ?></td>
                        <td><?php echo $total_sale; ?></td>
                    </tr>
            <?php
                }
            } else {
                echo "<tr><td colspan='6' class='error text-center'>Orders not Available</td></tr>";
            }
            ?>
        </table>

        <br><br><br>
        <div class="text-center">Total Monthly Sale: Rs.<?php echo $final_sale; ?></div>

    </div>
</div>
<!-- Main Content Section End -->

<?php include('partials/footer.php') ?>