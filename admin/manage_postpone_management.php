<?php
require('top.inc.php');
isAdmin();
$fixtureId = '';
$reason = '';
$movedOn = '';
$movedAt = '';

$msg = '';
if (isset($_GET['id']) && $_GET['id'] != '') {
    $image_required = '';
    $id = get_safe_value($con, $_GET['id']);
    $res = mysqli_query($con, "SELECT * FROM `postponed_matchs` where id='$id'");
    $check = mysqli_num_rows($res);
    if ($check > 0) {
        $row = mysqli_fetch_assoc($res);
        $fixtureId = $row['fixture_id'];
        $movedOn = $row['moved_date'];
        $movedAt = $row['moved_time'];
        $reason = $row['reason'];
    } else {
        header('location:postpone_management.php');
        die();
    }
}

if (isset($_POST['submit'])) {
    $fixtureId = get_safe_value($con, $_POST['fixtureId']);
    $reason = get_safe_value($con, $_POST['reason']);
    $movedOn = get_safe_value($con, $_POST['movedOn']);
    $movedAt = get_safe_value($con, $_POST['movedAt']);

    $fromOn = mysqli_fetch_array(mysqli_query($con, "SELECT date FROM `fixtures` WHERE `id`='$fixtureId'"));

    $fromAt = mysqli_fetch_array(mysqli_query($con, "SELECT time FROM `fixtures` WHERE `id`='$fixtureId'"));

    if ($msg == '') {
        if (isset($_GET['id']) && $_GET['id'] != '') {
            $update_sql = "update postponed_matchs set fixture_id='$fixtureId',reason='$reason',fromOn='$fromOn[0]',fromAt='$fromAt[0]',moved_date='$movedOn',moved_time='$movedAt' where id='$id'";
            mysqli_query($con, $update_sql);
            // updating date on fixtures
            mysqli_query($con, "UPDATE `fixtures` SET `date`='$movedOn',`time`='$movedAt',`status`='postponed' WHERE `id`='$fixtureId'");
        } else {
            $done = mysqli_query($con, "INSERT INTO `postponed_matchs` (`id`, `fixture_id`, `reason`,`fromOn`,`fromAt`, `moved_date`, `moved_time`) VALUES (NULL, '$fixtureId', '$reason','$fromOn[0]','$fromAt[0]', '$movedOn', '$movedAt')");
            // updating date on fixtures
            mysqli_query($con, "UPDATE `fixtures` SET `date`='$movedOn',`time`='$movedAt',`status`='postponed' WHERE `id`='$fixtureId'");
            if ($done) {
                $ticketsQuery = "SELECT customers.fullname,customers.telephone,fixtures.home_team,fixtures.away_team FROM customers,fixtures,booking_teckets WHERE customers.id=booking_teckets.customer_id AND booking_teckets.fixture_id=fixtures.id AND fixtures.id='$fixtureId'";

                $ticketsData = mysqli_query($con, "$ticketsQuery");

                while ($row = mysqli_fetch_array($ticketsData)) {
                    $homeTeam = mysqli_fetch_array(mysqli_query($con, "SELECT `name` FROM `teams` WHERE `id`='{$row['home_team']}'"));

                    $awayTeam = mysqli_fetch_array(mysqli_query($con, "SELECT `name` FROM `teams` WHERE `id`='{$row['away_team']}'"));

                    $phone = "+25" . $row['telephone'];
                    $message = "Dear {$row['fullname']} , your ticket has been postponed due to match({$homeTeam[0]} VS {$awayTeam[0]}) is postponed from {$fromOn[0]} at {$fromAt[0]}, to {$movedOn} at {$movedAt},  because {$reason}.
                   
                     THANK YOU
                    ";
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => 'https://api.mista.io/sms',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS => array('to' => $phone, 'from' => 'SmarTicket', 'unicode' => '0', 'sms' => $message, 'action' => 'send-sms'),
                        CURLOPT_HTTPHEADER => array(
                            'x-api-key:andrass7'
                        ),
                    ));

                    $response = curl_exec($curl);

                    curl_close($curl);
                }
            }
        }
        header('location:postpone_management.php');
        die();
    }
}
?>
<div class="content pb-0">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header"><strong>ADD NEW POSTPONED MATCH</strong><small> </small></div>
                    <form method="post" enctype="multipart/form-data">
                        <div class="card-body card-block">

                            <div class="form-group">
                                <label for="date" class=" form-control-label">Fixture Id</label>
                                <input type="text" name="fixtureId" onchange="selectTeams()" id="fixture" class="form-control" required value="<?php echo $fixtureId ?>">
                            </div>
                            <div id="show" style="display:none">
                                <span id="home"></span> VS <span id="away"></span>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="date" class=" form-control-label">Reason:</label>
                                <textarea class="form-control" required name="reason" placeholder="Describle reason couse match to be postponed">
                                <?php echo $reason ?>
                                </textarea>
                            </div>
                            <b>Match moved</b>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="time" class=" form-control-label">ON</label>
                                        <input type="date" name="movedOn" class="form-control" required value="<?php echo $movedOn ?>">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="time" class=" form-control-label">AT</label>
                                        <input type="time" name="movedAt" class="form-control" required value="<?php echo $movedAt ?>">
                                    </div>
                                </div>
                            </div>




                            <button id="payment-button" name="submit" type="submit" class="btn btn-lg btn-info btn-block">
                                <span id="payment-button-amount">POSTPONE</span>
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