<?php
require('top.inc.php');
isManger();

//getting all competitions 
$compQuery = mysqli_query($con, "SELECT * FROM `competitions`");
$compQuery2 = mysqli_query($con, "SELECT * FROM `competitions`");
$compQuery3 = mysqli_query($con, "SELECT * FROM `competitions`");
$queryFixtures = "SELECT * FROM `fixtures` WHERE `status`='end'";
$dataFixtures = mysqli_query($con, "$queryFixtures");

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
                                                <label for="date" class=" form-control-label">MATCHES RESULTS</label>
                                                <select id="result" class="form-control">
                                                    <?php while ($row = mysqli_fetch_array($compQuery)) { ?>
                                                        <option value="<?php echo $row['name'] ?>"><?php echo $row['name'] ?></option>

                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </td>
                                        <td>
                                            <button class="btn" onclick="window.open(`result_report.php?competition=${$('#result').val()}`)" style="margin-top:10px">Generete</button>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-lg-6">
                                <table>
                                    <tr>
                                        <td>
                                            <div class="form-group">
                                                <label for="date" class=" form-control-label">MATCHES FIXTURES</label>
                                                <select id="fixtures" class="form-control">
                                                    <?php while ($row = mysqli_fetch_array($compQuery2)) { ?>
                                                        <option value="<?php echo $row['name'] ?>"><?php echo $row['name'] ?></option>

                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </td>
                                        <td>
                                            <button class="btn" onclick="window.open(`fixtures_report.php?competition=${$('#fixtures').val()}`)" style="margin-top:10px">Generete</button>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <br><br><br><br>
                        <div class="row">
                            <div class="col-lg-6">
                                <table>
                                    <tr>
                                        <td>
                                            <div class="form-group">
                                                <label for="date" class=" form-control-label">POSTPONED MATCHES </label>
                                                <select id="postponed" class="form-control">
                                                    <?php while ($row = mysqli_fetch_array($compQuery3)) { ?>
                                                        <option value="<?php echo $row['name'] ?>"><?php echo $row['name'] ?></option>

                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </td>
                                        <td>
                                            <button class="btn" onclick="window.open(`postponed_report.php?competition=${$('#postponed').val()}`)" style="margin-top:10px">Generete</button>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-lg-6">
                                <table>
                                    <tr>
                                        <td>
                                            <div class="form-group">
                                                <label for="date" class=" form-control-label">SOLD TICKETS</label>
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
                                            <button class="btn" onclick="window.open(`allTickets_report.php?id=${$('#checked').val()}`)" style="margin-top:10px">Generete</button>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                    <br><br>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
require('footer.inc.php');
?>