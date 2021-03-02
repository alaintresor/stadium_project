<?php
include('header.php');
?>
<div class="content">
	<div class="wrap">
		<center>
			<h1 style="background:yellow">Smart Stadium Ticket Selling System</h1>
		</center>
		<div class="content-top">
			<div class="listview_1_of_3 images_1_of_3">
				<h3>Upcoming Matches</h3>
				<div class="content-left">

					<?php $sel = $con->query("SELECT * FROM fixtures WHERE status ='active'");
					while ($row = mysqli_fetch_array($sel)) {

						$sel1 = $con->query("SELECT name,logo FROM teams WHERE id='" . $row['home_team'] . "'");
						$sel2 = $con->query("SELECT name,logo FROM teams WHERE id='" . $row['away_team'] . "'");
						$res = mysqli_fetch_array($sel1);
						$res1 = mysqli_fetch_array($sel2);
					?>
						<a href="about.php?id=<?php echo $row[0] ?>">
							<div class="listimg listimg_1_of_2">
								<img src="<?php echo $res[1];  ?>">
								<h6>Vs</h6>
								<img src="<?php echo $res[1];  ?>">
							</div>
							<div class="text list_1_of_2">
								<div class="extra-wrap">
									<span style="text-color:#000" class="data"><strong><?php

																						echo $res[0] . " Vs " . $res1[0];
																						?>
											<?php
											?></strong><br>
										<span style="text-color:#000" class="data"><strong>Location: <?php echo $row['location'] ?></strong><br>
											<div class="data">Date :<?php echo $row['date'] ?>, Time <?php echo $row['time'] ?></div>
											<span class="text-top"></span>
								</div>
							</div>
							<div class="clear"></div>
						</a>
					<?php } ?>
				</div>



				<!-- <?php
						$qry3 = mysqli_query($con, "select * from tbl_news");
						while ($n = mysqli_fetch_array($qry3)) {
						?>
				<div class="content-left">
					<div class="listimg listimg_1_of_2">
						 <img src="<?php echo $n['attachment']; ?>">
					</div>
					<div class="text list_1_of_2">
						  <div class="extra-wrap">
						  	<span style="text-color:#000" class="data"><strong><?php echo $n['name']; ?></strong><br>
						  	<span style="text-color:#000" class="data"><strong>Band :<?php echo $n['cast']; ?></strong><br>
                                <div class="data">Event Date :<?php echo $n['news_date']; ?></div>          
                                <span class="text-top"><?php echo $n['description']; ?></span>
                          </div>
					</div>
					<div class="clear"></div>
				</div>
				<?php
						}
				?> -->
			</div>
			<div class="listview_1_of_3 images_1_of_3">
				<h3>Latest Result</h3>
				<div class="middle-list">
					<div class="content-left">
						<div class="listimg listimg_1_of_2">
							<img src="images/vs1.jpg">
						</div>
						<div class="text list_1_of_2">
							<div class="extra-wrap">
								<span style="text-color:#000" class="data"><strong><?php ?></strong><br>
									<span style="text-color:#000" class="data"><strong>MUKURA VC 0-1 MUHANGA FC<?php ?></strong><br>
										<div class="data">Ended<?php ?></div>
										<span class="text-top">Stadium: Huye Stadium</span>
							</div>
						</div>
						<div class="clear"></div>
					</div>

				</div>
			</div>
			<?php include('fixtures_sidebar.php'); ?>
		</div>
	</div>


</div>
</div>
<br><br>


<?php include('footer.php'); ?>
</div>