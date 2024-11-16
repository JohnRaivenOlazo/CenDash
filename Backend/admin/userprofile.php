<?php
include("../src/scripts/db/connect.php");

if (empty($_SESSION["adm_id"])) {
  header('location:login.php');
  exit;
}

if (isset($_POST['update'])) {
  $form_id = $_GET['form_id'];
  $status = $_POST['status'];
  $remark = $_POST['remark'];
  $query = mysqli_query($db, "INSERT INTO remark(frm_id,status,remark) values('$form_id','$status','$remark')");
  $sql = mysqli_query($db, "UPDATE users_orders set status='$status' where o_id='$form_id'");
  echo "<script>alert('form details updated successfully');</script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>CenDash | User Profile</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="css/style.css" rel="stylesheet">
</head>

<body>
  <form name="updateticket" id="updatecomplaint" method="post">
    <table class="user-profile-table" border="0" cellspacing="0" cellpadding="0">
      <?php
      $ret1 = mysqli_query($db, "select * FROM users_orders where o_id='" . $_GET['newform_id'] . "'");
      $ro = mysqli_fetch_array($ret1);
      $ret2 = mysqli_query($db, "select * FROM users where u_id='" . $ro['u_id'] . "'");
      while ($row = mysqli_fetch_array($ret2)) {
      ?>
        <tr>
          <td colspan="2"><b><?php echo $row['f_name']; ?>'s profile</b></td>
        </tr>
        <tr height="50">
          <td><b>Reg Date:</b></td>
          <td><?php echo htmlentities($row['date']); ?></td>
        </tr>
        <tr height="50">
          <td class="user-profile-label"><b>First Name:</b></td>
          <td class="user-profile-value"><?php echo htmlentities($row['f_name']); ?></td>
        </tr>
        <tr height="50">
          <td class="user-profile-label"><b>Last Name:</b></td>
          <td class="user-profile-value"><?php echo htmlentities($row['l_name']); ?></td>
        </tr>
        <tr height="50">
          <td class="user-profile-label"><b>User Email:</b></td>
          <td class="user-profile-value"><?php echo htmlentities($row['email']); ?></td>
        </tr>
        <tr height="50">
          <td class="user-profile-label"><b>User Phone:</b></td>
          <td class="user-profile-value"><?php echo htmlentities($row['phone']); ?></td>
        </tr>
        <tr height="50">
          <td class="user-profile-label"><b>Status:</b></td>
          <td class="user-profile-value">
            <?php if ($row['status'] == 1) {
              echo "<div class='btn btn-primary'>Active</div>";
            } else {
              echo "<div class='btn btn-danger'>Block</div>";
            }
            ?></td>
        </tr>
        <tr>
          <td colspan="2">
            <input name="Submit2" type="submit" class="user-profile-table btn btn-danger" value="Exit" onClick="return window.close();"/>
          </td>
        </tr>
      <?php } ?>
    </table>
  </form>
</body>

</html>