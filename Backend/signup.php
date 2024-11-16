<?php
include("src/scripts/db/connect.php");
if (isset($_POST['submit'])) {
    $msg = "";
    $fields = ['firstname', 'lastname', 'email', 'phone', 'password', 'cpassword'];
    $requiredFields = array_filter($fields, function ($field) {
        return empty($_POST[$field]);
    });
    if (!empty($requiredFields)) {
        $msg = "All fields are required!";
    } else {
        $check_username = mysqli_query($db, "SELECT username FROM users WHERE username = '" . $_POST['username'] . "'");
        $check_email = mysqli_query($db, "SELECT email FROM users WHERE email = '" . $_POST['email'] . "'");
        $passwordMismatch = ($_POST['password'] != $_POST['cpassword']);
        $invalidPhoneNumber = !is_numeric($_POST['phone']);
        $invalidEmail = (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));
        if ($passwordMismatch) {
            $msg = "Password does not match";
        } elseif ($invalidPhoneNumber) {
            $msg = "Invalid phone number!";
        } elseif ($invalidEmail) {
            $msg = "Invalid email address, please enter a valid email!";
        } elseif (mysqli_num_rows($check_username) > 0) {
            $msg = "Username already exists!";
        } elseif (mysqli_num_rows($check_email) > 0) {
            $msg = "Email already exists!";
        } else {
            $hashedPassword = md5($_POST['password']);
            $mql = "INSERT INTO users(username,f_name,l_name,email,phone,password,address) 
         VALUES('" . $_POST['username'] . "','" . $_POST['firstname'] . "','" . $_POST['lastname'] . "','" . $_POST['email'] . "','" . $_POST['phone'] . "','" . $hashedPassword . "','" . $_POST['address'] . "')";
            mysqli_query($db, $mql);
            $msg = "Signup successful! Redirecting to login page...";
            header("refresh:3;url=login.php");
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CenDash | Sign Up</title>
    <link rel="icon" href="src/assets/images/logo.png">
    <link rel="stylesheet" href="src/styles/css/loader.css">
    <link rel="stylesheet" href="node_modules/@fortawesome/fontawesome-free/css/all.css">
    <link rel="stylesheet" href="src/styles/css/signup.css">
    <link rel="stylesheet" href="src/styles/css/footer.css">
    <link rel="stylesheet" href="src/styles/css/navbar.css">
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

    <div class="signup-container">
        <div class="form-module">
            <div class="form">
                <h3 class="form-title">CenDash Sign Up</h3>
                <?php
                if (stripos($msg, "success") !== false) {
                    echo '<p style="color: green;">' . $msg . '</p>';
                } else {
                    echo '<p style="color: red;">' . $msg . '</p>';
                }
                ?>
                <form action="" method="post">
                    <div>
                        <label>Username</label><input type="text" name="username" id="username" placeholder="Username...">
                    </div>
                    <div class="container">
                        <div>
                            <label>First Name</label><input type="text" name="firstname" id="firstname" placeholder="First Name... (eg. Saira)">
                        </div>
                        <div>
                            <label>Last Name</label><input type="text" name="lastname" id="lastname" placeholder="Last Name... (eg. de Mesa)">
                        </div>
                    </div>
                    <div class="container">
                        <div>
                            <label>Email Address</label><input type="text" name="email" id="email" placeholder="(eg. example@gmail.com)">
                        </div>
                        <div>
                            <label>Phone Number</label><input type="text" name="phone" id="phone" placeholder="(eg. 09123456789)">
                        </div>
                    </div>
                    <div>
                        <label>Password</label><input type="password" name="password" id="password" placeholder="Password...">
                    </div>
                    <div>
                        <label>Confirm Password</label><input type="password" name="cpassword" id="cpassword" placeholder="Confirm Your Password...">
                    </div>
                    <div class="button">
                        <p><input type="submit" value="SIGNUP" name="submit"></p>
                    </div>
                </form>
            </div>
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
    <script src="src/scripts/userAction/userAction.js"></script>
    <script src="src/scripts/main.js"></script>
</body>

</html>