<?php
require('top.inc.php');
isAdmin();
if (isset($_GET['type']) && $_GET['type'] != '') {
    $type = get_safe_value($con, $_GET['type']);

    if ($type == 'delete') {
        $id = get_safe_value($con, $_GET['id']);
        $delete_sql = "delete from teams where id='$id'";
        mysqli_query($con, $delete_sql);
    }
}

$sql = "select * from teams";
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
                                <h4 class="box-title">TEAMS MANAGEMENT </h4>
                            </div>
                            <div class="col-lg-6 " style="text-align: right;">
                                <h4 class="box-link"><a href="manage_teams_management.php">ADD TEAM</a> </h4>

                            </div>
                        </div>


                    </div>
                    <div class="card-body--">
                        <div class="table-stats order-table ov-h">
                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th class="serial">#</th>
                                        <th width="20%">Logo</th>
                                        <th width="2%">ID</th>
                                        <th width="20%">Name</th>
                                        <th width="20%">Division</th>
                                        <th width="26%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    while ($row = mysqli_fetch_assoc($res)) { ?>
                                        <tr>
                                            <td class="serial"><?php echo $i ?></td>
                                            <td><img src="../<?php echo $row['logo'] ?>" alt="" width="200"> </td>
                                            <td><?php echo $row['id'] ?></td>
                                            <td><?php echo $row['name'] ?></td>
                                            <td><?php echo $row['division'] ?></td>


                                            <td>
                                                <?php
                                                echo "<span class='badge badge-edit'><a href='manage_teams_management.php?id=" . $row['id'] . "'>Edit</a></span>&nbsp;";

                                                echo "<span class='badge badge-delete'><a href='?type=delete&id=" . $row['id'] . "'>Delete</a></span>";
                                                $i++;
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