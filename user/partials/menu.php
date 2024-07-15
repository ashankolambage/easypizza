<?php include('../config/constants.php')?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Easy Pizza</title>

    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/inuser-register.css">
    <link rel="stylesheet" href="../css/validation_user.css">
    <script type="text/javascript" src="../Validation/validation_userRegistration.js"></script>
    <script type="text/javascript" src="../Validation/validate_update_user_password.js"></script>
</head>

<body>
    <!-- Start of Navigation Bar -->
    <section class="navbar menu-all">
        <div class="container">
            <div class="">
            <div class="logo">
                <a href="#" title="Logo">
                    <img src="../images/logo.png" alt="Restaurant Logo" class="img-responsive">
                </a>
            </div>

            <div class="menu text-right">
                <ul>
                    <li>
                        <a href="<?php echo SITEURL; ?>user/">Home</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>user/pizza-categories.php">Categories</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>user/pizza-menu.php">Pizza</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>user/contacts.php">Contact Us</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>user/user-register.php">Sign Up</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>user/user-login.php">Login</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>user/logout.php">Logout</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>user/update-account.php">Account</a>
                    </li>
                </ul>
            </div>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- End of Navigation Bar -->