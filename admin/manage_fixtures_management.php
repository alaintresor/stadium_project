<?php
require('top.inc.php');
isAdmin();
$date = '';
$time = '';
$competition = '';
$homeId = '';
$awayId = '';
$location = '';
$descriptions = '';

$msg = '';
if (isset($_GET['id']) && $_GET['id'] != '') {
	echo "<script> console.log('testing')</script>";
	$image_required = '';
	$id = get_safe_value($con, $_GET['id']);
	$res = mysqli_query($con, "select * from fixtures where id='$id'");
	$check = mysqli_num_rows($res);
	if ($check > 0) {

		$row = mysqli_fetch_assoc($res);
		$date = $row['date'];
		$time = $row['time'];
		$competition = $row['competition'];
		$homeId = $row['home_team'];
		$awayId = $row['away_team'];
		$location = $row['location'];
		$descriptions = $row['description'];
	} else {
		echo "<script> console.log('no')</script>";
		header('location:fixtures_management.php');
		die();
	}
}

if (isset($_POST['submit'])) {
	$date = get_safe_value($con, $_POST['date']);
	$time = get_safe_value($con, $_POST['time']);
	$competition = get_safe_value($con, $_POST['competition']);
	$homeId = get_safe_value($con, $_POST['homeId']);
	$awayId = get_safe_value($con, $_POST['awayId']);
	$location = get_safe_value($con, $_POST['location']);
	$descriptions = get_safe_value($con, $_POST['descriptions']);
	if (isset($_GET['id']) && $_GET['id'] != '') {
	} else {
		$img = "images/upload/" . $_FILES['image']['name'];
		$imgName =  $_FILES['image']['name'];
		$target_dir = "../images/upload/";
		$target_photo = $target_dir . basename($_FILES["image"]["name"]);

		// Select file type
		$imageFileType = strtolower(pathinfo($target_photo, PATHINFO_EXTENSION));

		// Valid file extensions
		$extensions_arr = array("jpg", "jpeg", "png", "gif");
		if (!in_array($imageFileType, $extensions_arr)) {
			$msg = "Please select real image file";
		}
	}

	if ($msg == '') {
		if (isset($_GET['id']) && $_GET['id'] != '') {
			echo "<script> console.log('testing888')</script>";
			$update_sql = "update fixtures set date='$date',time='$time',competition='$competition',home_team='$homeId',away_team='$awayId',location='$location',description='$descriptions' where id='$id'";
			$done = mysqli_query($con, $update_sql);
			if ($done) {
				echo "<script> console.log('WE')</script>";
			} else $msg = "Error: " . mysqli_error($con);
		} else {
			$done = mysqli_query($con, "INSERT INTO `fixtures` (`id`, `date`, `time`, `competition`, `home_team`, `away_team`, `location`, `description`, `cover_image`) VALUES (NULL, '$date', '$time', '$competition', '$homeId', '$awayId', '$location', '$descriptions', '$img');");
			if ($done) {
				$isUploaded = move_uploaded_file($_FILES['image']['tmp_name'], $target_dir . $imgName);
			} else {
				echo "<script> console.log('Error')</script>";
			}
		}
		header('location:fixtures_management.php');
		die();
	}
}

//getting all competitions 
$compQuery = mysqli_query($con, "SELECT * FROM `competitions`");

//getting all teams 
$teamsQuery = mysqli_query($con, "SELECT * FROM `teams`");

$teamsQuery2 = mysqli_query($con, "SELECT * FROM `teams`");

$stadiumQuery = mysqli_query($con, "SELECT * FROM stadiums");
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
								<input type="date" name="date" class="form-control" required value="<?php echo $date ?>">
							</div>
							<div class="form-group">
								<label for="time" class=" form-control-label">Time</label>
								<input type="time" name="time" class="form-control" required value="<?php echo $time ?>">
							</div>
							<div class="form-group">
								<label for="homeTeam" class=" form-control-label">Competition</label>
								<select name="competition" class="form-control" required>
									<?php while ($row = mysqli_fetch_array($compQuery)) { ?>
										<option value="<?php echo $row['name'] ?>"><?php echo $row['name'] ?></option>
									<?php } ?>
								</select>
							</div>
							<div class="form-group">
								<label for="homeTeam" class=" form-control-label">Home Team ID</label>
								<select name="homeId" class="form-control" required>
									<?php while ($row = mysqli_fetch_array($teamsQuery)) { ?>
										<option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
									<?php } ?>
								</select>
							</div>
							<div class="form-group">
								<label for="AwayTeam" class=" form-control-label">Away Team ID</label>
								<select name="awayId" class="form-control" required>
									<?php while ($row = mysqli_fetch_array($teamsQuery2)) { ?>
										<option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
									<?php } ?>
								</select>
							</div>
							<div class="form-group">
								<label for="Location" class=" form-control-label">Location </label>
								<select name="location" class="form-control" required>
									<?php
									while ($row = mysqli_fetch_array($stadiumQuery)) {
										if ($row['name'] == $location) { ?>
											<option selected><?php echo $row['name'] ?></option>
										<?php	} else { ?>
											<option><?php echo $row['name'] ?></option>
									<?php	}
									}
									?>
								</select>
							</div>
							<div class="form-group">
								<label for="descriptions" class=" form-control-label">Descriptions </label>
								<textarea name="descriptions" rows="3" class="form-control" required placeholder="Enter match descriptions"><?php echo $descriptions ?></textarea>
							</div>
							<?php if (isset($_GET['id']) && $_GET['id'] != '') {
							} else { ?>
								<div class="form-group">
									<label for="cover image" class=" form-control-label">Cover Image </label>
									<input type="file" name="image" class="form-control" required>
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