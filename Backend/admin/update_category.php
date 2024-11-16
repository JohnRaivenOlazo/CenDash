<?php
include("../src/scripts/db/connect.php");

if (empty($_SESSION["adm_id"])) {
    header('location:login.php');
    exit;
}

if (isset($_POST['submit'])) {
    if (empty($_POST['c_name'])) {
        $error = '<div class="alert alert-danger alert-dismissible fade show">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>field Required!</strong>
			</div>';
    } else {
        $mql = "update vendor_group set c_name ='$_POST[c_name]' where c_id='$_GET[cat_upd]'";
        mysqli_query($db, $mql);
        $success =     '<div class="alert alert-success alert-dismissible fade show">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
					<strong>Updated!</strong> Successfully.</br>
                </div>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Update Category</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body class="fix-header">
    <div id="main-wrapper">
        <div class="left-sidebar">
            <div class="scroll-sidebar">
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="nav-devider"></li>
                        <li class="nav-label">Home</li>
                        <li> <a href="index.php"><i class="fa fa-tachometer"></i><span>Dashboard</span></a></li>
                        <li class="nav-label">Log</li>
                        <li> <a href="all_users.php"> <span><i class="fa fa-user f-s-20 "></i></span><span>Users</span></a></li>
                        <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-archive f-s-20 color-warning"></i><span class="hide-menu">Vendor</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="all_vendors.php">All Vendors</a></li>
                                <li><a href="new_category.php">Add Category</a></li>
                                <li><a href="new_vendor.php">Add Vendors</a></li>

                            </ul>
                        </li>
                        <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-cutlery" aria-hidden="true"></i><span class="hide-menu">Menu</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="all_menu.php">All Menues</a></li>
                                <li><a href="new_food.php">Add Menu</a></li>
                            </ul>
                        </li>
                        <li> <a href="all_orders.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i><span>Orders</span></a></li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="page-wrapper">
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary">Dashboard</h3>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="container-fluid">
                        <?php
                        echo $error;
                        echo $success; ?>
                        <div class="col-lg-12">
                            <div class="card card-outline-primary">
                                <div class="card-header">
                                    <h4 class="m-b-0 text-white">Update Vendor Category</h4>
                                </div>
                                <div class="card-body">
                                    <form action='' method='post'>
                                        <div class="form-body">
                                            <?php $ssql = "select * from vendor_group where c_id='$_GET[cat_upd]'";
                                            $res = mysqli_query($db, $ssql);
                                            $row = mysqli_fetch_array($res); ?>
                                            <hr>
                                            <div class="row p-t-20">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Category</label>
                                                        <input type="text" name="c_name" value="<?php echo $row['c_name'];  ?>" class="form-control" placeholder="Category Name">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-actions">
                                                <input type="submit" name="submit" class="btn btn-primary" value="Save">
                                                <a href="new_category.php" class="btn btn-inverse">Cancel</a>
                                            </div>
                                    </form>
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

</body>

</html>