
<?php include('header.php');
	$qry2=mysqli_query($con,"select * from fixtures where id='".$_GET['id']."'");
	$qry3=mysqli_query($con,"select * from seats_and_prices where fixture_id='".$_GET['id']."'");
	$fix=mysqli_fetch_array($qry2);
	$seat=mysqli_fetch_array($qry3);
	?>
	    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/js/materialize.min.js"></script>
<div class="content">
	<div class="wrap">
		<div class="content-top">
				<div class="section group">
					<div class="about span_1_of_2">	
						<h3><?php 
							$sel1=$con->query("SELECT name,logo FROM teams WHERE id='".$fix['home_team']."'");
							$sel2=$con->query("SELECT name,logo FROM teams WHERE id='".$fix['away_team']."'");
							$res=mysqli_fetch_array($sel1);
							$res1=mysqli_fetch_array($sel2);
						echo $res[0]." Vs ".$res1[0]; ?></h3>	
							<div class="about-top">	
								<div class="grid images_3_of_2">
									<img src="<?php echo $fix['cover_image']; ?>" alt="no image"/>
								</div>
								<div class="desc span_3_of_2">
									<p class="p-link" style="font-size:15px"><b>Location:</b> <?php echo $fix['location']; ?></p>
							<p class="p-link" style="font-size:15px"><b>Date:</b> <?php echo date('d-M-Y',strtotime($fix['date'])); ?> Time:<?php echo $fix['time'] ?></p>
									<p class="p-link" style="font-size:15px"><b>Description:</b> <?php echo $fix['description']; ?></p>
									<p class="p-link" style="font-size:15px"><b>Competition:</b> <?php echo $fix['competition']; ?></p>
									<p class="p-link" style="font-size:15px">
									<b>Seats:</b><ul><li> VVIP SEATS: No:<?php echo $seat[1]; ?>, Price:<?php echo $seat[2]; ?></li>
									<li>VIP SEATS: No: <?php echo $seat[4]; ?> ,
									Price:<?php echo $seat[5]; ?></li>
									<li>Roofed SEATS: No:<?php echo $seat[6]; ?>,
									 Price:<?php echo $seat[7]; ?></li><li>UnRoofed SEATS: No:<?php echo $seat[8]; ?> ,Price:<?php echo $seat[9]; ?></li> </p>
									<p class="p-link" style="font-size:15px">
									<a href="booking.php?id=<?php echo $_GET['id'] ?>"><button class='btn btn-primary'>Book Now</button></a>
									</p>
								
									
								</div>
								<div class="clear"></div>
							</div>
						
										</td>
									</tr>
						
						</table>
						
			    </div>	
             <?php include('fixtures_sidebar.php');?>
		  </div>			
	    </div>		
             </div>
				<div class="clear"></div>		
			</div>
 </div>
</div>
<?php include('footer.php');?>