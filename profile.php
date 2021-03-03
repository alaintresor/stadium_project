<!--
@author: Vasilis Tsakiris
-->
<?php include('header.php');
if(!isset($_SESSION['user']))
{
	header('location:login.php');
}

	?>
<div class="content">
	<div class="wrap">
		<div class="content-top">
				<div class="section group">
											<?php include('msgbox.php');?>

					<div class="about span_1_of_2">	
						<h3>Bookings</h3>
						<?php include('msgbox.php');?>
						<?php
				$bk=mysqli_query($con,"select * from booking_teckets where customer_id='".$_SESSION['user']."'");
				if(mysqli_num_rows($bk))
				{
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
						<th></th>
						</thead>
						<tbody>
						<?php
						while($bkg=mysqli_fetch_array($bk))
						{
							
							?>
							<tr>
								<td>
									<?php echo $bkg['id'];?>
								</td>
								<td>

									<?php
									 $qry2 = mysqli_query($con,"select * from fixtures where id='".$bkg['fixture_id']."'");
									 $fix = mysqli_fetch_array($qry2);
									 $sel1 = $con->query("SELECT name,logo FROM teams WHERE id='" . $fix['home_team'] . "'");
									 $sel2 = $con->query("SELECT name,logo FROM teams WHERE id='" . $fix['away_team'] . "'");
									 $res = mysqli_fetch_array($sel1);
									 $res1 = mysqli_fetch_array($sel2);
									 echo "<b>(" . $res[0] . " Vs " . $res1[0].")</b>"; 
									
									?>
								</td>
								<td>
									<?php echo $fix['location'];?>
								</td>
								<td>
									<?php echo $bkg['seat'];?>
								</td>
									<td>
									<?php echo $bkg['date'];?>
								</td>
								<td>
									<?php echo $bkg['n_of_seats'];?>
								</td>
								<td>
									<?php echo $bkg['amount'];?>
								</td>
								<td>
									Rwf <?php echo $bkg['amount'];?>
								</td>
								<td>
									<?php  if($bkg['date']<date('Y-m-d'))
									{
										?>
										<i class="glyphicon glyphicon-ok">finished</i>
										<?php
									}
									else
									{?>
									<b>Pending</b>
<!-- <button data-toggle="modal"  data-target="#cancel" class="btn btn-danger btn-sm"
 data-toggle="modal"><i class="fa fa-trash"></i> <a style="color:white;     text-decoration: none;
" href="cancel.php?id=<?php echo $bkg['id'];?>">Cancel</a></i></button> -->
									<?php
									}
									?>
								</td>
							</tr>
							<?php
						}
						?></tbody>
					</table>
					<?php
				}
				else
				{
					?>
					<h3>No Previous Bookings</h3>
					<?php
				}
				?>
					</div>		
		       
			</div>
			<div class="about span_1_of_2">	
						
						<?php
				$pr=mysqli_query($con,"select * from customers where id='".$_SESSION['user']."'");
				if(mysqli_num_rows($pr))
				{
					?>
				
					<?php
				}
				else
				{
					?>
					<h3>No Account Details</h3>
					<?php
				}
				?>		</div>
          
        </div>
					</div>	
		
				<div class="clear"></div>

						
		</div>
	</div>
				
<?php include('footer.php');?>
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

#update:invalid + span:after {
    content: '✖';
    color: red;
    padding-left: 5px;
}

#update:valid + span:after {
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
	$('#seats').change(function(){
		var charge=<?php echo $screen['charge'];?>;
		amount=charge*$(this).val();
		$('#amount').html("€ "+amount);
		$('#hm').val(amount);
	});
</script>


