<?php
session_start();
error_reporting(0);
include("../src/scripts/db/connect.php");
if (isset($_POST['submit'])) {
    if (empty($_POST['c_name']) || empty($_POST['res_name']) || $_POST['email'] == '' || $_POST['phone'] == '' || $_POST['o_hr'] == '' || $_POST['c_hr'] == '' || $_POST['o_days'] == '') {
        $error = '<div class="alert alert-danger alert-dismissible fade show">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>All fields Must be Fillup!</strong>
				</div>';
    } else {
        $fname = $_FILES['file']['name'];
        $temp = $_FILES['file']['tmp_name'];
        $fsize = $_FILES['file']['size'];
        $extension = explode('.', $fname);
        $extension = strtolower(end($extension));
        $fnew = uniqid() . '.' . $extension;

        $store = "../src/assets/vendorassets/" . basename($fnew);

        if ($extension == 'jpg' || $extension == 'png' || $extension == 'gif') {
            if ($fsize >= 1000000) {


                $error = '<div class="alert alert-danger alert-dismissible fade show">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<strong>Max Image Size is 1024kb!</strong> Try different Image.
						</div>';
            } else {


                $res_name = $_POST['res_name'];

                $sql = "update vendor set c_id='$_POST[c_name]', title='$res_name',email='$_POST[email]',phone='$_POST[phone]',url='$_POST[url]',o_hr='$_POST[o_hr]',c_hr='$_POST[c_hr]',o_days='$_POST[o_days]',image='$fnew' where rs_id='$_GET[res_upd]' ";  // store the submited data ino the database :images												mysqli_query($db, $sql); 
                mysqli_query($db, $sql);
                move_uploaded_file($temp, $store);

                $success =     '<div class="alert alert-success alert-dismissible fade show">
																<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
																<strong>Record Updated!</strong>.
															</div>';
            }
        } elseif ($extension == '') {
            $error =     '<div class="alert alert-danger alert-dismissible fade show">
																<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
																<strong>select image</strong>
															</div>';
        } else {

            $error =     '<div class="alert alert-danger alert-dismissible fade show">
																<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
																<strong>invalid extension!</strong>png, jpg, Gif are accepted.
															</div>';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Update Vendors</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../admin/css/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="../admin/css/helper.css" rel="stylesheet">
    <link href="../admin/css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid">
        <?php echo $error;
        echo $success; ?>
        <div class="col-lg-12">
            <div class="card card-outline-primary">
                <h4 class="m-b-0 ">Update My Vendor</h4>
                <div class="card-body">
                    <form action='' method='post' enctype="multipart/form-data">
                        <div class="form-body">
                            <?php $ssql = "select * from vendor where rs_id='$_GET[res_upd]'";
                            $res = mysqli_query($db, $ssql);
                            $row = mysqli_fetch_array($res); ?>
                            <div class="row p-t-20">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Vendor Name</label>
                                        <input type="text" name="res_name" value="<?php echo $row['title'];  ?>" class="form-control" placeholder="John doe">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group has-danger">
                                        <label class="control-label">E-mail</label>
                                        <input type="text" name="email" value="<?php echo $row['email'];  ?>" class="form-control form-control-danger" placeholder="example@gmail.com">
                                    </div>
                                </div>
                            </div>
                            <div class="row p-t-20">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Phone </label>
                                        <input type="text" name="phone" class="form-control" value="<?php echo $row['phone'];  ?>" placeholder="1-(555)-555-5555">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Open Hours</label>
                                        <select name="o_hr" class="form-control custom-select" data-placeholder="Choose a Category">
                                            <option>--Select your Hours--</option>
                                            <option value="6am">6am</option>
                                            <option value="7am">7am</option>
                                            <option value="8am">8am</option>
                                            <option value="9am">9am</option>
                                            <option value="10am">10am</option>
                                            <option value="11am">11am</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Close Hours</label>
                                        <select name="c_hr" class="form-control custom-select" data-placeholder="Choose a Category">
                                            <option>--Select your Hours--</option>
                                            <option value="3pm">3pm</option>
                                            <option value="4pm">4pm</option>
                                            <option value="5pm">5pm</option>
                                            <option value="6pm">6pm</option>
                                            <option value="7pm">7pm</option>
                                            <option value="8pm">8pm</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Open Days</label>
                                        <select name="o_days" class="form-control custom-select" data-placeholder="Choose a Category" tabindex="1">
                                            <option>--Select your Days--</option>
                                            <option value="mon-tue">mon-tue</option>
                                            <option value="mon-wed">mon-wed</option>
                                            <option value="mon-thu">mon-thu</option>
                                            <option value="mon-fri">mon-fri</option>
                                            <option value="mon-sat">mon-sat</option>
                                            <option value="24/7">24/7</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group has-danger">
                                        <label class="control-label">Image</label>
                                        <input type="file" name="file" id="lastName" class="form-control form-control-danger" placeholder="12n">
                                        <?php
                                        // Display the current image if it exists
                                        if (!empty($row['image'])) {
                                            echo '<img src="../src/assets/vendorassets/' . $row['image'] . '" alt="" style="max-width: 100%; height: auto;">';
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Select Category</label>
                                        <select name="c_name" class="form-control custom-select" data-placeholder="Choose a Category" tabindex="1">
                                            <option>--Select Category--</option>
                                            <?php $ssql = "select * from vendor_group";
                                            $res = mysqli_query($db, $ssql);
                                            while ($rows = mysqli_fetch_array($res)) {
                                                echo ' <option value="' . $rows['c_id'] . '">' . $rows['c_name'] . '</option>';;
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="form-actions">
                    <input type="submit" name="submit" class="btn btn-primary" value="Save">
                    <a href="all_vendors.php" class="btn btn-inverse">Cancel</a>
                </div>
                </form>
            </div>
        </div>
    </div>


    </div>
    </div>
    <script src="js/lib/jquery/jquery.min.js"></script>
    <script src="js/lib/bootstrap/js/popper.min.js"></script>
    <script src="js/lib/bootstrap/js/bootstrap.min.js"></script>
    <script src="js/jquery.slimscroll.js"></script>
    <script src="js/sidebarmenu.js"></script>
    <script src="js/lib/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="js/custom.min.js"></script>
</body>

</html>