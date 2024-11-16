<?php
include("src/scripts/db/connect.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CenDash | Vendors</title>
    <link rel="icon" href="src/assets/images/logo.png">
    <link href="src/styles/css/bootstrap.min.css" rel="stylesheet">
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
                <li class="link-item active"><a href="#"><span>1</span>Choose Vendors!</a></li>
                <li class="link-item"><a href="#"><span>2</span>Pick Food!</a></li>
                <li class="link-item"><a href="#"><span>3</span>Order and Pay!</a></li>
            </ul>
        </div>
        <section class="vendors">
                <div class="vendor-container">
                    <div class="row">
                        <?php $ress = mysqli_query($db, "select * from vendor");
                        while ($rows = mysqli_fetch_array($ress)) {
                            echo
                            ' 
                                <div class="col-sm-12 col-md-12 col-lg-8 text-xs-center text-sm-left">
										<div class="entry-logo">
											<a class="img-fluid" href="foods.php?res_id=' . $rows['rs_id'] . '" > 
                                                <img src="../src/assets/vendorassets/' . $rows['image'] . '" alt="Food logo">
                                            </a>
										</div>
										<div class="entry-dscr">
											<h5><a href="foods.php?res_id=' . $rows['rs_id'] . '" >' . $rows['title'] . '</a></h5> 
										</div>
								</div>
								<div class="col-sm-12 col-md-12 col-lg-4 text-xs-center">
									<div class="right-content">
										<div class="right-review">
										<a href="foods.php?res_id=' . $rows['rs_id'] . '" class="btn">View Menu</a> 
                                        </div>
									</div>
								</div>
                                ';
                        }
                        ?>
                    </div>
                </div>
        </section>
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
        <script src="src/scripts/userAction/userAction.js"></script>
        <script src="src/scripts/main.js"></script>
</body>

</html>