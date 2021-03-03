
 			<div class="listview_1_of_3 images_1_of_3">
					<h3>Today match(es)</h3>	
					<?php
          	 $today=date("Y-m-d");
          	$qry2=mysqli_query($con,"select * from  fixtures where date='$today' AND status='active'");

			  if(mysqli_num_rows($qry2)==0){ 
		?>
				<div class="content-left">
				<div class="listimg listimg_1_of_2">
					
				</div>
				<div class="text list_1_of_2">
					  <div class="extra-wrap">
						  <span style="text-color:#000" class="data"><strong><?php ?></strong><br>
						  <span style="text-color:#000" class="data"><strong>no Match To show<?php ?></strong><br>
							<!-- <div class="data">Ended<?php ?></div>          
							<span class="text-top">Stadium: Huye Stadium</span> -->
					  </div>
				</div>
				<div class="clear"></div>
			</div>
			 <?php } else{

          	  while($row=mysqli_fetch_array($qry2))
                   {
					$sel1 = $con->query("SELECT name,logo FROM teams WHERE id='" . $row['home_team'] . "'");
					$sel2 = $con->query("SELECT name,logo FROM teams WHERE id='" . $row['away_team'] . "'");
					$res = mysqli_fetch_array($sel1);
					$res1 = mysqli_fetch_array($sel2);
				?>
					<a href="about.php?id=<?php echo $row[0] ?>">
						<div class="listimg listimg_1_of_2" >
							<img src="<?php echo $res[1];  ?>">
							<h6>Vs</h6>
							<img src="<?php echo $res1[1];  ?>">
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
  	    	} }
  	    	?>
					
					
				
				
					
					
				
				
				
				
				</div>		
				<div class="clear"></div>		
			
