<?php
include("../src/scripts/db/connect.php");
if (empty($_SESSION["adm_id"])) {
    header('location:login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>CenDash | Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <nav class="nav">
        <a class="navbar-brand" href="../">
            <img src="../src/assets/images/logo.png" alt="logo" style="height: 50px; width: 50px;" />
            CenDash Admin
        </a>
    </nav>

    <div class="nav-toggle">
        <i class="fa fa-arrow-left"></i>
    </div>

    <div class="left-sidebar active">
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="nav-devider"></li>
                <li><a href="index.php"><i class="fa fa-tachometer"></i><span>Dashboard</span></a></li>
                <li><a href="all_users.php"> <span><i class="fa fa-user f-s-20 "></i></span><span>Users</span></a></li>
                <li><a class="has-arrow" href="#" aria-expanded="false"><i class="fa fa-cutlery" aria-hidden="true"></i><span class="hide-menu">Menu</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="new_food.php">Add Menu</a></li>
                        <li><a href="all_menu.php">View All Menus</a></li>
                    </ul>
                </li>
                <li><a class="has-arrow" href="#" aria-expanded="false"><i class="fa fa-archive f-s-20 color-warning"></i><span class="hide-menu">Vendors</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="new_vendor.php">Add Vendors</a></li>
                        <li><a href="new_category.php">Add Category</a></li>
                        <li><a href="all_vendors.php">View All Vendors</a></li>
                    </ul>
                </li>
                <li><a href="all_orders.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i><span>Orders</span></a></li>
                <hr>
                <li><a href="#" onclick="logOutAdmin()"><i class="fa fa-power-off"></i> Logout</a></li>
            </ul>
        </nav>
    </div>

    <div class="card card-outline-primary">
        <div class="card-header">
            <h4 class="text-white">Dashboard</h4>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="card p-30">
                    <div class="media">
                        <div>
                            <span><i class="fa fa-home f-s-40"></i></span>
                        </div>
                        <div class="media-body">
                            <h2>
                                <?php $sql = "select * from vendor";
                                $result = mysqli_query($db, $sql);
                                $rws = mysqli_num_rows($result);
                                echo $rws; ?>
                            </h2>
                            <p>Vendors</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card p-30">
                    <div class="media">
                        <div class="media-left meida media-middle">
                            <span><i class="fa fa-cutlery f-s-40" aria-hidden="true"></i></span>
                        </div>
                        <div class="media-body media-text-right">
                            <h2><?php $sql = "select * from foods";
                                $result = mysqli_query($db, $sql);
                                $rws = mysqli_num_rows($result);
                                echo $rws; ?></h2>
                            <p>Foods</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card p-30">
                    <div class="media">
                        <div class="media-left meida media-middle">
                            <span><i class="fa fa-users f-s-40"></i></span>
                        </div>
                        <div class="media-body media-text-right">
                            <h2><?php $sql = "select * from users";
                                $result = mysqli_query($db, $sql);
                                $rws = mysqli_num_rows($result);

                                echo $rws; ?></h2>
                            <p>Users</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card p-30">
                    <div class="media">
                        <div class="media-left meida media-middle">
                            <span><i class="fa fa-shopping-cart f-s-40" aria-hidden="true"></i></span>
                        </div>
                        <div class="media-body media-text-right">
                            <h2><?php $sql = "select * from users_orders";
                                $result = mysqli_query($db, $sql);
                                $rws = mysqli_num_rows($result);

                                echo $rws; ?></h2>
                            <p class="m-b-0">Total Orders</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card p-30">
                    <div class="media">
                        <div class="media-left media media-middle">
                            <span><i class="fa fa-th-large f-s-40" aria-hidden="true"></i></span>
                        </div>
                        <div class="media-body media-text-right">
                            <h2><?php $sql = "select * from vendor_group";
                                $result = mysqli_query($db, $sql);
                                $rws = mysqli_num_rows($result);

                                echo $rws; ?></h2>
                            <p>Vendor Categories</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card p-30">
                    <div class="media">
                        <div class="media-left meida media-middle">
                            <span><i class="fa fa-spinner f-s-40" aria-hidden="true"></i></span>
                        </div>
                        <div class="media-body media-text-right">
                            <h2><?php $sql = "select * from users_orders WHERE status = 'in process' ";
                                $result = mysqli_query($db, $sql);
                                $rws = mysqli_num_rows($result);

                                echo $rws; ?></h2>
                            <p>Processing Orders</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card p-30">
                    <div class="media">
                        <div class="media-left meida media-middle">
                            <span><i class="fa fa-check f-s-40" aria-hidden="true"></i></span>
                        </div>
                        <div class="media-body media-text-right">
                            <h2><?php $sql = "select * from users_orders WHERE status = 'closed' ";
                                $result = mysqli_query($db, $sql);
                                $rws = mysqli_num_rows($result);

                                echo $rws; ?></h2>
                            <p>Delivered Orders</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card p-30">
                    <div class="media">
                        <div class="media-left meida media-middle">
                            <span><i class="fa fa-times f-s-40" aria-hidden="true"></i></span>
                        </div>
                        <div class="media-body media-text-right">
                            <h2><?php $sql = "select * from users_orders WHERE status = 'rejected' ";
                                $result = mysqli_query($db, $sql);
                                $rws = mysqli_num_rows($result);
                                echo $rws; ?></h2>
                            <p class="m-b-0">Cancelled Orders</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="js/sidebarmenu.js"></script>
    <script src="js/sticky-kit.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="../src/scripts/userAction/userAction.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const sidebar = document.querySelector('.left-sidebar');
            const button = document.querySelector('.nav-toggle');
            button.addEventListener('click', () => {
                sidebar.classList.toggle('active');
            });
        });
    </script>
</body>

</html>