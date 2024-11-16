<?php
include("src/scripts/db/connect.php");
include_once 'src/scripts/foodAction/foodAction.php';

if (empty($_SESSION["user_id"])) {
    header('location:login.php');
    exit;
}
foreach ($_SESSION["cart_item"] as $item) {
    $item_total += ($item["price"] * $item["quantity"]);
    if ($_POST['submit']) {
        $orderType = isset($_POST['order_type']) ? $_POST['order_type'] : '';

        $query = "SELECT rs_id FROM foods WHERE title = '" . $item["title"] . "'";
        $result = mysqli_query($db, $query);
        $row = mysqli_fetch_assoc($result);
        $rs_id = $row['rs_id'];

        $SQL = "INSERT INTO users_orders (u_id, title, quantity, price, order_type, rs_id) 
            VALUES ('" . $_SESSION["user_id"] . "', '" . $item["title"] . "', '" . $item["quantity"] . "', '" . $item["price"] . "', '" . $orderType . "', '" . $rs_id . "')";
        mysqli_query($db, $SQL);

        unset($_SESSION["cart_item"]);
        unset($item["title"]);
        unset($item["quantity"]);
        unset($item["price"]);
        echo "<script>alert('Thank you. Your Order has been placed!');</script>";
        echo "<script>window.location.replace('orders.php');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CenDash | Checkout</title>
    <link rel="icon" href="src/assets/images/logo.png">
    <link rel="stylesheet" href="src/styles/css/loader.css">
    <link rel="stylesheet" href="node_modules/@fortawesome/fontawesome-free/css/all.css">
    <link rel="stylesheet" href="src/styles/css/navbar.css">
    <link rel="stylesheet" href="src/styles/css/main.css">
    <link rel="stylesheet" href="src/styles/css/footer.css">
    <link rel="stylesheet" href="src/styles/css/bootstrap.min.css">
</head>

<body>
    <div class="loader">
        <h1 class="loader-title">Now Loading...</h1>
        <div class="cooking">
            <div class="bubble"></div>
            <div class="bubble"></div>
            <div class="bubble"></div>
            <div class="bubble"></div>
            <div class="bubble"></div>
            <div id=area>
                <div id="sides">
                    <div id="pan"></div>
                    <div id="handle"></div>
                </div>
                <div id="pancake">
                    <div id="pastry"></div>
                </div>
            </div>
        </div>
    </div>

    <?php
    $loggedInUser = !empty($_SESSION["user_id"]);
    $loggedInAdmin = !empty($_SESSION["adm_id"]);
    $loggedInVendor = !empty($_SESSION["vendor_user_id"]);
    ?>

    <nav class="nav" id="nav">
        <div class="nav-container">
            <div class="nav-title">
                <a href=".">
                    <img src="src/assets/images/logo.png">
                    <h1>CenDash</h1>
                </a>
            </div>
            <nav>
                <div class="nav-mobile"><a id="nav-toggle"><span></span></a></div>
                <ul class="nav-list">
                    <li><a href="."><i class="fa fa-home"></i>Home</a></li>
                    <li><a href="vendors.php"><i class="fa fa-store"></i>Vendors</a></li>
                    <?php if (!$loggedInUser && !$loggedInAdmin && !$loggedInVendor) : ?>
                        <li><a href="#" class="nav-button">Login</a>
                            <ul class="nav-dropdown">
                                <li><a href="login.php"><i class="fa-solid fa-down-left-and-up-right-to-center"></i>Login User</a></li>
                                <li><a href="admin/"><i class="fa-solid fa-down-left-and-up-right-to-center"></i>Login Admin</a></li>
                                <li><a href="adminVendor/"><i class="fa-solid fa-down-left-and-up-right-to-center"></i>Login Vendor</a></li>
                                <li><a href="signup.php"><i class="fa-solid fa-user-plus"></i>Sign Up</a></li>
                            </ul>
                        </li>
                    <?php elseif ($loggedInUser && !$loggedInAdmin && !$loggedInVendor) : ?>
                        <li><a href="orders.php"><i class="fa fa-cart-shopping"></i>My Orders</a></li>
                        <li><a href="#" class="nav-button">Account</a>
                            <ul class="nav-dropdown">
                                <li><a href="#" onclick="logOutUser()"><i class="fa-solid fa-right-to-bracket"></i>Logout User</a></li>
                                <li><a href="admin/"><i class="fa-solid fa-down-left-and-up-right-to-center"></i>Login Admin</a></li>
                                <li><a href="adminVendor/"><i class="fa-solid fa-down-left-and-up-right-to-center"></i>Login Vendor</a></li>
                                <li><a href="profile.php?user_upd=<?= $_SESSION['user_id'] ?>"><i class="fa-solid fa-user"></i>My Profile</a></li>
                            </ul>
                        </li>
                    <?php elseif (!$loggedInUser && $loggedInAdmin && !$loggedInVendor) : ?>
                        <li><a href="#" class="nav-button">Account</a>
                            <ul class="nav-dropdown">
                                <li><a href="login.php"><i class="fa-solid fa-down-left-and-up-right-to-center"></i>Login User</a></li>
                                <li><a href="#" onClick="logOutAdmin()"><i class="fa-solid fa-right-to-bracket"></i>Logout Admin</a></li>
                                <li><a href="adminVendor/"><i class="fa-solid fa-down-left-and-up-right-to-center"></i>Login Vendor</a></li>
                                <li><a href="signup.php"><i class="fa-solid fa-user-plus"></i>Sign Up</a></li>
                                <li><a href="admin/"><i class="fa-solid fa-user"></i>Admin</a></li>
                            </ul>
                        </li>
                    <?php elseif (!$loggedInUser && !$loggedInAdmin && $loggedInVendor) : ?>
                        <li><a href="#" class="nav-button">Account</a>
                            <ul class="nav-dropdown">
                                <li><a href="login.php"><i class="fa-solid fa-down-left-and-up-right-to-center"></i>Login User</a></li>
                                <li><a href="admin/"><i class="fa-solid fa-right-to-bracket"></i>Login Admin</a></li>
                                <li><a href="#" onclick="logOutVendor()"><i class="fa-solid fa-down-left-and-up-right-to-center"></i>Logout Vendor</a></li>
                                <li><a href="signup.php"><i class="fa-solid fa-user-plus"></i>Sign Up</a></li>
                                <li><a href="adminVendor/"><i class="fa-solid fa-user"></i>Vendor</a></li>
                            </ul>
                        </li>
                    <?php elseif ($loggedInUser && !$loggedInAdmin && $loggedInVendor) : ?>
                        <li><a href="orders.php"><i class="fa fa-cart-shopping"></i>My Orders</a></li>
                        <li><a href="#" class="nav-button">Account</a>
                            <ul class="nav-dropdown">
                                <li><a href="#" onclick="logOutUser()"><i class="fa-solid fa-right-to-bracket"></i>Logout User</a></li>
                                <li><a href="../admin/"><i class="fa-solid fa-down-left-and-up-right-to-center"></i>Login Admin</a></li>
                                <li><a href="#" onclick="logOutVendor()"><i class="fa-solid fa-down-left-and-up-right-to-center"></i>Logout Vendor</a></li>
                                <li><a href="../profile.php?user_upd=<?= $_SESSION['user_id'] ?>"><i class="fa-solid fa-user"></i>My Profile</a></li>
                                <li><a href="../adminVendor/"><i class="fa-solid fa-user"></i>Vendor</a></li>
                            </ul>
                        </li>
                    <?php elseif (!$loggedInUser && $loggedInAdmin && $loggedInVendor) : ?>
                        <li><a href="#" class="nav-button">Account</a>
                            <ul class="nav-dropdown">
                                <li><a href="../login.php"><i class="fa-solid fa-down-left-and-up-right-to-center"></i>Login User</a></li>
                                <li><a href="#" onclick="logOutAdmin()"><i class="fa-solid fa-right-to-bracket"></i>Logout Admin</a></li>
                                <li><a href="#" onclick="logOutVendor()"><i class="fa-solid fa-down-left-and-up-right-to-center"></i>Logout Vendor</a></li>
                                <li><a href="../signup.php"><i class="fa-solid fa-user-plus"></i>Sign Up</a></li>
                                <li><a href="../admin/"><i class="fa-solid fa-user"></i>Admin</a></li>
                                <li><a href="adminVendor/"><i class="fa-solid fa-user"></i>Vendor</a></li>
                            </ul>
                        </li>
                    <?php elseif ($loggedInUser && $loggedInAdmin && $loggedInVendor) : ?>
                        <li><a href="orders.php"><i class="fa fa-cart-shopping"></i>My Orders</a></li>
                        <li><a href="#" class="nav-button">Account</a>
                            <ul class="nav-dropdown">
                                <li><a href="#" onclick="logOutUser()"><i class="fa-solid fa-right-to-bracket"></i>Logout User</a></li>
                                <li><a href="#" onclick="logOutAdmin()"><i class="fa-solid fa-right-to-bracket"></i>Logout Admin</a></li>
                                <li><a href="#" onclick="logOutVendor()"><i class="fa-solid fa-right-to-bracket"></i>Logout Vendor</a></li>
                                <li><a href="profile.php?user_upd=<?= $_SESSION['user_id'] ?>"><i class="fa-solid fa-user"></i>My Profile</a></li>
                                <li><a href="admin/"><i class="fa-solid fa-user"></i>Admin</a></li>
                                <li><a href="adminVendor/"><i class="fa-solid fa-user"></i>Vendor</a></li>
                            </ul>
                        </li>
                    <?php elseif ($loggedInUser && $loggedInAdmin && !$loggedInVendor) : ?>
                        <li><a href="orders.php"><i class="fa fa-cart-shopping"></i>My Orders</a></li>
                        <li><a href="#" class="nav-button">Account</a>
                            <ul class="nav-dropdown">
                                <li><a href="#" onclick="logOutUser()"><i class="fa-solid fa-right-to-bracket"></i>Logout User</a></li>
                                <li><a href="#" onclick="logOutAdmin()"><i class="fa-solid fa-right-to-bracket"></i>Logout Admin</a></li>
                                <li><a href="adminVendor/"><i class="fa-solid fa-down-left-and-up-right-to-center"></i>Login Vendor</a></li>
                                <li><a href="profile.php?user_upd=<?= $_SESSION['user_id'] ?>"><i class="fa-solid fa-user"></i>My Profile</a></li>
                                <li><a href="admin/"><i class="fa-solid fa-user"></i>Admin</a></li>
                            </ul>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </nav>

    <div class="page-wrapper">
        <div class="top-links">
            <ul class="links">
                <li class="link-item"><a href="#"><span>1</span>Choose Vendors!</a></li>
                <li class="link-item"><a href="#"><span>2</span>Pick Food!</a></li>
                <li class="link-item active"><a href="#"><span>3</span>Order and Pay!</a></li>
            </ul>
        </div>
        <div class="container">
            <form action="" method="post">
                <div class="widget">
                    <div class="widget-body">
                        <form method="post" action="#">
                            <div class="order-type">
                                <h3>Order Type</h3>
                                <label class="custom-control custom-radio">
                                    <input name="order_type" id="radioDineIn" value="Dine In" type="radio" class="custom-control-input" checked>
                                    <span class="custom-control-indicator"></span>
                                    <span class="custom-control-description">Dine In</span>
                                </label>
                                <label class="custom-control custom-radio">
                                    <input name="order_type" id="radioTakeOut" value="Take Out" type="radio" class="custom-control-input">
                                    <span class="custom-control-indicator"></span>
                                    <span class="custom-control-description">Take Out</span>
                                </label>
                            </div>
                            <div class="cart-totals">
                                <div class="cart-totals-title">
                                    <h4>Cart Summary</h4>
                                </div>
                                <div class="cart-totals-fields">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td class="text-color"><strong>Total</strong></td>
                                                <td class="text-color"><strong> <?php echo "₱" . $item_total; ?></strong></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="payment-option">
                                <ul class=" list-unstyled">
                                    <li>
                                        <label class="custom-control custom-radio">
                                            <input name="mod" id="radioStacked1" checked value="COD" type="radio" class="custom-control-input"> <span class="custom-control-indicator"></span> <span class="custom-control-description">Cash Payment</span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="custom-control custom-radio">
                                            <input name="mod" type="radio" value="paypal" disabled class="custom-control-input"> <span class="custom-control-indicator"></span> <span class="custom-control-description">Other Options <img src="src/assets/images/card-options.jpg" alt="" width="90"></span> </label>
                                    </li>
                                </ul>
                                <p class="text-xs-center"> <input type="submit" onclick="return confirm('Do you want to confirm the order?');" name="submit" class="btn btn-success btn-block" value="Order Now"> </p>
                            </div>
                        </form>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <footer>
        <div class="footer-container">
            <div>
                <h3>Join Us</h3>
                <p>Join other vendors who benefit from having partnered with us.</p>
            </div>
            <div>
                <p><a href="../"><b>&copy; 2023</b>, <b>CenDash</b>.</a> All rights reserved.</p>
            </div>
        </div>
    </footer>
    </div>
    </div>
    <script src="src/scripts/userAction/userAction.js"></script>
    <script src="src/scripts/main.js"></script>
</body>

</html>