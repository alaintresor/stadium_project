<?php
require('top.inc.php');
isManger();
if (isset($_GET['type']) && $_GET['type'] != '') {
	$type = get_safe_value($con, $_GET['type']);
	if ($type == 'status') {
		$operation = get_safe_value($con, $_GET['operation']);
		$id = get_safe_value($con, $_GET['id']);
		if ($operation == 'active') {
			$status = 'active';
		} else {
			$status = 'deactive';
		}
		$update_status_sql = "update fixtures set status='$status' where id='$id'";
		mysqli_query($con, $update_status_sql);
	}
}

$sql = "SELECT * FROM fixtures WHERE `status`='deactive' OR `status`='active' AND `location`=(SELECT `name`  FROM `stadiums` WHERE `id`='{$_SESSION['ADMIN_STADIUM']}') order by date,time asc ";
$res = mysqli_query($con, $sql);
?>
<div class="content pb-0">
	<div class="orders">
		<div class="row">
			<div class="col-xl-12">
				<div class="card">
					<div class="card-body">
						<h4 class="box-title">ACTIVE MATCH FIXTURES</h4>
					</div>
					<div class="card-body--">
						<div class="table-stats order-table ov-h">
							<table class="table ">
								<thead>
									<tr>
										<th class="serial">#</th>
										<th>ID</th>
										<th>Date</th>
										<th>Time</th>
										<th width="5%">competition</th>
										<th>Home</th>
										<th>Away</th>
										<th width="5%">Location</th>
										<th width="20%">Desrciption</th>
										<th>Actions</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<?php
									$i = 0;
									$today = date("Y-m-d");
									while ($row = mysqli_fetch_assoc($res)) {
										if ($row['date'] < $today) {
											mysqli_query($con, "UPDATE `fixtures` SET `status`='end' WHERE `id`='{$row['id']}'");
										}
										$homeTeam = mysqli_fetch_array(mysqli_query($con, "select name from teams where id='{$row['home_team']}'"));

										$awayTeam = mysqli_fetch_array(mysqli_query($con, "select name from teams where id='{$row['away_team']}'"));
										$i++;
									?>
										<tr>
											<td class="serial"><?php echo $i ?></td>
											<td><?php echo $row['id'] ?></td>
											<td><?php echo $row['date'] ?></td>
											<td><?php echo $row['time'] ?></td>
											<td><?php echo $row['competition'] ?></td>
											<td><?php echo $homeTeam[0] ?></td>
											<td><?php echo $awayTeam[0] ?></td>
											<td><?php echo $row['location'] ?></td>
											<td><?php echo $row['description'] ?></td>

											<td>
												<?php
												if ($row['status'] == 'active') {
													echo "<span class='badge badge-complete'><a href='?type=status&operation=deactive&id=" . $row['id'] . "'>Active</a></span>&nbsp;";
												} else {
													echo "<span class='badge badge-pending'><a href='?type=status&operation=active&id=" . $row['id'] . "'>Deactive</a></span>&nbsp;";
												}
												?>
											</td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
require('footer.inc.php');
?>