<?php
require('top.inc.php');
isAdmin();
if (isset($_GET['type']) && $_GET['type'] != '') {
    $type = get_safe_value($con, $_GET['type']);
    if ($type == 'status') {
        $operation = get_safe_value($con, $_GET['operation']);
        $id = get_safe_value($con, $_GET['id']);
        if ($operation == 'active') {
            $status = '1';
        } else {
            $status = '0';
        }
        $update_status_sql = "update admin_users set status='$status' where id='$id'";
        mysqli_query($con, $update_status_sql);
    }

    if ($type == 'delete') {
        $id = get_safe_value($con, $_GET['id']);
        $delete_sql = "delete from results where id='$id'";
        mysqli_query($con, $delete_sql);
    }
}

$sql = "select * from results order by id desc";
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
                                <h4 class="box-title">RESULTS MANAGEMENT </h4>
                            </div>
                            <div class="col-lg-6 " style="text-align: right;">
                                <h4 class="box-link"><a href="manage_results_management.php">ADD RESULT</a> </h4>

                            </div>
                        </div>


                    </div>
                    <div class="card-body--">
                        <div class="table-stats order-table ov-h">
                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th class="serial">#</th>
                                        <th width="15%">Date</th>
                                        <th width="10%">Time</th>
                                        <th width="15%">Home Team</th>
                                        <th width="15%">HomeTeam Result </th>
                                        <th width="15%">AwayTeam Result </th>
                                        <th width="15%">Away Team</th>
                                        <th width="26%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    while ($row = mysqli_fetch_assoc($res)) {
                                        $fixture = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `fixtures` where id='{$row['fixture_id']}' "));
                                        $homeTeam = mysqli_fetch_array(mysqli_query($con, "select name from teams where id='{$fixture['home_team']}' "));
                                        $awayTeam = mysqli_fetch_array(mysqli_query($con, "select name from teams where id='{$fixture['away_team']}' "));
                                        $i++;
                                    ?>
                                        <tr>
                                            <td class="serial"><?php echo $i ?></td>
                                            <td><?php echo $fixture['date'] ?></td>
                                            <td><?php echo $fixture['time'] ?></td>
                                            <td><?php echo $homeTeam[0] ?></td>
                                            <td><?php echo $row['home_team_result'] ?></td>
                                            <td><?php echo $row['away_team_result'] ?></td>
                                            <td><?php echo $awayTeam[0] ?></td>



                                            <td>
                                                <?php

                                                echo "<span class='badge badge-edit'><a href='manage_results_management.php?id=" . $row['id'] . "'>Edit</a></span>&nbsp;";

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