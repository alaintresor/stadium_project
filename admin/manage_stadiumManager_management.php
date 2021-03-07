<?php
require('top.inc.php');
isAdmin();
$name = '';
$stadium = '';
$username = '';
$password = '';


$msg = '';
if (isset($_GET['id']) && $_GET['id'] != '') {
    $image_required = '';
    $id = get_safe_value($con, $_GET['id']);
    $res = mysqli_query($con, "select * from admin_users where id='$id'");
    $check = mysqli_num_rows($res);
    if ($check > 0) {

        $row = mysqli_fetch_assoc($res);
        $name = $row['fullname'];
        $stadium = $row['stadium_id'];
        $username = $row['username'];
        $password = $row['password'];
    } else {

        header('location:stadiumManager_management.php');
        die();
    }
}

if (isset($_POST['submit'])) {
    $name = get_safe_value($con, $_POST['name']);
    $stadium = get_safe_value($con, $_POST['stadium']);
    $username = get_safe_value($con, $_POST['username']);
    $password = get_safe_value($con, $_POST['password']);


    if ($msg == '') {
        if (isset($_GET['id']) && $_GET['id'] != '') {

            $update_sql = "UPDATE admin_users SET `name`='$name',`stadium_id`='$stadium',`username`='$username',`password`='$password' where id='$id'";
            $done = mysqli_query($con, $update_sql);
            if (!$done)  $msg = "Error: " . mysqli_error($con);
        } else {
            $done = mysqli_query($con, "INSERT INTO `admin_users` (`id`, `fullname`, `username`, `password`, `role`,`stadium_id`) VALUES (NULL, '$name', '$username', '$password', '1','$stadium');");
            if (!$done)  $msg = "Error: " . mysqli_error($con);
        }
        header('location:stadiumManager_management.php');
        die();
    }
}
// getting all stadiums 
$stadiumQuery = mysqli_query($con, "SELECT DISTINCT `stadiums`.`id`,`name` FROM `stadiums`,`admin_users` WHERE `stadiums`.`id`!=`stadium_id`");
?>
<div class="content pb-0">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header"><strong>ADD NEW STADIUM'S MANAGER</strong><small> </small></div>
                    <form method="post" enctype="multipart/form-data">
                        <div class="card-body card-block">


                            <div class="form-group">
                                <label for="name" class=" form-control-label">Fullname</label>
                                <input type="text" name="name" class="form-control" required value="<?php echo $name ?>" placeholder="Enter manager fullname">
                            </div>
                            <div class="form-group">
                                <label for="stadium" class=" form-control-label">Stadium</label>
                                <select name="stadium" class="form-control" required>
                                    <?php
                                    while ($row = mysqli_fetch_array($stadiumQuery)) { ?>
                                        <option value="<?php echo $row[0] ?>"><?php echo $row[1] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <b>
                                <h3>Login Details</h3>
                            </b>
                            <div class="form-group">
                                <label for="destrict" class=" form-control-label">Username</label>
                                <input type="text" class="form-control" name="username" value="<?php echo $username ?>" required placeholder="Enter username for manager">
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="homeTeam" class=" form-control-label">Password</label>
                                <input type="password" class="form-control" name="password" value="<?php echo $password ?>" required placeholder="Enter passord for manager">
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