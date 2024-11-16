<?php
include("../src/scripts/db/connect.php");

if (empty($_SESSION['vendor_user_id'])) {
    header('location:signin.php');
} else {
    $vendorId = $_SESSION['vendor_user_id'];

    if (isset($_GET['order_del'])) {
        $orderId = $_GET['order_del'];
        $deleteOrderQuery = "DELETE FROM users_orders WHERE o_id = $orderId";
        mysqli_query($db, $deleteOrderQuery);
        header("Location: index.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>CenDash | Admin Vendors</title>
    <link rel="icon" href="../src/assets/images/logo.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../node_modules/@fortawesome/fontawesome-free/css/all.css">
    <link rel="stylesheet" href="../src/styles/css/navbar.css">
    <link rel="stylesheet" href="../src/styles/css/adminVendor/main.css">
    <link rel="stylesheet" href="../src/styles/css/main.css">
</head>

<body>
    <?php
    $loggedInUser = !empty($_SESSION["user_id"]);
    $loggedInAdmin = !empty($_SESSION["adm_id"]);
    $loggedInVendor = !empty($_SESSION["vendor_user_id"]);
    ?>

    <nav class="nav" id="nav">
        <div class="nav-container">
            <div class="nav-title">
                <a href="../">
                    <img src="../src/assets/images/logo.png">
                    <h1>CenDash</h1>
                </a>
            </div>
            <nav>
                <div class="nav-mobile"><a id="nav-toggle"><span></span></a></div>
                <ul class="nav-list">
                    <li><a href="../"><i class="fa fa-home"></i>Home</a></li>
                    <li><a href="../vendors.php"><i class="fa fa-store"></i>Vendors</a></li>
                    <?php if (!$loggedInUser && !$loggedInAdmin && !$loggedInVendor) : ?>
                        <li><a href="#" class="nav-button">Login</a>
                            <ul class="nav-dropdown">
                                <li><a href="../login.php"><i class="fa-solid fa-down-left-and-up-right-to-center"></i>Login User</a></li>
                                <li><a href="../admin/"><i class="fa-solid fa-down-left-and-up-right-to-center"></i>Login Admin</a></li>
                                <li><a href="../adminVendor/"><i class="fa-solid fa-down-left-and-up-right-to-center"></i>Login Vendor</a></li>
                                <li><a href="../signup.php"><i class="fa-solid fa-user-plus"></i>Sign Up</a></li>
                            </ul>
                        </li>
                    <?php elseif ($loggedInUser && !$loggedInAdmin && !$loggedInVendor) : ?>
                        <li><a href="../orders.php"><i class="fa fa-cart-shopping"></i>My Orders</a></li>
                        <li><a href="#" class="nav-button">Account</a>
                            <ul class="nav-dropdown">
                                <li><a href="#" onclick="logOutUser()"><i class="fa-solid fa-right-to-bracket"></i>Logout User</a></li>
                                <li><a href="../admin/"><i class="fa-solid fa-down-left-and-up-right-to-center"></i>Login Admin</a></li>
                                <li><a href="../adminVendor/"><i class="fa-solid fa-down-left-and-up-right-to-center"></i>Login Vendor</a></li>
                                <li><a href="../profile.php?user_upd=<?= $_SESSION['user_id'] ?>"><i class="fa-solid fa-user"></i>My Profile</a></li>
                            </ul>
                        </li>
                    <?php elseif (!$loggedInUser && $loggedInAdmin && !$loggedInVendor) : ?>
                        <li><a href="#" class="nav-button">Account</a>
                            <ul class="nav-dropdown">
                                <li><a href="../login.php"><i class="fa-solid fa-down-left-and-up-right-to-center"></i>Login User</a></li>
                                <li><a href="#" onClick="logOutAdmin()"><i class="fa-solid fa-right-to-bracket"></i>Logout Admin</a></li>
                                <li><a href="../adminVendor/"><i class="fa-solid fa-down-left-and-up-right-to-center"></i>Login Vendor</a></li>
                                <li><a href="../signup.php"><i class="fa-solid fa-user-plus"></i>Sign Up</a></li>
                                <li><a href="../admin/"><i class="fa-solid fa-user"></i>Admin</a></li>
                            </ul>
                        </li>
                    <?php elseif (!$loggedInUser && !$loggedInAdmin && $loggedInVendor) : ?>
                        <li><a href="#" class="nav-button">Account</a>
                            <ul class="nav-dropdown">
                                <li><a href="../login.php"><i class="fa-solid fa-down-left-and-up-right-to-center"></i>Login User</a></li>
                                <li><a href="../admin/"><i class="fa-solid fa-right-to-bracket"></i>Login Admin</a></li>
                                <li><a href="#" onclick="logOutVendor()"><i class="fa-solid fa-down-left-and-up-right-to-center"></i>Logout Vendor</a></li>
                                <li><a href="../signup.php"><i class="fa-solid fa-user-plus"></i>Sign Up</a></li>
                                <li><a href="../adminVendor/"><i class="fa-solid fa-user"></i>Vendor</a></li>
                            </ul>
                        </li>
                    <?php elseif ($loggedInUser && !$loggedInAdmin && $loggedInVendor) : ?>
                        <li><a href="../orders.php"><i class="fa fa-cart-shopping"></i>My Orders</a></li>
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
                                <li><a href="../adminVendor/"><i class="fa-solid fa-user"></i>Vendor</a></li>
                            </ul>
                        </li>
                    <?php elseif ($loggedInUser && $loggedInAdmin && $loggedInVendor) : ?>
                        <li><a href="../orders.php"><i class="fa fa-cart-shopping"></i>My Orders</a></li>
                        <li><a href="#" class="nav-button">Account</a>
                            <ul class="nav-dropdown">
                                <li><a href="#" onclick="logOutUser()"><i class="fa-solid fa-right-to-bracket"></i>Logout User</a></li>
                                <li><a href="#" onclick="logOutAdmin()"><i class="fa-solid fa-right-to-bracket"></i>Logout Admin</a></li>
                                <li><a href="#" onclick="logOutVendor()"><i class="fa-solid fa-right-to-bracket"></i>Logout Vendor</a></li>
                                <li><a href="../profile.php?user_upd=<?= $_SESSION['user_id'] ?>"><i class="fa-solid fa-user"></i>My Profile</a></li>
                                <li><a href="../admin/"><i class="fa-solid fa-user"></i>Admin</a></li>
                                <li><a href="../adminVendor/"><i class="fa-solid fa-user"></i>Vendor</a></li>
                            </ul>
                        </li>
                    <?php elseif ($loggedInUser && $loggedInAdmin && !$loggedInVendor) : ?>
                        <li><a href="../orders.php"><i class="fa fa-cart-shopping"></i>My Orders</a></li>
                        <li><a href="#" class="nav-button">Account</a>
                            <ul class="nav-dropdown">
                                <li><a href="#" onclick="logOutUser()"><i class="fa-solid fa-right-to-bracket"></i>Logout User</a></li>
                                <li><a href="#" onclick="logOutAdmin()"><i class="fa-solid fa-right-to-bracket"></i>Logout Admin</a></li>
                                <li><a href="../adminVendor/"><i class="fa-solid fa-down-left-and-up-right-to-center"></i>Login Vendor</a></li>
                                <li><a href="../profile.php?user_upd=<?= $_SESSION['user_id'] ?>"><i class="fa-solid fa-user"></i>My Profile</a></li>
                                <li><a href="../admin/"><i class="fa-solid fa-user"></i>Admin</a></li>
                            </ul>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </nav>


    <div class="card">
        <table>
            <caption class="card-header">My Vendor</caption>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Operating Hours</th>
                    <th>Open Days</th>
                    <th>Image</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT r.*, rc.c_name FROM vendor r 
                            JOIN vendor_group rc ON r.c_id = rc.c_id
                            WHERE r.rs_id = $vendorId 
                            ORDER BY r.rs_id DESC";
                $query = mysqli_query($db, $sql);
                if (!mysqli_num_rows($query) > 0) {
                    echo '<td colspan="11">No Vendors</td>';
                } else {
                    while ($rows = mysqli_fetch_array($query)) {
                        echo ' 
                    <tr>
                    <td>' . $rows['title'] . '</td>
                    <td>' . $rows['c_name'] . '</td>
                    <td>' . $rows['email'] . '</td>
                    <td>' . $rows['phone'] . '</td>
                    <td>' . $rows['o_hr'] . '</td>
                    <td>' . $rows['o_days'] . '</td>	
                    <td>
                        <div>
                            <img src="../src/assets/vendorassets/' . $rows['image'] . '"/>
                        </div>
                    </td>
                    <td>' . $rows['date'] . '</td>
                    <td>
                        <a href="update_vendor.php?res_upd=' . $rows['rs_id'] . '" class="btn">
                            <i class="fa fa-edit">EDIT</i>
                        </a>
                    </td>
                    </tr>
                    ';
                    }
                }
                ?>
            </tbody>
        </table>

    </div>
    <div id="main-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="col-lg-12">
                        <div class="card card-outline-primary">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white">My Customer Order</h4>
                            </div>
                            <div class="table-responsive m-t-40">
                                <table id="myTable" class="table table-bordered table-striped">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>User</th>
                                            <th>Food</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Status</th>
                                            <th>Reg-Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "SELECT users.*, users_orders.* FROM users 
                                            JOIN users_orders ON users.u_id=users_orders.u_id 
                                            WHERE users_orders.rs_id = $vendorId";
                                        $query = mysqli_query($db, $sql);
                                        if (!mysqli_num_rows($query) > 0) {
                                            echo '<td colspan="8"><center>No Orders</center></td>';
                                        } else {
                                            while ($rows = mysqli_fetch_array($query)) {
                                        ?>
                                                <?php
                                                echo ' <tr>
															<td>' . $rows['username'] . '</td>
															<td>' . $rows['title'] . '</td>
															<td>' . $rows['quantity'] . '</td>
															<td>₱' . $rows['price'] . '</td>';
                                                ?>
                                                <?php
                                                $status = $rows['status'];
                                                if ($status == "" or $status == "NULL") {
                                                ?>
                                                    <td> <button type="button" class="btn btn-info"><span class="fa fa-bars" aria-hidden="true"></span> Pending</button></td>
                                                <?php
                                                }
                                                if ($status == "in process") { ?>
                                                    <td> <button type="button" class="btn btn-warning"><span class="fa fa-cog fa-spin" aria-hidden="true"></span> On The Way!</button></td>
                                                <?php
                                                }
                                                if ($status == "closed") {
                                                ?>
                                                    <td> <button type="button" class="btn btn-primary"><span class="fa fa-check-circle" aria-hidden="true"></span> Delivered</button></td>
                                                <?php
                                                }
                                                ?>
                                                <?php
                                                if ($status == "rejected") {
                                                ?>
                                                    <td> <button type="button" class="btn btn-danger"> <i class="fa fa-close"></i> Cancelled</button></td>
                                                <?php
                                                }
                                                ?>
                                                <?php
                                                echo '	<td>' . $rows['date'] . '</td>';
                                                ?>
                                                <td>
                                                    <a href="?order_del=<?php echo $rows['o_id']; ?>" onclick="return confirm('Are you sure?');" class="btn btn-danger btn-flat btn-addon btn-xs m-b-10"><i class="fa fa-trash" style="font-size:16px"></i>TRASH</a>
                                            <?php
                                                echo '<a href="../admin/view_order.php?user_upd=' . $rows['o_id'] . '" " class="btn btn-info btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="fa fa-edit"></i>EDIT</a>
																									</td>
																									</tr>';
                                            }
                                        }
                                            ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="../src/scripts/userAction/userAction.js"></script>
    <script src="../src/scripts/main.js"></script>
</body>

</html>