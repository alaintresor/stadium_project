<?php
require('top.inc.php');
isAdmin();
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
					<div class="card-header"><strong>ADD NEW FIXTURE FORM</strong><small> </small></div>
					<form method="post" enctype="multipart/form-data">
						<div class="card-body card-block">


							<div class="form-group">
								<label for="date" class=" form-control-label">Date</label>
								<input type="date" name="name" class="form-control" required value="<?php echo $username ?>">
							</div>
							<div class="form-group">
								<label for="time" class=" form-control-label">Time</label>
								<input type="time" name="name" class="form-control" required value="<?php echo $username ?>">
							</div>
							<div class="form-group">
								<label for="homeTeam" class=" form-control-label">Competition</label>
								<input type="text" name="competition" placeholder="Enter which competition " class="form-control" required value="<?php echo $email ?>">
							</div>
							<div class="form-group">
								<label for="homeTeam" class=" form-control-label">Home Team</label>
								<input type="text" name="home" placeholder="Enter home team" class="form-control" required value="<?php echo $email ?>">
							</div>
							<div class="form-group">
								<label for="AwayTeam" class=" form-control-label">Away Team </label>
								<input type="text" name="contact" placeholder="Enter Away Team" class="form-control" required value="<?php echo $mobile ?>">
							</div>
							<div class="form-group">
								<label for="Location" class=" form-control-label">Location </label>
								<input type="text" name="location" placeholder="Enter match loction" class="form-control" required value="<?php echo $mobile ?>">
							</div>
							<div class="form-group">
								<label for="descriptions" class=" form-control-label">Descriptions </label>
								<textarea name="descriptions" rows="3" class="form-control" required value="<?php echo $mobile ?>">Enter match descriptions</textarea>
							</div>
							<div class="form-group">
								<label for="cover image" class=" form-control-label">Cover Image </label>
								<input type="file" name="image" class="form-control" required value="<?php echo $mobile ?>">
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