
<?php include('header.php');
extract($_POST);
?>
</div>
<div class="content">
	<div class="wrap">
		<div class="content-top">
			<h3>Fixtures</h3>
			<?php
          	 $today=date("Y-m-d");
          	 $search=$_POST['searching'];
          	$qry2=mysqli_query($con,"select id,location,home_team,away_team,cover_image,description,date,time from fixtures where competition LIKE '%" . $search . "%' AND status='active' AND date>'$today'");
          	  while($row=mysqli_fetch_array($qry2))
                   {
						$sel1 = $con->query("SELECT name,logo FROM teams WHERE id='" . $row['home_team'] . "'");
						$sel2 = $con->query("SELECT name,logo FROM teams WHERE id='" . $row['away_team'] . "'");
						$res = mysqli_fetch_array($sel1);
						$res1 = mysqli_fetch_array($sel2);
					?>
						<a href="about.php?id=<?php echo $row[0] ?>">
							<div class="listimg listimg_1_of_2">
								<img src="<?php echo $row['cover_image']; ?>">
								
							</div>
							<div class="text list_1_of_2" style="background:darkgreen; text-align:center;color:white;border-radius:10px 4px 4px 4px;">
							<div class="extra-wrap">
								<span style="color:white" class="data"><strong><?php

									echo $res[0] . " Vs " . $res1[0];
																					?>
										<?php
										?></strong><br>
									<span style="color:white" class="data"><strong>Location: <?php echo $row['location'] ?></strong><br>
										<div class="data"  style="color:white">Date :<?php echo $row['date'] ?>, Time <?php echo $row['time'] ?></div>
										<span class="text-top"></span>
							</div>
						</div>
						<div class="clear"></div>
						</a>
  	    <?php
  	    	}
  	    	?>

</div>
			<?php include('footer.php');?>
