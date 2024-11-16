<?php
session_start();
error_reporting(0);
include("../src/scripts/db/connect.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $msg = "";
    $fields = ['username', 'f_name', 'l_name', 'email', 'phone', 'password', 'vendor'];
    $requiredFields = array_filter($fields, function ($field) {
        return empty($_POST[$field]);
    });

    if (!empty($requiredFields)) {
        $msg = "All fields are required!";
    } else {
        $check_username = mysqli_query($db, "SELECT username FROM vendor_users WHERE username = '" . $_POST['username'] . "'");
        $check_email = mysqli_query($db, "SELECT email FROM vendor_users WHERE email = '" . $_POST['email'] . "'");
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
            $sql = "INSERT INTO `vendor_users` (username, f_name, l_name, email, phone, password, rs_id) 
                    VALUES ('" . $_POST['username'] . "','" . $_POST['f_name'] . "','" . $_POST['l_name'] . "','" . $_POST['email'] . "','" . $_POST['phone'] . "','" . $hashedPassword . "','" . $_POST['vendor'] . "')";

            if (mysqli_query($db, $sql)) {
                $msg = "Signup successful! Redirecting to login page...";
                header("refresh:3;url=signin.php");
            } else {
                $msg = "Error: " . $sql . "<br>" . mysqli_error($db);
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor User Signup</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            position: relative;
            top: 0;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
        }

        input, select {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <h2>Vendor User Signup</h2>
    <form action="" method="post">
    <?php
            if (stripos($msg, "success") !== false) {
               echo '<p style="color: green;">' . $msg . '</p>';
            } else {
               echo '<p style="color: red;">' . $msg . '</p>';
            }
            ?>
        <label for="username">Username:</label>
        <input type="text" name="username" required><br>

        <label for="f_name">First Name:</label>
        <input type="text" name="f_name" required><br>

        <label for="l_name">Last Name:</label>
        <input type="text" name="l_name" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" required><br>

        <label for="phone">Phone:</label>
        <input type="tel" name="phone" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br>

        <label for="cpassword">Confirm Password:</label>
        <input type="password" name="cpassword" required><br>

        <label for="vendor">Select vendor:</label>
        <select name="vendor" required>
            <?php
            // Fetch vendor data from the database
            $sql = "SELECT rs_id, title FROM vendor";
            $qry = mysqli_query($db, $sql);
            if (mysqli_num_rows($qry) > 0) {
                while ($row = mysqli_fetch_assoc($qry)) {
                    echo "<option value='" . $row['rs_id'] . "'>" . $row['title'] . "</option>";
                }
            }
            ?>
        </select><br>

        <div class="button">
            <p><input type="submit" value="Sign Up" name="submit"></p>
        </div>
    </form>
</body>

</html>
