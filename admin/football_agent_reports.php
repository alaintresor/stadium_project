<?php
require('top.inc.php');
isAdmin();

//getting all competitions 
$compQuery = mysqli_query($con, "SELECT * FROM `competitions`");
$compQuery2 = mysqli_query($con, "SELECT * FROM `competitions`");
$compQuery3 = mysqli_query($con, "SELECT * FROM `competitions`");


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
                                                <label for="date" class=" form-control-label">TEAMS</label>
                                                <select id="team" class="form-control">
                                                    <option value="1">Division I</option>
                                                    <option value="2">Division II</option>
                                                </select>
                                            </div>
                                        </td>
                                        <td>
                                            <button class="btn" onclick="window.open(`teams_report.php?competition=${$('#team').val()}`)" style="margin-top:10px">Generete</button>
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