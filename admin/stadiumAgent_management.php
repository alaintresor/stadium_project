<?php
require('top.inc.php');

if (isset($_GET['type']) && $_GET['type'] != '') {
    $type = get_safe_value($con, $_GET['type']);

    if ($type == 'delete') {
        $id = get_safe_value($con, $_GET['id']);
        $delete_sql = "delete from stadiums where id='$id'";
        mysqli_query($con, $delete_sql);
    }
}

$sql = "SELECT * from admin_users where role='2' AND stadium_id='{$_SESSION['ADMIN_STADIUM']}'";
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
                                <h4 class="box-title">STADIUM AGENTS MANAGEMENT </h4>
                            </div>
                            <div class="col-lg-6 " style="text-align: right;">
                                <h4 class="box-link"><a href="manage_stadiumAgent_management.php">ADD AGENT</a> </h4>

                            </div>
                        </div>


                    </div>
                    <div class="card-body--">
                        <div class="table-stats order-table ov-h">
                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th class="serial">#</th>

                                        <th width="35%">name</th>
                                        <th width="35%">stadium</th>

                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    while ($row = mysqli_fetch_assoc($res)) {
                                        $i++;
                                        $stadium = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM stadiums WHERE id='{$row['stadium_id']}'"));
                                    ?>
                                        <tr>
                                            <td class="serial"><?php echo $i ?></td>
                                            <td><?php echo $row['fullname'] ?></td>
                                            <td><?php echo $stadium[1] ?></td>
                                            <td>
                                                <?php

                                                echo "<span class='badge badge-edit'><a href='manage_stadiumManager_management.php?id=" . $row['id'] . "'>Edit</a></span>&nbsp;";

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