<?php
require('top.inc.php');
$queryFixtures = "SELECT * FROM `fixtures`,booking_teckets WHERE fixtures.id=booking_teckets.fixture_id AND booking_teckets.stadiumAgent_id='{$_SESSION['ADMIN_ID']}'";
$dataFixtures = mysqli_query($con, "$queryFixtures");

// $data2 = mysqli_query($con, "$query");
?>
<style>
    #dashbroad-card {
        border: 2px solid#121c20;
        /* width: 80%; */
    }
</style>
<div class="content pb-0">
    <div class="orders">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="box-title">REPORTS </h4>
                        <hr>
                        <div class="row">
                            <div class="col-lg-6">
                                <table>
                                    <tr>
                                        <td>
                                            <div class="form-group">
                                                <label for="date" class=" form-control-label">CHECKED TICKETS</label>
                                                <select id="checked" class="form-control">
                                                    <?php
                                                    while ($row = mysqli_fetch_array($dataFixtures)) {
                                                        $homeTeam = mysqli_fetch_array(mysqli_query($con, "select name from teams where id='{$row['home_team']}'"));

                                                        $awayTeam = mysqli_fetch_array(mysqli_query($con, "select name from teams where id='{$row['away_team']}'"));
                                                    ?>
                                                        <option value="<?php echo $row['id'] ?>"><?php echo $row['date'] ?>: <?php echo $homeTeam[0] ?> VS <?php echo $awayTeam[0] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </td>
                                        <td>
                                            <button class="btn" onclick="window.open(`tickets_report.php?id=${$('#checked').val()}&type=1`)" style="margin-top:10px">Generete</button>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                        </div>
                        <br><br><br><br>


                        <br><br>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    require('footer.inc.php');
    ?>