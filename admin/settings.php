<?php
require('top.inc.php');
$con = mysqli_connect("localhost", "root", "", "stadium");

$username = '';
$password = '';
$fullname = '';

$msg = '';
if (isset($_GET['id']) && $_GET['id'] != '') {
    $id = get_safe_value($con, $_GET['id']);
    $res = mysqli_query($con, "select * from admin_users where id='$id'");
    $check = mysqli_num_rows($res);
    if ($check > 0) {

        $row = mysqli_fetch_assoc($res);
        $username = $row['username'];
        $password = $row['password'];
        $fullname = $row['fullname'];
    } else {

        header('location:index.php');
        die();
    }
}

if (isset($_POST['submit'])) {
    $username = get_safe_value($con, $_POST['username']);
    $password = get_safe_value($con, $_POST['password']);
    $fullname = get_safe_value($con, $_POST['fullname']);

    if ($msg == '') {
        if (isset($_GET['id']) && $_GET['id'] != '') {

            $update_sql = "UPDATE admin_users SET `fullname`='$fullname',`username`='$username',`password`='$password' where id='$id'";
            $done = mysqli_query($con, $update_sql);
            if (!$done)  $msg = "Error: " . mysqli_error($con);

            header('location:index.php');
            die();
        }
    }
}
?>
<style>
    #dashbroad-card {
        border: 2px solid#121c20;
        /* width: 80%; */
    }
</style>
<div class="content pb-0">
    <div class="orders">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="box-title">SETTINGS </h4>
                        <hr>
                    </div>
                    <form method="post" enctype="multipart/form-data" onsubmit="return submited()">
                        <div class="card-body card-block">
                            <div class="form-group">
                                <label for="name" class=" form-control-label">Fullname</label>
                                <input type="text" name="fullname" class="form-control" required value="<?php echo $fullname ?>" placeholder="Enter new fullname">
                            </div>
                            <div class="form-group">
                                <label for="name" class=" form-control-label">Username</label>
                                <input type="text" name="username" class="form-control" required value="<?php echo $username ?>" placeholder="Enter new username">
                            </div>
                            <div class="form-group">
                                <label for="province" class=" form-control-label">Password</label>
                                <input type="password" name="password" class="form-control" required value="<?php echo $password ?>" placeholder="Enter new password">
                            </div>
                            <button id="payment-button" name="submit" type="submit" class="btn btn-lg btn-info btn-block">
                                <span id="payment-button-amount">SUBMIT</span>
                            </button>
                            <div class="field_error"><?php echo $msg ?></div>
                        </div>
                    </form>
                    <br><br>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    // const submited = () => {
    //     let check = promet("Ok")
    //     return false;
    // }
</script>
<?php
require('footer.inc.php');
?>