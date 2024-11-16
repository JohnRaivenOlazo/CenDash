<?php
include("src/scripts/db/connect.php");

if (empty($_SESSION['user_id'])) {
	header('location:login.php');
}
if (isset($_GET['order_del'])) {
	mysqli_query($db, "DELETE FROM users_orders WHERE o_id = '" . $_GET['order_del'] . "'");
	header("location:orders.php");
	exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" href="src/assets/images/logo.png">
	<title>CenDash | My Orders</title>
	<link rel="stylesheet" href="src/styles/css/loader.css">
	<link rel="stylesheet" href="src/styles/css/navbar.css">
	<link rel="stylesheet" href="src/styles/css/main.css">
	<link rel="stylesheet" href="src/styles/css/footer.css">
	<link rel="stylesheet" href="src/styles/css/bootstrap.min.css">
	<link rel="stylesheet" href="node_modules/@fortawesome/fontawesome-free/css/all.css">
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

	<section class="orders">
		<div class="container" style="overflow-x: auto;">
			<div class="row">
				<div class="col-xs-12">
					<div class="bg-gray">
						<div class="row">
							<table class="table table-bordered table-hover">
								<thead style="background: #404040; color:white;">
									<tr>
										<th>Food Name</th>
										<th>Quantity</th>
										<th>Price</th>
										<th>Status</th>
										<th>Date</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$query_res = mysqli_query($db, "select * from users_orders where u_id='" . $_SESSION['user_id'] . "'");
									if (!mysqli_num_rows($query_res) > 0) {
										echo '<td colspan="6"><center>No orders have been placed yet.</center></td>';
									} else {
										while ($row = mysqli_fetch_array($query_res)) {
									?>
											<tr>
												<td data-column="Item"> <?php echo $row['title']; ?></td>
												<td data-column="Quantity"> <?php echo $row['quantity']; ?></td>
												<td data-column="price">₱<?php echo $row['price']; ?></td>
												<td data-column="status">
													<?php
													$status = $row['status'];
													switch ($status) {
														case '':
														case 'NULL':
															$class = 'info';
															$icon = 'clock';
															$text = 'Pending';
															break;
														case 'in process':
															$class = 'warning';
															$icon = 'cog fa-spin';
															$text = 'On The Way!';
															break;
														case 'closed':
															$class = 'success';
															$icon = 'check-circle';
															$text = 'Delivered';
															break;
														case 'rejected':
															$class = 'danger';
															$icon = 'close';
															$text = 'Cancelled';
															break;
														default:
															$class = '';
															$icon = '';
															$text = '';
													}

													if (!empty($class)) {
														echo '<button type="button" class="btn btn-' . $class . '"><span class="fa fa-' . $icon . '" aria-hidden="true"></span> ' . $text . '</button>';
													}
													?>

													<div class="vendor-message-container">
														<p><?php echo $row['vendor_remark'] !== null && $row['vendor_remark'] !== '' ? 'Vendor Message: ' . $row['vendor_remark'] : ''; ?></p>
													</div>
												</td>
												<td data-column="Date"> <?php echo $row['date']; ?></td>
												<td data-column="Action">
													<a href="orders.php?order_del=<?php echo $row['o_id']; ?>" onclick="return confirm('Are you sure you want to cancel your order?');" class="btn btn-danger btn-flat btn-addon btn-xs fa fa-trash">
														<i class="fa fa-trash-o" style="font-size:16px"></i>
													</a>
												</td>
											</tr>
									<?php }
									} ?>
								</tbody>

							</table>
						</div>
					</div>
				</div>
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