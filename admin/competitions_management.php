<?php
require('top.inc.php');
isAdmin();
if (isset($_GET['type']) && $_GET['type'] != '') {
    $type = get_safe_value($con, $_GET['type']);

    if ($type == 'delete') {
        $id = get_safe_value($con, $_GET['id']);
        $delete_sql = "delete from competitions where id='$id'";
        mysqli_query($con, $delete_sql);
    }
}

$sql = "select * from competitions";
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
                                <h4 class="box-title">COMPETITIONS MANAGEMENT </h4>
                            </div>
                            <div class="col-lg-6 " style="text-align: right;">
                                <h4 class="box-link"><a href="manage_competition_management.php">ADD COMPETITION</a> </h4>

                            </div>
                        </div>


                    </div>
                    <div class="card-body--">
                        <div class="table-stats order-table ov-h">
                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th class="serial">#</th>

                                        <th width="39%">Competition Name</th>
                                        <th width="39%">Attending Division(s)</th>
                                        <th width="20%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    while ($row = mysqli_fetch_assoc($res)) { ?>
                                        <tr>
                                            <td class="serial"><?php echo $i ?></td>

                                            <td><?php echo $row['name'] ?></td>
                                            <td><?php echo $row['attending_division'] ?></td>


                                            <td>
                                                <?php
                                                echo "<span class='badge badge-edit'><a href='manage_competition_management.php?id=" . $row['id'] . "'>Edit</a></span>&nbsp;";

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