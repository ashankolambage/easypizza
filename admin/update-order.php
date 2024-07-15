<?php
include('partials/menu.php');

if (isset($_GET['id'])) {
    $order_id = $_GET['id'];
} else {
    header("location:" . SITEURL . 'admin/manage-order.php');
}
?>

<!-- Main Content Section Start -->
<div class="main-content">
    <div class="wrapper">
        <h1>Update Order</h1>

        <br><br>

        <?php
        //Get data from DB
        $sql = "SELECT * FROM order_detail WHERE id_order=$order_id";
        $res = mysqli_query($conn, $sql);

        if ($res == TRUE) {
            $count = mysqli_num_rows($res);

            //check wheter an admin account have under the selected id
            if ($count == 1) {
                $row = mysqli_fetch_assoc($res);
                $status = $row['order_status'];
            } else {
                //if no admin account have redirect to manage admin page
                $_SESSION['order-not-found'] = "<div class='error text-center'>Failed to Update Order: Order not Found</div>";
                header("location:" . SITEURL . 'admin/manage-order.php');
            }
        }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Status:</td>
                    <td>
                        <select name="status">
                            <option <?php if($status=="Ordered"){echo "selected";} ?> value="Ordered">Ordered</option>
                            <option <?php if($status=="On Delivery"){echo "selected";} ?> value="On Delivery">On Delivery</option>
                            <option <?php if($status=="Delivered"){echo "selected";} ?> value="Delivered">Delivered</option>
                            <option <?php if($status=="Cancelled"){echo "selected";} ?> value="Cancelled">Cancelled</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $order_id; ?>">
                        <input type="submit" name="submit" value="Update Order" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <!-- Start of Form Submit Process -->

        <?php
        if(isset($_POST['submit']))
        {
            $order_id = $_POST['id'];
            $status = $_POST['status'];

            $sql = "UPDATE order_detail SET 
            order_status='$status' 
            WHERE id_order=$order_id
            ";

            $res = mysqli_query($conn, $sql);

            if($res==TRUE)
            {
                $_SESSION['update']  = "<div class='success text-center'>Order Update Successfully</div>";
                header("location:" . SITEURL . 'admin/manage-order.php');
            }
            else
            {
                $_SESSION['update']  = "<div class='error text-center'>Failed to  Update Order</div>";
                header("location:" . SITEURL . 'admin/manage-order.php');
            }
        }
        ?>

        <!-- End of Form Submit Process -->
    </div>
</div>
<!-- Main Content Section End -->

<?php include('partials/footer.php') ?>