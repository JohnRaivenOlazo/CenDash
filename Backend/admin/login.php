<?php
include("../src/scripts/db/connect.php");

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (!empty($_POST["submit"])) {
        $loginquery = "SELECT * FROM admin WHERE username='$username' && password='" . md5($password) . "'";
        $result = mysqli_query($db, $loginquery);
        $row = mysqli_fetch_array($result);

        if (is_array($row)) {
            $_SESSION["adm_id"] = $row['adm_id'];
            $success = "Login successful!";
            header("refresh:2;url=index.php");
        } else {
            $error = "Invalid Username or Password!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>CenDash | Admin Login</title>
    <link rel="icon" href="../src/assets/images/logo.png">
    <link rel="stylesheet" href="css/login.css">
</head>

<body style="background: url(../src/assets/images/header-bg.jpg)">
    <div class="form">
        <div class="thumbnail"><img src="../src/assets/images/admin.png" /></div>
        <div class="popup">
                    <span class="success"><?php echo $success; ?></span>
                    <span class="error"><?php echo $error; ?></span>
        </div>
        <form class="login-form" action="login.php" method="post">
            <input type="text" placeholder="Username" name="username" />
            <input type="password" placeholder="Password" name="password" />
            <input type="submit" name="submit" value="Login" />
        </form>
    </div>
</body>
</html>
