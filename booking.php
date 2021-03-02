<?php include('header.php');
if (!isset($_SESSION['user'])) {
	header('location:login.php');
}

$qry2 = mysqli_query($con, "select * from fixtures where id='" . $_GET['id'] . "'");
$fix = mysqli_fetch_array($qry2);
?>
<div class="content">
	<div class="wrap">
		<div class="content-top">
			<div class="section group">
				<div class="about span_1_of_2">
					<h3>
						<center><?php
								$sel1 = $con->query("SELECT name,logo FROM teams WHERE id='" . $fix['home_team'] . "'");
								$sel2 = $con->query("SELECT name,logo FROM teams WHERE id='" . $fix['away_team'] . "'");
								$res = mysqli_fetch_array($sel1);
								$res1 = mysqli_fetch_array($sel2);
								echo "You are about to book " . $res[0] . " Vs " . $res1[0]; ?></center>
					</h3>
					<div class="about-top">
						<div class="grid images_3_of_2">
							<img src="<?php echo $fix['cover_image']; ?>" alt="" />
						</div>
						<div class="desc span_3_of_2">

						</div>
						<div class="clear"></div>
					</div>
					<table class="table table-hover table-bordered text-center">
						<?php
						// $s=mysqli_query($con,"select * from tbl_shows where s_id='".$_GET['id']."'");
						// $shw=mysqli_fetch_array($s);

						// 	$t=mysqli_query($con,"select * from tbl_stadium where id='".$shw['stadium_id']."'");
						// 	$stadium=mysqli_fetch_array($t);
						?>
						<tr>
							<td class="col-md-6">
								Stadium
							</td>
							<td class="col-md-6">
								<?php echo $fix['location'] ?>
							</td>

						</tr>

						<tr>
							<td>
								Date
							</td>
							<td class="col-md-6">
								<?php echo $fix['date'] ?>
							</td>

						</tr>
						<tr>
							<td>
								Seats
							</td>
							<form action="stripe/paywithcard.php" method="post">
							<td><select class="form-control" onchange="getSeat();" id="category">
									<option selected="" name='cat' disabled="">Choose Seat</option>
									<option>VVIP</option>
									<option>VIP</option>
									<option>Roofed</option>
									<option>UnRoofed</option>

								</select>
								Available Seat: <b><input Type="text" readonly id="seatsNber"></b>
							</td>
						</tr>
						<tr>
							<td>
								Number of Seats
							</td>
							<td>
								
									<input type="hidden" name="screen" value="<?php //echo $screen['screen_id'];
																				?>" />
									<input type="number" id="bookingSeats" required tile="Number of Seats" onchange="calculateAmount();" min="1" max="<?php //echo $screen['seats']-$avl[0];
																																						?>" min="0" name="seats" class="form-control" value="1" style="text-align:center" id="seats" />

									<input type="hidden" name="amount" id="hm" value="<?php //echo $screen['charge'];
																						?>" />
									<input type="hidden" name="date" value="<?php //echo $date;
																			?>" />
							</td>
						</tr>
						<tr>
							<td>
								Amount
							</td>
							<td id="amount" style="font-weight:bold;font-size:18px">
								
							</td>
						</tr>
						<tr><?php
					//	$qry2 = mysqli_query($con, "select COUNT() from fixtures where id='" . $_GET['id'] . "'");
//$fix = mysqli_fetch_array($qry2); ?>	</form>
							<td colspan="2"><?php //if($avl[0]==$screen['seats']){
											// ?><!--<button type="button" class="btn btn-danger" style="width:100%">House Full</button>--><?php// } else { ?>
								<a href='stripe/paywithcard.php?id=<?php echo $_GET['id'] ?>&cat=<?php echo ?>'><button type='submit' name='book' class="btn btn-info" style="width:100%">Book Now</button><a>
								<?php// } 
								?>
							
							</td>
						</tr>
						<table>
							<tr>
								<td></td>
							</tr>
						</table>
				</div>
				<?php include('fixtures_sidebar.php'); ?>
			</div>
			<div class="clear"></div>
		</div>
	</div>
</div>
<?php include('footer.php'); ?>
<script type="text/javascript">
	var fixtureId = "<?php echo $_GET['id'] ?>";
	//get seats according to category
	const getSeat = () => {
		let category = $("#category").val();

		$.ajax({
			url: "getSeat.php",
			type: "POST",
			data: {
				category,
				fixtureId
			},
			success: function(data) {

				$("#seatsNber").val(data);
				calculateAmount();
			}

		});
	}
	const calculateAmount = () => {

		let category = $("#category").val();
		let seat_number = $("#bookingSeats").val();
		$.ajax({
			url: "getPrice.php",
			type: "POST",
			data: {
				category,
				fixtureId
			},
			success: function(data) {

				// calculating amount to pay
				let amountToPay = data * seat_number;
				$("#amount").html(amountToPay);


			}

		});
	}
</script>