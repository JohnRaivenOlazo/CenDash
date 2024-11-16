<?php
include("../src/scripts/db/connect.php");

if (empty($_SESSION["adm_id"])) {
    header('location:login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>View Order</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body class="fix-header fix-sidebar">
    <div id="main-wrapper">
        <div class="header">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php">
                        <span><img src="images/icn.png" alt="homepage" class="dark-logo" /></span>
                    </a>
                </div>
                <div class="navbar-collapse">
                    <ul class="navbar-nav mr-auto mt-md-0">
                    </ul>
                    <ul class="navbar-nav my-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted  " href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="images/bookingSystem/user-icn.png" alt="user" class="profile-pic" /></a>
                            <div class="dropdown-menu dropdown-menu-right animated zoomIn">
                                <ul class="dropdown-user">
                                    <li><a href="#" onclick="logOutAdmin()"><i class="fa fa-power-off"></i> Logout</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>

        <div class="left-sidebar">
            <div class="scroll-sidebar">
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="nav-devider"></li>
                        <li class="nav-label">Home</li>
                        <li><a href="index.php"><i class="fa fa-tachometer"></i><span>Dashboard</span></a></li>
                        <li><a href="all_users.php"> <span><i class="fa fa-user f-s-20 "></i></span><span>Users</span></a></li>
                        <li><a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-cutlery" aria-hidden="true"></i><span class="hide-menu">Menu</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="new_food.php">Add Menu</a></li>
                                <li><a href="all_menu.php">View All Menus</a></li>
                            </ul>
                        </li>
                        <li><a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-archive f-s-20 color-warning"></i><span class="hide-menu">Vendors</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="new_vendor.php">Add Vendors</a></li>
                                <li><a href="new_category.php">Add Category</a></li>
                                <li><a href="all_vendors.php">View All Vendors</a></li>
                            </ul>
                        </li>
                        <li><a href="all_orders.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i><span>Orders</span></a></li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="col-lg-12">
                            <div class="card card-outline-primary">
                                <div class="card-header">
                                    <h4 class="m-b-0 text-white">View Order</h4>
                                </div>
                                <div class="table-responsive m-t-20">
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <tbody>
                                            <?php
                                            $sql = "SELECT users.*, users_orders.* FROM users INNER JOIN users_orders ON users.u_id=users_orders.u_id where o_id='" . $_GET['user_upd'] . "'";
                                            $query = mysqli_query($db, $sql);
                                            $rows = mysqli_fetch_array($query);
                                            ?>
                                            <tr>
                                                <td><strong>Username:</strong></td>
                                                <td>
                                                    <center><?php echo $rows['username']; ?></center>
                                                </td>
                                                <td>
                                                    <center>
                                                        <a href="javascript:void(0);" onClick="popUpWindow('update_order.php?form_id=<?php echo htmlentities($rows['o_id']); ?>');" title="Update order">
                                                            <button type="button" class="btn btn-primary">Update Order Status</button></a>
                                                    </center>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Title:</strong></td>
                                                <td>
                                                    <center><?php echo $rows['title']; ?></center>
                                                </td>
                                                <td>
                                                    <center>
                                                        <a href="javascript:void(0);" onClick="popUpWindow('userprofile.php?newform_id=<?php echo htmlentities($rows['o_id']); ?>');" title="Update order">
                                                            <button type="button" class="btn btn-primary">View User Details</button></a>
                                                    </center>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Quantity:</strong></td>
                                                <td>
                                                    <center><?php echo $rows['quantity']; ?></center>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Price:</strong></td>
                                                <td>
                                                    <center>₱<?php echo $rows['price']; ?></center>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Order Type:</strong></td>
                                                <td>
                                                    <center><?php echo $rows['order_type']; ?></center>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Date:</strong></td>
                                                <td>
                                                    <center><?php echo $rows['date']; ?></center>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Status:</strong></td>
                                                <?php
                                                $status = $rows['status'];
                                                if ($status == "" or $status == "NULL") {
                                                ?>
                                                    <td>
                                                        <center><button type="button" class="btn btn-info"><span class="fa fa-bars" aria-hidden="true"></span> Pending</button></center>
                                                    </td>
                                                <?php
                                                }
                                                if ($status == "in process") { ?>
                                                    <td>
                                                        <center><button type="button" class="btn btn-warning"><span class="fa fa-cog fa-spin" aria-hidden="true"></span> On the Way!</button></center>
                                                    </td>
                                                <?php
                                                }
                                                if ($status == "closed") {
                                                ?>
                                                    <td>
                                                        <center><button type="button" class="btn btn-primary"><span class="fa fa-check-circle" aria-hidden="true"></span> Delivered</button></center>
                                                    </td>
                                                <?php
                                                }
                                                ?>
                                                <?php
                                                if ($status == "rejected") {
                                                ?>
                                                    <td>
                                                        <center><button type="button" class="btn btn-danger"> <i class="fa fa-close"></i> Cancelled</button> </center>
                                                    </td>
                                                <?php
                                                }
                                                ?>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
    <script src="../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="js/jquery.slimscroll.js"></script>
    <script src="js/sidebarmenu.js"></script>
    <script src="js/sticky-kit.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="../src/scripts/userAction/userAction.js"></script>
    <script>
const popUpWindow = (URLStr, width, height) => {

    if (window.popUpWin && !window.popUpWin.closed) {
        window.popUpWin.close();
    }

    window.popUpWin = window.open(URLStr, 'popUpWin', `width=1000,height=1000`);
};



    </script>
</body>

</html>