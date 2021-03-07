<?php
require('top.inc.php');
isManger();
$fixtureId = '';
$vvipNber = '';
$vvipPrice = '';
$vipNber = '';
$vipPrice = '';
$roofedNber = '';
$roofedPrice = '';
$unroofedNber = '';
$unroofedPrice = '';

$msg = '';
if (isset($_GET['id']) && $_GET['id'] != '') {
    $image_required = '';
    $id = get_safe_value($con, $_GET['id']);
    $res = mysqli_query($con, "select * from seats_and_prices where id='$id'");
    $check = mysqli_num_rows($res);
    if ($check > 0) {
        $row = mysqli_fetch_assoc($res);
        $fixtureId = $row['fixture_id'];
        $vvipNber = $row['vvip_seats'];
        $vvipPrice = $row['vvip_price'];
        $vipNber = $row['vip_seats'];
        $roofedNber = $row['roofed_seats'];
        $roofedPrice = $row['roofed_price'];
        $unroofedNber = $row['unroofed_seats'];
        $unroofedPrice = $row['unroofed_price'];
    } else {
        header('location:seats_management.php');
        die();
    }
}

if (isset($_POST['submit'])) {
    $fixtureId = get_safe_value($con, $_POST['fixtureId']);
    $vvipNber = get_safe_value($con, $_POST['vvipNber']);
    $vvipPrice = get_safe_value($con, $_POST['vvipPrice']);
    $vipNber = get_safe_value($con, $_POST['vipNber']);
    $vipPrice = get_safe_value($con, $_POST['vipPrice']);
    $roofedNber = get_safe_value($con, $_POST['roofedNber']);
    $roofedPrice = get_safe_value($con, $_POST['roofedPrice']);
    $unroofedNber = get_safe_value($con, $_POST['unroofedNber']);
    $unroofedPrice = get_safe_value($con, $_POST['unroofedPrice']);

    if ($msg == '') {
        if (isset($_GET['id']) && $_GET['id'] != '') {
            $update_sql = "UPDATE `seats_and_prices` SET `fixture_id`='$fixtureId', `vvip_seats`='$vvipNber', `vvip_price`='$vvipPrice', `vip_seats`='$vipNber', `vip_price`='$vipPrice', `roofed_seats`='$roofedNber', `roofed_price`='$roofedPrice', `unroofed_seats`='$unroofedNber', `unroofed_price`='$unroofedPrice' where id='$id'";
            mysqli_query($con, $update_sql);
        } else {
            mysqli_query($con, "INSERT INTO `seats_and_prices` (`id`, `fixture_id`, `vvip_seats`, `vvip_price`, `vip_seats`, `vip_price`, `roofed_seats`, `roofed_price`, `unroofed_seats`, `unroofed_price`) VALUES (NULL, '$fixtureId', '$vvipNber', '$vvipPrice', '$vipNber', '$vipPrice', '$roofedNber', '$roofedPrice', '$unroofedNber', '$unroofedPrice');");
            mysqli_query($con, "UPDATE fixtures SET status='end' WHERE id='$fixtureId'");
        }
        header('location:seats_management.php');
        die();
    }
}
$queryFixtures = "SELECT * FROM `fixtures` WHERE  `location`=(SELECT `name`  FROM `stadiums` WHERE `id`='{$_SESSION['ADMIN_STADIUM']}')";
$dataFixtures = mysqli_query($con, "$queryFixtures");
?>
<div class="content pb-0">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header"><strong>ADD SEATS AND PRICE</strong><small> </small></div>
                    <form method="post" enctype="multipart/form-data">
                        <div class="card-body card-block">


                            <div class="form-group">
                                <label for="date" class=" form-control-label">Match</label>
                                <select id="checked" class="form-control" name="fixtureId" required>
                                    <?php
                                    while ($row = mysqli_fetch_array($dataFixtures)) {
                                        $homeTeam = mysqli_fetch_array(mysqli_query($con, "select name from teams where id='{$row['home_team']}'"));

                                        $awayTeam = mysqli_fetch_array(mysqli_query($con, "select name from teams where id='{$row['away_team']}'"));
                                    ?>
                                        <option value="<?php echo $row['id'] ?>"><?php echo $row['date'] ?>: <?php echo $homeTeam[0] ?> VS <?php echo $awayTeam[0] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div id="show" style="display:none">
                                <span id="home"></span> VS <span id="away"></span>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-lg-2">
                                    <br>
                                    <b>VVIP Seats</b>
                                </div>
                                <div class="col-lg-5">
                                    <div class="form-group">
                                        <label for="seat" class=" form-control-label">Seat Number</label>
                                        <input type="number" name="vvipNber" class="form-control" placeholder="Enter Number of avialable seat" required value="<?php echo $vvipNber ?>">
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <div class="form-group">
                                        <label for="Price" class=" form-control-label">Price</label>
                                        <input type="number" name="vvipPrice" class="form-control" placeholder="Enter Number of avialable seat" required value="<?php echo $vvipPrice ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2">
                                    <br>
                                    <b>VIP Seats</b>
                                </div>
                                <div class="col-lg-5">
                                    <div class="form-group">
                                        <label for="seat" class=" form-control-label">Seat Number</label>
                                        <input type="number" name="vipNber" class="form-control" placeholder="Enter Number of avialable seat" required value="<?php echo $vipNber ?>">
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <div class="form-group">
                                        <label for="Price" class=" form-control-label">Price</label>
                                        <input type="number" name="vipPrice" class="form-control" placeholder="Enter Number of avialable seat" required value="<?php echo $vipPrice ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2">
                                    <br>
                                    <b>Roofed Seats</b>
                                </div>
                                <div class="col-lg-5">
                                    <div class="form-group">
                                        <label for="seat" class=" form-control-label">Seat Number</label>
                                        <input type="number" name="roofedNber" class="form-control" placeholder="Enter Number of avialable seat" required value="<?php echo $roofedNber ?>">
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <div class="form-group">
                                        <label for="Price" class=" form-control-label">Price</label>
                                        <input type="number" name="roofedPrice" class="form-control" placeholder="Enter Number of avialable seat" required value="<?php echo $roofedPrice ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2">
                                    <br>
                                    <b>Unfooed Seats</b>
                                </div>
                                <div class="col-lg-5">
                                    <div class="form-group">
                                        <label for="seat" class=" form-control-label">Seat Number</label>
                                        <input type="number" name="unroofedNber" class="form-control" placeholder="Enter Number of avialable seat" required value="<?php echo $unroofedNber ?>">
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <div class="form-group">
                                        <label for="Price" class=" form-control-label">Price</label>
                                        <input type="number" name="unroofedPrice" class="form-control" placeholder="Enter Number of avialable seat" required value="<?php echo $unroofedPrice ?>">
                                    </div>
                                </div>
                            </div>

                            <button id="payment-button" name="submit" type="submit" class="btn btn-lg btn-info btn-block">
                                <span id="payment-button-amount">SUBMIT</span>
                            </button>
                            <div class="field_error"><?php echo $msg ?></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    const selectTeams = () => {
        var show = $("#show").show();
        var id = $("#fixture").val();
        const getOne = () => {

            let team = 1;
            $.ajax({
                url: "getTeam.php",
                type: "POST",
                data: {
                    id,
                    team
                },
                success: function(data) {

                    $("#home").html(data);

                }

            })
        }

        const getTwo = () => {

            let team = 2;
            $.ajax({
                url: "getTeam.php",
                type: "POST",
                data: {
                    id,
                    team
                },
                success: function(data) {

                    $("#away").html(data);

                }

            })
        }
        getOne();
        getTwo();
    }
</script>


<?php
require('footer.inc.php');
?>