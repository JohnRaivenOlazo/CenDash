<?php
include("src/scripts/db/connect.php");
include("src/scripts/foodAction/foodAction.php");

$vendor = mysqli_query($db, "select * from vendor where rs_id='$_GET[res_id]'");
$rows = mysqli_fetch_array($vendor);

$stmt = $db->prepare("select * from foods where rs_id='$_GET[res_id]'");
$stmt->execute();
$products = $stmt->get_result();

$item_total = 0;

if (empty($rows['image']) && empty($rows['title'])) {
    echo '<script>alert("Apologies, no CenDash food were found.");</script>';
    header("refresh: 0; url=.");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CenDash | Foods</title>
    <link rel="stylesheet" href="src/styles/css/loader.css">
    <link rel="stylesheet" href="node_modules/@fortawesome/fontawesome-free/css/all.css">
    <link rel="stylesheet" href="src/styles/css/navbar.css">
    <link rel="stylesheet" href="src/styles/css/footer.css">
    <link rel="stylesheet" href="src/styles/css/main.css">
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
                <li class="link-item active"><a href="?res_id=<?php echo $_GET['res_id']; ?>"><span>2</span>Pick Food!</a></li>
                <li class="link-item"><a href="#"><span>3</span>Order and Pay!</a></li>
            </ul>
        </div>
        <section class="inner-page-hero">
            <div class="profile">
                <div class="container">
                    <div class="profile-img">
                        <div class="image-wrap">
                            <figure>
                                <?php echo '<img src="../src/assets/vendorassets/' . $rows['image'] . '">'; ?>
                            </figure>
                        </div>
                    </div>
                    <div class="profile-desc">
                        <div>
                            <h6><a href="#"><?php echo $rows['title']; ?></a></h6>
                            <p>Central Market, New Era, Quezon City</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="widget-cart">
            <div class="widget-heading">
                <h3 class="widget-title">Your Cart</h3>
            </div>
            <div class="widget-body">
                <?php
                foreach ($_SESSION["cart_item"] as $item) {
                ?>
                    <div class="title-row">
                        <?php echo $item["title"]; ?>
                        <a href="?res_id=<?php echo $_GET['res_id']; ?>&action=remove&id=<?php echo $item["d_id"]; ?>">
                            <i class="fa fa-trash pull-right"></i>
                        </a>
                    </div>
                    <div class="form-group row">
                        <div class="col-xs-8">
                            <input type="text" class="form-control" value=<?php echo "₱" . $item["price"]; ?> readonly id="exampleSelect1">
                        </div>
                        <div class="col-xs-4">
                            <input class="form-control" type="text" readonly value='<?php echo $item["quantity"]; ?>' id="example-number-input">
                        </div>
                    </div>
                <?php
                    $item_total += ($item["price"] * $item["quantity"]);
                }
                ?>
            </div>
        </div>

        <div class="widget-body">
            <div class="price-wrap text-xs-center">
                <p>TOTAL</p>
                <h3 class="value"><strong>₱<?= $item_total ?></strong></h3>
                <a href="checkout.php?res_id=<?= $_GET['res_id'] ?>&action=check" class="btn <?= $item_total == 0 ? 'btn-danger disabled' : 'btn-success active' ?>">
                    <?= $item_total == 0 ? 'Your Cart is Empty!' : 'Order Now!' ?>
                </a>
            </div>
        </div>

        <div class="menu-widget" id="2">
            <div class="collapse in">
                <?php
                if (!empty($products)) {
                    foreach ($products as $product) {
                ?>
                        <div class="food-item">
                            <div class="row">
                                <form method="post" action='foods.php?res_id=<?php echo $_GET['res_id']; ?>&action=add&id=<?php echo $product['d_id']; ?>'>
                                    <div class="rest-descr">
                                        <div>
                                            <a class="logo" href="#">
                                                <?php echo '<img src="../src/assets/vendorassets/foods/' . $product['img'] . '" >'; ?>
                                            </a>
                                        </div>
                                        <div>
                                            <h6><a href="#"><?php echo $product['title']; ?></a></h6>
                                            <p> <?php echo $product['slogan']; ?></p>
                                        </div>
                                        <span class="price">₱<?php echo $product['price']; ?></span>
                                        <input type="text" name="quantity" value="1" size="1" />
                                        <input type="submit" class="btn theme-btn" value="Add To Cart" />
                                    </div>
                                </form>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>
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