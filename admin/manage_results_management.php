<?php
require('top.inc.php');
isAdmin();
$fixtureId = '';
$homeResult = '';
$awayResult = '';


$msg = '';
if (isset($_GET['id']) && $_GET['id'] != '') {
    $image_required = '';
    $id = get_safe_value($con, $_GET['id']);
    $res = mysqli_query($con, "select * from results where id='$id'");
    $check = mysqli_num_rows($res);
    if ($check > 0) {
        $row = mysqli_fetch_assoc($res);
        $fixtureId = $row['fixture_id'];
        $homeResult = $row['home_team_result'];
        $awayResult = $row['away_team_result'];
    } else {
        header('location:result_management.php');
        die();
    }
}

if (isset($_POST['submit'])) {
    $fixtureId = get_safe_value($con, $_POST['fixtureId']);
    $homeResult = get_safe_value($con, $_POST['homeResult']);
    $awayResult = get_safe_value($con, $_POST['awayResult']);

    if ($msg == '') {
        if (isset($_GET['id']) && $_GET['id'] != '') {
            $update_sql = "UPDATE results SET fixture_id='$fixtureId',home_team_result='$homeResult',away_team_result='$awayResult' WHERE id='$id'";
            mysqli_query($con, $update_sql);
        } else {
            mysqli_query($con, "INSERT INTO `results` (`id`, `fixture_id`, `home_team_result`, `away_team_result`) VALUES (NULL, '$fixtureId', '$homeResult', '$awayResult');");
        }
        header('location:result_management.php');
        die();
    }
}
?>
<div class="content pb-0">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header"><strong>ADD NEW RESULT FORM</strong><small> </small></div>
                    <form method="post" enctype="multipart/form-data">
                        <div class="card-body card-block">

                            <div class="form-group">
                                <label for="date" class=" form-control-label">Fixture Id</label>
                                <input type="text" name="fixtureId" id="fixture" onchange="selectTeams()" class="form-control" placeholder="Enter fixture Id" required value="<?php echo $fixtureId ?>">
                            </div>
                            <div class="form-group">
                                <label for="date" class=" form-control-label">Home Team</label>
                                <input type="text" class="form-control" value="" id="home" disabled>
                            </div>
                            <div class="form-group">
                                <label for="time" class=" form-control-label">Home Team result</label>
                                <input type="text" name="homeResult" class="form-control" required value="<?php echo $homeResult ?>">
                            </div>

                            <div class="form-group">
                                <label for="homeTeam" class=" form-control-label">Away Team</label>
                                <input type="text" class="form-control" required value="" id="away" disabled>
                            </div>
                            <div class="form-group">
                                <label for="text" class=" form-control-label">Away Team result</label>
                                <input type="text" name="awayResult" class="form-control" required value="<?php echo $awayResult ?>">
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

                    $("#home").val(data);

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

                    $("#away").val(data);

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