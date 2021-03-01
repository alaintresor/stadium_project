<?php
require('top.inc.php');
isManger();
if (isset($_GET['type']) && $_GET['type'] != '') {
    $type = get_safe_value($con, $_GET['type']);
    if ($type == 'delete') {
        $id = get_safe_value($con, $_GET['id']);
        $delete_sql = "delete from seats_and_prices where id='$id'";
        mysqli_query($con, $delete_sql);
    }
}

$sql = "SELECT * FROM `seats_and_prices` order by id desc";
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
                                <h4 class="box-title">SEATS & PRICES MANAGEMENT </h4>
                            </div>
                            <div class="col-lg-6 " style="text-align: right;">
                                <h4 class="box-link"><a href="manage_seats_management.php">ADD SEAT & PRICE</a> </h4>

                            </div>
                        </div>


                    </div>
                    <div class="card-body--">
                        <div class="table-stats order-table ov-h">
                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th class="serial">#</th>
                                        <th>Fixture ID</th>
                                        <th>VVIP Seats</th>
                                        <th>VVIP Price</th>
                                        <th>VIP Seats</th>
                                        <th>VIP Price</th>
                                        <th>Roofed Seats</th>
                                        <th>Roofed Price</th>
                                        <th width="5%">Unroofed Seats</th>
                                        <th>Unoofed Price</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    while ($row = mysqli_fetch_assoc($res)) { ?>
                                        <tr>
                                            <td class="serial"><?php echo $i ?></td>
                                            <td><?php echo $row['fixture_id'] ?></td>
                                            <td><?php echo $row['vvip_seats'] ?></td>
                                            <td><?php echo $row['vvip_price'] ?></td>
                                            <td><?php echo $row['vip_seats'] ?></td>
                                            <td><?php echo $row['vip_price'] ?></td>
                                            <td><?php echo $row['roofed_seats'] ?></td>
                                            <td><?php echo $row['roofed_price'] ?></td>
                                            <td><?php echo $row['unroofed_seats'] ?></td>
                                            <td><?php echo $row['unroofed_price'] ?></td>
                                            <td>
                                                <?php

                                                echo "<span class='badge badge-edit'><a href='manage_vendor_management.php?id=" . $row['id'] . "'>Edit</a></span>&nbsp;";

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