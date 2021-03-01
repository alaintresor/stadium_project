<?php
require('top.inc.php');
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
									<img src="images/MyLogo.PNG" alt="" width="150">
									<h4>8 Teams</h4>
								</div>

							</div>
							<div class="col-lg-4">
								<div id="dashbroad-card">
									<img src="images/MyLogo.PNG" alt="" width="150">
									<h4>3 Postponed Match</h4>
								</div>
							</div>
							<div class="col-lg-4">
								<div id="dashbroad-card">
									<img src="images/MyLogo.PNG" alt="" width="150">
									<h4>Today's Macth 7</h4>
								</div>
							</div>
						</div>
						<br><br><br>
						<div class="row text-center">
							<div class="col-lg-4">
								<div id="dashbroad-card">
									<img src="images/MyLogo.PNG" alt="" width="150">
									<h4>8 Teams</h4>
								</div>
							</div>
							<div class="col-lg-4">
								<div id="dashbroad-card">
									<img src="images/MyLogo.PNG" alt="" width="150">
									<h4>3 Postponed Match</h4>
								</div>
							</div>
							<div class="col-lg-4">
								<div id="dashbroad-card">
									<img src="images/MyLogo.PNG" alt="" width="150">
									<h4>Today's Macth 7</h4>
								</div>
							</div>
						</div>
					<?php } else { ?>
						<div class="row text-center">
							<div class="col-lg-4">
								<div id="dashbroad-card">
									<img src="images/MyLogo.PNG" alt="" width="150">
									<h3>Sold Tickets: <b>206</b></h3>
								</div>

							</div>
							<div class="col-lg-4">
								<div id="dashbroad-card">
									<img src="images/MyLogo.PNG" alt="" width="150">
									<h3>Postponed Matches: <b>3</b></h3>
								</div>
							</div>
							<div class="col-lg-4">
								<div id="dashbroad-card">
									<img src="images/MyLogo.PNG" alt="" width="150">
									<h3>Today's Macth: <b> 7</b></h3>
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