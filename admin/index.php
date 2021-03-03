<?php
require('top.inc.php');
$con = mysqli_connect("localhost", "root", "", "stadium");
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
						<h4 class="box-title">DASHBOARD </h4>
						<hr>
					</div>
					<?php if ($_SESSION['ADMIN_ROLE'] == 0) { ?>
						<div class="row text-center">
							<div class="col-lg-4">
								<div id="dashbroad-card">
									<img src="images/teams.png" alt="" width="150">
									<?php $teams = mysqli_fetch_array(mysqli_query($con, "SELECT COUNT(id) FROM teams")) ?>
									<h3>Teams: <b><?php echo $teams[0] ?></b> </h3>
								</div>

							</div>
							<div class="col-lg-4">
								<div id="dashbroad-card">
									<img src="images/postponed.png" alt="" width="150">
									<?php $postponed = mysqli_fetch_array(mysqli_query($con, "SELECT COUNT(id) FROM postponed_matchs")) ?>
									<h3>Postponed Match: <b> <?php echo $postponed[0] ?></b></h3>
								</div>
							</div>
							<div class="col-lg-4">
								<div id="dashbroad-card">
									<img src="images/timer.png" alt="" width="150">
									<?php $today = date("Y-m-d");
									$day = mysqli_fetch_array(mysqli_query($con, "SELECT COUNT(id) FROM fixtures WHERE `date`='$today'"));
									?>
									<h3>Today's Macth: <b> <?php echo $day[0] ?></b></h3>
								</div>
							</div>
						</div>
						<br><br><br>
						<div class="row text-center">
							<div class="col-lg-4">
								<div id="dashbroad-card">
									<img src="images/fixtures.png" alt="" width="150">
									<?php
									$fixtures = mysqli_fetch_array(mysqli_query($con, "SELECT COUNT(id) FROM fixtures  WHERE `status`!='end'"));
									?>
									<h3>Match on Fixtures: <b><?php echo $fixtures[0] ?></b></h3>
								</div>
							</div>
							<div class="col-lg-4">
								<div id="dashbroad-card">
									<img src="images/competition.png" alt="" width="150">
									<?php
									$competitions = mysqli_fetch_array(mysqli_query($con, "SELECT COUNT(id) FROM `competitions`"));
									?>
									<h3>Competition: <b><?php echo $competitions[0] ?></b></h3>
								</div>
							</div>
							<div class="col-lg-4">
								<div id="dashbroad-card">
									<img src="images/division.jpg" alt="" width="150">
									<h3>Divisions: <b>2</b></h3>
								</div>
							</div>
						</div>
					<?php } else { ?>
						<div class="row text-center">
							<div class="col-lg-4">
								<div id="dashbroad-card">
									<img src="images/tickets.png" alt="" width="150">
									<?php
									$tickets = mysqli_fetch_array(mysqli_query($con, "SELECT COUNT(id) FROM `booking_teckets`  "));
									?>
									<h3>Sold Tickets: <b><?php echo $tickets[0] ?></b></h3>
								</div>

							</div>
							<div class="col-lg-4">
								<div id="dashbroad-card">
									<img src="images/postponed.png" alt="" width="150">
									<?php $postponed = mysqli_fetch_array(mysqli_query($con, "SELECT COUNT(id) FROM postponed_matchs")) ?>
									<h3>Postponed Match: <b> <?php echo $postponed[0] ?></b></h3>
								</div>
							</div>
							<div class="col-lg-4">
								<div id="dashbroad-card">
									<img src="images/timer.png" alt="" width="150">
									<?php $today = date("Y-m-d");
									$day = mysqli_fetch_array(mysqli_query($con, "SELECT COUNT(id) FROM fixtures WHERE `date`='$today'"));
									?>
									<h3>Today's Macth: <b> <?php echo $day[0] ?></b></h3>
								</div>
							</div>
						</div>
					<?php } ?>
					<br><br>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
require('footer.inc.php');
?>