<?php

require('top.inc.php');

isAdmin();
$name = '';
$division = '';


$msg = '';

if (isset($_GET['id']) && $_GET['id'] != '') {

    $image_required = '';
    $id = get_safe_value($con, $_GET['id']);
    $res = mysqli_query($con, "select * from teams where id='$id'");
    $check = mysqli_num_rows($res);
    if ($check > 0) {
        $row = mysqli_fetch_assoc($res);
        $name = $row['name'];
        $division = $row['division'];
    } else {
        header('location:teams_management.php');
        die();
    }
}

if (isset($_POST['submit'])) {

    $name = get_safe_value($con, $_POST['name']);
    $division = get_safe_value($con, $_POST['division']);

    $logo = "../images/upload/" . $_FILES['logo']['name'];
    $logoName =  $_FILES['logo']['name'];
    $target_dir = "../images/upload/";
    $target_photo = $target_dir . basename($_FILES["logo"]["name"]);

    // Select file type
    $imageFileType = strtolower(pathinfo($target_photo, PATHINFO_EXTENSION));

    // Valid file extensions
    $extensions_arr = array("jpg", "jpeg", "png", "gif");
    if (!in_array($imageFileType, $extensions_arr)) {
        $msg = "Please select real image file";
    }

    $res = mysqli_query($con, "select * from teams where name='$name'");
    $check = mysqli_num_rows($res);
    if ($check > 0) {
        if (isset($_GET['id']) && $_GET['id'] != '') {
            $getData = mysqli_fetch_assoc($res);
            if ($id == $getData['id']) {
            } else {
                $msg = "Team already exist";
            }
        } else {
            $msg = "Team already exist";
        }
    }


    if ($msg == '') {

        if (isset($_GET['id']) && $_GET['id'] != '') {
            $update_sql = "update teams set name='$name',division='$division' where id='$id'";
            mysqli_query($con, $update_sql);
        } else {
            // Check extension

            $done = mysqli_query($con, "INSERT INTO `teams` (`id`, `name`, `division`, `logo`) VALUES (NULL, '$name', '$division', '$logo');");
            if ($done) {
                $isUploaded = move_uploaded_file($_FILES['logo']['tmp_name'], $target_dir . $logoName);
            }
        }
        header('location:teams_management.php');
        die();
    }
}

?>
<div class="content pb-0">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header"><strong>ADD NEW TEAM FORM</strong><small> </small></div>
                    <form method="post" action="#" enctype="multipart/form-data">
                        <div class="card-body card-block">

                            <div class="form-group">
                                <label for="date" class=" form-control-label">Team Name</label>
                                <input type="text" name="name" placeholder="Enter Team Name" class="form-control" required value="<?php echo $name ?>">
                            </div>
                            <div class="form-group">
                                <label for="division" class=" form-control-label">Team Division</label>
                                <select name="division" id="" class="form-control">
                                    <option value="D1">Dividion 1</option>
                                    <option value="D2">Dividion 2</option>
                                </select>
                            </div>
                            <?php if (isset($_GET['id']) && $_GET['id'] != '') {
                            } else { ?>
                                <div class="form-group">
                                    <label for="logo" class=" form-control-label">Team Logo</label>
                                    <input type="file" name="logo" class="form-control" required value="<?php echo $division ?>">
                                </div>
                            <?php } ?>

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