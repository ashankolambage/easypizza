<?php include('partials/menu.php') ?>

<!-- Main Content Section Start -->
<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>

        <br>
        <span id="showallerror"></span><br>

        <?php
        $id=$_GET['id'];  //Get Selcted admin ID

        //Get data from DB
        $sql="SELECT * FROM admin_account WHERE id_admin=$id";
        $res=mysqli_query($conn, $sql);

        if($res==TRUE)
        {
            $count = mysqli_num_rows($res); 

             //check wheter an admin account have under the selected id
            if($count==1)
            {
                $row=mysqli_fetch_assoc($res);

                $full_name = $row['full_name'];
                $username = $row['username'];
            }
            else
            {
                //if no admin account have redirect to manage admin page
                $_SESSION['user-not-found'] = "<div class='error text-center'>Failed to Update Admin: Admin Account not Found</div>";
                header("location:".SITEURL.'admin/manage-admin.php');
            }
        }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td>
                        <input type="text" id="fname" name="full_name" value="<?php echo $full_name; ?>" onkeyup="validName()">
                    </td>
                    <td><span id="error_fname"></span></td>
                </tr>

                <tr>
                    <td>User Name:</td>
                    <td>
                        <input type="text" name="username" id="uname" value="<?php echo $username; ?>" onkeyup="validusern()">
                    </td><td><span id="error_uname"></span></td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id"  value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary" onclick="return validForm()">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<!-- Main Content Section End -->

<?php include('partials/footer.php') ?>



<!-- Process form data -->
<?php

//check submit button clicked
if (isset($_POST['submit'])) {
    
    //get form data
    $id = $_POST['id'];
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];

    //SQL Query
    $sql = "UPDATE admin_account SET
    full_name = '$full_name',
    username='$username' 
    WHERE id_admin='$id'
    ";

    //Execute query
    $res = mysqli_query($conn, $sql);

    //Check Query Success or Not

    if($res==TRUE)
    {
        $_SESSION['update'] = "<div class='success text-center'>Admin Updated Successfully</div>";

        //Redirect Page
        header("location:".SITEURL.'admin/manage-admin.php');
    }
    else
    {
        $_SESSION['update'] = "<div class='error text-center'>Failed to Update Admin</div>";

        //Redirect Page
        header("location:".SITEURL.'admin/add-admin.php');
    }
}
?>