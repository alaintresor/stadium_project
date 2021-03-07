<?php
require('top.inc.php');
isAdmin();
$name = '';
$province = '';
$district = '';
$seatsNber = '';


$msg = '';
if (isset($_GET['id']) && $_GET['id'] != '') {
    $image_required = '';
    $id = get_safe_value($con, $_GET['id']);
    $res = mysqli_query($con, "select * from stadiums where id='$id'");
    $check = mysqli_num_rows($res);
    if ($check > 0) {

        $row = mysqli_fetch_assoc($res);
        $name = $row['name'];
        $province = $row['province'];
        $district = $row['district'];
        $seatsNber = $row['seats_nber'];
    } else {

        header('location:stadium_management.php');
        die();
    }
}

if (isset($_POST['submit'])) {
    $name = get_safe_value($con, $_POST['name']);
    $province = get_safe_value($con, $_POST['province']);
    $district = get_safe_value($con, $_POST['district']);
    $seatsNber = get_safe_value($con, $_POST['seatsNber']);


    if ($msg == '') {
        if (isset($_GET['id']) && $_GET['id'] != '') {

            $update_sql = "UPDATE stadiums SET `name`='$name',`province`='$province',`district`='$district',`seats_nber`='$seatsNber' where id='$id'";
            $done = mysqli_query($con, $update_sql);
            if (!$done)  $msg = "Error: " . mysqli_error($con);
        } else {
            $done = mysqli_query($con, "INSERT INTO `stadiums` (`id`, `name`, `province`, `district`, `seats_nber`) VALUES (NULL, '$name', '$province', '$district', '$seatsNber');");
            if (!$done)  $msg = "Error: " . mysqli_error($con);
        }
        header('location:stadium_management.php');
        die();
    }
}

?>
<div class="content pb-0">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header"><strong>ADD NEW STADIUM</strong><small> </small></div>
                    <form method="post" enctype="multipart/form-data">
                        <div class="card-body card-block">


                            <div class="form-group">
                                <label for="name" class=" form-control-label">Name</label>
                                <input type="text" name="name" class="form-control" required value="<?php echo $name ?>" placeholder="Enter stadium name">
                            </div>
                            <b>
                                <h3>Stadium Location</h3>
                            </b>
                            <div class="form-group">
                                <label for="province" class=" form-control-label">Province</label>
                                <input type="text" name="province" class="form-control" required value="<?php echo $province ?>" placeholder="Enter province stadium located in">
                            </div>
                            <div class="form-group">
                                <label for="destrict" class=" form-control-label">District</label>
                                <input type="text" class="form-control" name="district" value="<?php echo $district ?>" required placeholder="Enter district stadium located in">
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="homeTeam" class=" form-control-label">Seats Number</label>
                                <input type="number" class="form-control" name="seatsNber" value="<?php echo $seatsNber ?>" required placeholder="Enter number of stadium seats ">
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