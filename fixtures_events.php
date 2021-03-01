
<?php include('header.php');?>
<div class="content">
	<div class="wrap">
	<center>
	<h1 style="background:yellow">Smart Stadium Ticket Selling System</h1></center>
		<div class="content-top">
			<h3>Fixtures</h3>		
			<?php
          	 $today=date("Y-m-d");
          	 $qry2=mysqli_query($con,"select * from  fixtures");
          	  while($m=mysqli_fetch_array($qry2))
                   {
                    ?>           
                    <div class="col_1_of_4 span_1_of_4">
					<div class="imageRow">
						  	<div class="single">
						  	<div class="listimg listimg_1_of_2">
						 <img src="images/vs1.jpg">
					</div>
						  	</div>
						  	<div class="movie-text">
						  		<h4 class="h-text"><a href="about.php?id=<?php echo $m['concert_id'];?>">MUKURA VC 0-1 MUHANGA FC</a></h4>
						  		Description:<Span class="color2"><?php echo $m['description'];?></span><br>	  		
						  	</div>
		  				</div>
		  		</div>	
  	    <?php
  	    	}
  	    	?>
			</div>
				<div class="clear"></div>		
			</div>
			<?php include('footer.php');?>