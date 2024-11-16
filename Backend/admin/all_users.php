<?php
include("../src/scripts/db/connect.php");

if (empty($_SESSION["adm_id"])) {
    header('location:login.php');
    exit;
}

if (isset($_GET['user_del'])) {
    $deleteUserId = $_GET['user_del'];
    mysqli_query($db,"DELETE FROM users WHERE u_id = '$deleteUserId'");
    header("location:all_users.php");  
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CenDash | Users</title>
    <link rel="icon" href="../images/icn.png">
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
                            <div class="dropdown-menu dropdown-menu-right mailbox animated zoomIn">
                                <ul>
                                    <li>
                                        <div class="drop-title">Notifications</div>
                                    </li>
                                    
                                    <li>
                                        <a class="nav-link text-center" href="javascript:void(0);"> <strong>Check all notifications</strong> <i class="fa fa-angle-right"></i> </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
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
                            <li class="nav-label">Log</li>
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
                                <h4 class="m-b-0 text-white">All Users</h4>
                            </div> 
                                <div class="table-responsive m-t-40">
                                    <table id="myTable" class="table table-bordered table-striped table-hover">
                                    <thead class="thead-dark">
                                            <tr>
                                                <th>Username</th>
                                                <th>Firstname</th>
                                                <th>Lastname</th>
                                                <th>Email</th>
                                                <th>Phone</th>												
												<th>Registration Date</th>
												<th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>		
											<?php
												$sql="SELECT * FROM users order by u_id desc";
												$query=mysqli_query($db,$sql);
													if(!mysqli_num_rows($query) > 0 ){
															echo '<td colspan="7"><center>No Users</center></td>';
														}
													else{				
													    while($rows=mysqli_fetch_array($query)){	
															echo 
                                                            ' 
                                                            <tr>
                                                                <td>'.$rows['username'].'</td>
																<td>'.$rows['f_name'].'</td>
																<td>'.$rows['l_name'].'</td>
																<td>'.$rows['email'].'</td>
																<td>'.$rows['phone'].'</td>																							
																<td>'.$rows['date'].'</td>
																<td>
                                                                    <a href="?user_del='.$rows['u_id'].'" class="btn btn-danger btn-flat btn-addon btn-xs m-b-10"><i class="fa fa-trash-o" style="font-size:16px"></i></a> 
																	<a href="update_users.php?user_upd='.$rows['u_id'].'" " class="btn btn-info btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="fa fa-edit"></i></a>
																</td>
                                                            </tr>
                                                            ';
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
                </div>
            </div>
        </div>
    </div>
    <script src="../node_modules/jquery/dist/jquery.min.js"></script>>
    <script src="js/jquery.slimscroll.js"></script>
    <script src="js/sidebarmenu.js"></script>
    <script src="js/sticky-kit.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="../src/scripts/userAction/userAction.js"></script>
</body>
</html>