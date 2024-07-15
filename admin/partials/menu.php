<?php
include('../config/constants.php');
include('login-check.php');
?>

<html>

<head>
    <title>Easy Pizza - Admin</title>
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/validation_user.css">
    <script type="text/javascript" src="../Validation/validation_addAdmin.js"></script>
    <script type="text/javascript" src="../Validation/Admin_validation_update_password.js"></script>
    <script type="text/javascript" src="../Validation/validation_update_admin.js"></script>
    </link>
</head>

<body>
    <!-- Menu Section Start -->
    <div class="menu text-center">
        <div class="wrapper">
            <ul>
                <li><a class="menu-a-tag" href="index.php">Home</a></li>
                <li><a class="menu-a-tag" href="manage-admin.php">Admin Manager</a></li>
                <li><a class="menu-a-tag" href="manage-customer.php">Customer Manager</a></li>
                <li><a class="menu-a-tag" href="manage-category.php">Category</a></li>
                <li><a class="menu-a-tag" href="manage-pizza.php">Pizza</a></li>
                <li><a class="menu-a-tag" href="manage-order.php">Order</a></li>
                <li><a class="menu-a-tag" href="best-selling.php">Reports</a></li>
                <li><a class="menu-a-tag" href="logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
    <!-- Menu Section End -->