<?php
require('top.inc.php');
isAdmin();
if (isset($_GET['type']) && $_GET['type'] != '') {
	$type = get_safe_value($con, $_GET['type']);

	if ($type == 'delete') {
		$id = get_safe_value($con, $_GET['id']);
		$delete_sql = "delete from fixtures where id='$id'";
		mysqli_query($con, $delete_sql);
	}
}

$sql = "select * from fixtures";
$res = mysqli_query($con, $sql);
?>
<div class="content pb-0">
	<div class="orders">
		<div class="row">
			<div class="col-xl-12">
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col-lg-6">
								<h4 class="box-title">MATCH FIXTURES MANAGEMENT </h4>
							</div>
							<div class="col-lg-6 " style="text-align: right;">
								<h4 class="box-link"><a href="manage_fixtures_management.php">ADD FIXTURE</a> </h4>

							</div>
						</div>


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
										<th>competition</th>
										<th>Home</th>
										<th>Away</th>
										<th>Location</th>
										<th>Desrciption</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$i = 1;
									while ($row = mysqli_fetch_assoc($res)) {
										$homeTeam = mysqli_fetch_array(mysqli_query($con, "select name from teams where id='{$row['home_team']}'"));

										$awayTeam = mysqli_fetch_array(mysqli_query($con, "select name from teams where id='{$row['away_team']}'"));
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
												if ($row['status'] == 1) {
													echo "<span class='badge badge-complete'><a href='?type=status&operation=deactive&id=" . $row['id'] . "'>Active</a></span>&nbsp;";
												} else {
													echo "<span class='badge badge-pending'><a href='?type=status&operation=active&id=" . $row['id'] . "'>Deactive</a></span>&nbsp;";
												}
												echo "<span class='badge badge-edit'><a href='manage_fixtures_management.php?id=" . $row['id'] . "'>Edit</a></span>&nbsp;";

												echo "<span class='badge badge-delete'><a href='?type=delete&id=" . $row['id'] . "'>Delete</a></span>";

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