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
            $selp=mysqli_query($con,"SELECT * FROM booking_teckets WHERE fixture_id='$fixtureId'");
            while($row=mysqli_fetch_array($selp)){
                $sel=$con->query("SELECT telephone FROM customers WHERE id='".$row['1']."'");
                $res=mysqli_fetch_array($sel);
                      	// Account details
	$apiKey = urlencode('QCZCGpsNseI-gd0snkBj4zC49shTyTbP1AAW9AgNMX');
	
	// Message details
	$numbers = array($res[0], );
	$sender = urlencode('Smart Ticket System');
	$message = rawurlencode('This is your message');
 
	$numbers = implode(',', $numbers);
 
	// Prepare data for POST request
	$data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);
 
	// Send the POST request with cURL
	$ch = curl_init('https://api.txtlocal.com/send/');
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($ch);
	curl_close($ch);
	
	// Process your response here
	echo $response;
            }
    //         	// Account details
	// $apiKey = urlencode('QCZCGpsNseI-gd0snkBj4zC49shTyTbP1AAW9AgNMX');
	
	// // Message details
	// $numbers = array(, );
	// $sender = urlencode('Smart Ticket System');
	// $message = rawurlencode('This is your message');
 
	// $numbers = implode(',', $numbers);
 
	// // Prepare data for POST request
	// $data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);
 
	// // Send the POST request with cURL
	// $ch = curl_init('https://api.txtlocal.com/send/');
	// curl_setopt($ch, CURLOPT_POST, true);
	// curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	// $response = curl_exec($ch);
	// curl_close($ch);
	
	// // Process your response here
	// echo $response;
            mysqli_query($con, "INSERT INTO `postponed_matchs` (`id`, `fixture_id`, `reason`,`fromOn`,`fromAt`, `moved_date`, `moved_time`) VALUES (NULL, '$fixtureId', '$reason','$fromOn[0]','$fromAt[0]', '$movedOn', '$movedAt')");
            // updating date on fixtures
            mysqli_query($con, "UPDATE `fixtures` SET `date`='$movedOn',`time`='$movedAt',`status`='postponed' WHERE `id`='$fixtureId'");
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