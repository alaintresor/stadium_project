<?php
require('top.inc.php');
isAdmin();
$name = '';
$attending = '';

$msg = '';
if (isset($_GET['id']) && $_GET['id'] != '') {

    $id = get_safe_value($con, $_GET['id']);
    $res = mysqli_query($con, "SELECT *FROM `competitions` WHERE `id`='$id'");
    $check = mysqli_num_rows($res);
    if ($check > 0) {

        $row = mysqli_fetch_assoc($res);
        $name = $row['name'];
        $attending = $row['attending_division'];
    } else {
        header('location:competitions_management.php');
        die();
    }
}

if (isset($_POST['submit'])) {
    $name = get_safe_value($con, $_POST['name']);
    $attending = get_safe_value($con, $_POST['attending']);

    if ($msg == '') {
        if (isset($_GET['id']) && $_GET['id'] != '') {
            $update_sql = "UPDATE `competitions` SET `name`='$name',`attending_division`='$attending' WHERE `id`='$id'";
            $done = mysqli_query($con, $update_sql);
            if ($done) {
            } else $msg = "Error: " . mysqli_error($con);
        } else {
            $done = mysqli_query($con, "INSERT INTO `competitions` (`id`, `name`, `attending_division`) VALUES (NULL, '$name', '$attending');");
            if ($done) {
            } else {
                $msg = "Error: " . mysqli_error($con);
            }
        }
        header('location:competitions_management.php');
        die();
    }
}
?>
<div class="content pb-0">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header"><strong>ADD COMPETITION</strong><small> </small></div>
                    <form method="post" enctype="multipart/form-data">
                        <div class="card-body card-block">


                            <div class="form-group">
                                <label for="name" class=" form-control-label">Name</label>
                                <input type="text" name="name" class="form-control" required value="<?php echo $name ?>" placeholder="Enter competition name">
                            </div>
                            <div class="form-group">
                                <label for="attending" class=" form-control-label">Attending Division</label>
                                <input type="text" name="attending" class="form-control" required value="<?php echo $attending ?>" placeholder="Enter Attending division">
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