<?php
require('top.inc.php');
isManger();
$username = '';
$password = '';
$email = '';
$mobile = '';

$msg = '';
if (isset($_GET['id']) && $_GET['id'] != '') {
    $image_required = '';
    $id = get_safe_value($con, $_GET['id']);
    $res = mysqli_query($con, "select * from admin_users where id='$id'");
    $check = mysqli_num_rows($res);
    if ($check > 0) {
        $row = mysqli_fetch_assoc($res);
        $username = $row['username'];
        $email = $row['email'];
        $mobile = $row['mobile'];
        $password = $row['password'];
    } else {
        header('location:vendor_management.php');
        die();
    }
}

if (isset($_POST['submit'])) {
    $username = get_safe_value($con, $_POST['username']);
    $email = get_safe_value($con, $_POST['email']);
    $mobile = get_safe_value($con, $_POST['mobile']);
    $password = get_safe_value($con, $_POST['password']);

    $res = mysqli_query($con, "select * from admin_users where username='$username'");
    $check = mysqli_num_rows($res);
    if ($check > 0) {
        if (isset($_GET['id']) && $_GET['id'] != '') {
            $getData = mysqli_fetch_assoc($res);
            if ($id == $getData['id']) {
            } else {
                $msg = "Username already exist";
            }
        } else {
            $msg = "Username already exist";
        }
    }


    if ($msg == '') {
        if (isset($_GET['id']) && $_GET['id'] != '') {
            $update_sql = "update admin_users set username='$username',password='$password',email='$email',mobile='$mobile' where id='$id'";
            mysqli_query($con, $update_sql);
        } else {
            mysqli_query($con, "insert into admin_users(username,password,email,mobile,role,status) values('$username','$password','$email','$mobile',1,1)");
        }
        header('location:vendor_management.php');
        die();
    }
}
?>
<div class="content pb-0">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header"><strong>ADD SEATS AND PRICE</strong><small> </small></div>
                    <form method="post" enctype="multipart/form-data">
                        <div class="card-body card-block">

                            <div class="form-group">
                                <label for="date" class=" form-control-label">Fixture Id</label>
                                <input type="text" name="fixtureId" class="form-control" required value="<?php echo $username ?>">
                            </div>
                            <div class="row">
                                <div class="col-lg-2">
                                    <br>
                                    <b>VVIP Seats</b>
                                </div>
                                <div class="col-lg-5">
                                    <div class="form-group">
                                        <label for="seat" class=" form-control-label">Seat Number</label>
                                        <input type="number" name="vvipNber" class="form-control" placeholder="Enter Number of avialable seat" required value="<?php echo $username ?>">
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <div class="form-group">
                                        <label for="Price" class=" form-control-label">Price</label>
                                        <input type="number" name="vvipPrice" class="form-control" placeholder="Enter Number of avialable seat" required value="<?php echo $username ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2">
                                    <br>
                                    <b>VIP Seats</b>
                                </div>
                                <div class="col-lg-5">
                                    <div class="form-group">
                                        <label for="seat" class=" form-control-label">Seat Number</label>
                                        <input type="number" name="vipNber" class="form-control" placeholder="Enter Number of avialable seat" required value="<?php echo $username ?>">
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <div class="form-group">
                                        <label for="Price" class=" form-control-label">Price</label>
                                        <input type="number" name="vipPrice" class="form-control" placeholder="Enter Number of avialable seat" required value="<?php echo $username ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2">
                                    <br>
                                    <b>Roofed Seats</b>
                                </div>
                                <div class="col-lg-5">
                                    <div class="form-group">
                                        <label for="seat" class=" form-control-label">Seat Number</label>
                                        <input type="number" name="roofedNber" class="form-control" placeholder="Enter Number of avialable seat" required value="<?php echo $username ?>">
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <div class="form-group">
                                        <label for="Price" class=" form-control-label">Price</label>
                                        <input type="number" name="roofedPrice" class="form-control" placeholder="Enter Number of avialable seat" required value="<?php echo $username ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2">
                                    <br>
                                    <b>Unfooed Seats</b>
                                </div>
                                <div class="col-lg-5">
                                    <div class="form-group">
                                        <label for="seat" class=" form-control-label">Seat Number</label>
                                        <input type="number" name="unroofedNber" class="form-control" placeholder="Enter Number of avialable seat" required value="<?php echo $username ?>">
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <div class="form-group">
                                        <label for="Price" class=" form-control-label">Price</label>
                                        <input type="number" name="unroofedPrice" class="form-control" placeholder="Enter Number of avialable seat" required value="<?php echo $username ?>">
                                    </div>
                                </div>
                            </div>

                            <button id="payment-button" name="submit" type="submit" class="btn btn-lg btn-info btn-block">
                                <span id="payment-button-amount">SUBMIT</span>
                            </button>
                            <div class="field_error"><?php echo $msg ?></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<?php
require('footer.inc.php');
?>