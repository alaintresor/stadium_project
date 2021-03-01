
<?php include('header.php');
extract($_POST);
?>
</div>
<div class="content">
	<div class="wrap">
		<div class="content-top">
			<h3>Concerts</h3>
			<?php
          	 $today=date("Y-m-d");
          	 $search=$_POST['searching'];
          	$qry2=mysqli_query($con,"select DISTINCT id,location,home_team,away_team,cover_image,description from fixtures where competition LIKE '%" . $search . "%'");
          	  while($m=mysqli_fetch_array($qry2))
                   {
                    ?>       
                    <div class="col_1_of_4 span_1_of_4">
					<div class="imageRow">
						  	<div class="single">
						  		<a href="about.php?id=<?php echo $m['id'];?>" rel="lightbox"><img src="<?php echo $m['cover_image'];?>" alt="" /></a>
						  	</div>
						  	<div class="movie-text">
						  		<h4 class="h-text"><a href="about.php?id=<?php echo $m['id'];?>"><?php echo $m['description'];?></a></h4>
						  		location:<Span class="color2"><?php echo $m['location']?></span><br>						  		
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
