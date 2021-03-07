<!--
@author: Vasilis Tsakiris
-->
<?php include('header.php');
if (!isset($_SESSION['user'])) {
	header('location:login.php');
}

?>
<div class="content">
	<div class="wrap">
		<div class="content-top">
			<div class="section group">
				<?php include('msgbox.php'); ?>
				<div class="row">
					<div class="col-lg-10">

						<div class="">
							<h3 style="background-color: grey;">Bookings</h3>
							<?php include('msgbox.php'); ?>
							<?php
							$bk = mysqli_query($con, "select * from booking_teckets where customer_id='" . $_SESSION['user'] . "'");
							if (mysqli_num_rows($bk)) {
							?>
								<table class="table table-bordered">
									<thead>
										<th>Ticket ID</th>
										<th>Matches</th>
										<th>Stadium</th>
										<th>Seat</th>
										<th>Date</th>
										<th>Seats</th>
										<th>Amount</th>
										<th>Status</th>
										<th>Action</th>
									</thead>
									<tbody>
										<?php
										while ($bkg = mysqli_fetch_array($bk)) {

										?>
											<tr>
												<td>
													<?php echo $bkg['id']; ?>
												</td>
												<td>

													<?php
													$qry2 = mysqli_query($con, "select * from fixtures where id='" . $bkg['fixture_id'] . "'");
													$fix = mysqli_fetch_array($qry2);
													$sel1 = $con->query("SELECT name,logo FROM teams WHERE id='" . $fix['home_team'] . "'");
													$sel2 = $con->query("SELECT name,logo FROM teams WHERE id='" . $fix['away_team'] . "'");
													$res = mysqli_fetch_array($sel1);
													$res1 = mysqli_fetch_array($sel2);
													echo "<b>(" . $res[0] . " Vs " . $res1[0] . ")</b>";

													?>
												</td>
												<td>
													<?php echo $fix['location']; ?>
												</td>
												<td>
													<?php echo $bkg['seat']; ?>
												</td>
												<td>
													<?php echo $bkg['date']; ?>
												</td>
												<td>
													<?php echo $bkg['n_of_seats']; ?>
												</td>

												<td>
													Rwf <?php echo $bkg['amount']; ?>
												</td>
												<td>
													<?php if ($bkg['date'] < date('Y-m-d')) {
													?>
														<i>Expired</i>
													<?php
													} else { ?>
														<b>Pending</b>
													<?php
													}
													?>
												</td>
												<?php if ($bkg['date'] > date('Y-m-d')) {
												?>
													<td><button>Print</button></td>
												<?php } else { ?>
													<td>....</td>
												<?php } ?>
											</tr>
										<?php
										}
										?>
									</tbody>
								</table>
							<?php
							} else {
							?>
								<h3>No Previous Bookings</h3>
							<?php
							}
							?>
						</div>
					</div>
					<div class="col-lg-2 ">
						<br><br>
						<span class="btn btn-primary" data-toggle="modal" data-target="#myModal"> Change Username</span>
						<div id="myModal" class="modal">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">

										<p align='right'><button class="btn btn-danger text-center" data-dismiss="modal">X</button></p>
										<h4 class="modal-title">Change Login Username</h4>
									</div>
									<div class="modal-body">
										<form>
											<div class="form-group">
												<label for="firstname">New Username:</label>
												<input type="text" placeholder="Enter your current password" class="form-control">
											</div>
											<div class="form-group">
												<label for="lastname">Password:</label>
												<input type="password" class="form-control" name="newPwd">
											</div>

											<button type="submit" class="btn btn-primary form-control">Change</button>
										</form>
									</div>
								</div>
							</div>
						</div>
						<br><br>
						<span class="btn btn-primary" data-toggle="modal" data-target="#myModal2"> Change Password</span>
						<div id="myModal2" class="modal">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">

										<p align='right'><button class="btn btn-danger text-center" data-dismiss="modal">X</button></p>
										<h4 class="modal-title">
											Change Login Password
										</h4>
									</div>
									<div class="modal-body">
										<form>
											<div class="form-group">
												<label for="firstname">Current Password:</label>
												<input type="password" placeholder="Enter your current password" class="form-control">
											</div>
											<div class="form-group">
												<label for="lastname">New Password:</label>
												<input type="password" class="form-control" name="newPwd">
											</div>
											<div class="form-group">
												<label for="lastname">Confirm Password:</label>
												<input type="text" class="form-control">
											</div>
											<button type="submit" class="btn btn-primary form-control">Change</button>
										</form>
									</div>

								</div>
							</div>
						</div>
					</div>
				</div>

			</div>


		</div>
	</div>

	<div class="clear"></div>


</div>
</div>

<?php include('footer.php'); ?>
<style>
	@font-face {
		font-family: 'Fira Sans';
		src: local('FiraSans-Regular'),
			url('/media/fonts/FiraSans-Regular.woff2') format('woff2');
	}

	legend {
		background-color: #000;
		color: #fff;
		padding: 3px 6px;
	}

	#update,
	label {
		width: 43%;
	}

	#update {
		margin: .5rem 0;
		padding: .5rem;
		border-radius: 4px;
		border: 1px solid #ddd;
	}

	label {
		display: inline-block;
	}

	#update:invalid+span:after {
		content: '✖';
		color: red;
		padding-left: 5px;
	}

	#update:valid+span:after {
		content: '✓';
		color: green;
		padding-left: 5px;
	}

	.warning {
		font-size: .65rem;
		color: #e67d09;
	}
</style>
<script type="text/javascript">
	$('#seats').change(function() {
		var charge = <?php echo $screen['charge']; ?>;
		amount = charge * $(this).val();
		$('#amount').html("€ " + amount);
		$('#hm').val(amount);
	});
</script>