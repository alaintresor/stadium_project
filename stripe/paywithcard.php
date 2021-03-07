<html>
<?php
// if (!isset($_SESSION['user'])) {
// 	header('location:login.php');
// }
if ($_POST['Avseat'] <= 0) {

?>
    <center>
        <script>
            alert('Check  available seat if is available or is empty');
            history.go(-1);
        </script>
    </center>
<?php
} else if ($_POST['seats'] > $_POST['Avseat']) { ?>

    <center>
        <script>
            alert('Provide available seat(s)');
            history.go(-1);
        </script>
    </center>

<?php } else {
    include('config.php');
?>
    <link rel="stylesheet" href="../css/style.css" type="text/css" media="all" />
    <script src="js/jquery-1.7.2.min.js"></script>
    <link rel="stylesheet" href="../validation/vendor/bootstrap/css/bootstrap.min.css">
    <script src="../validation/vendor/bootstrap/js/bootstrap.min.js"></script>
    <br><br><br>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">You are about to pay One step Remains</h3>
                    </div>
                    <div class="panel-body">

                        <fieldset>

                            <div class="form-group">
                                Fixtures: <?php
                                            $host = "localhost";

                                            $user = "root";
                                            $pass = "";
                                            $db = "stadium";
                                            $con = mysqli_connect($host, $user, $pass, $db) or die(mysqli_error($con));
                                            $qry2 = mysqli_query($con, "select * from fixtures where id='" . $_POST['id'] . "'");
                                            if ($qry2) {
                                                echo "";
                                            } else {
                                                echo "not" . mysqli_error($con);
                                            }
                                            $fix = mysqli_fetch_array($qry2);
                                            $sel1 = $con->query("SELECT name,logo FROM teams WHERE id='" . $fix['home_team'] . "'");
                                            $sel2 = $con->query("SELECT name,logo FROM teams WHERE id='" . $fix['away_team'] . "'");
                                            $res = mysqli_fetch_array($sel1);
                                            $res1 = mysqli_fetch_array($sel2);
                                            echo "You are about to book <b>(" . $res[0] . " Vs " . $res1[0] . ")</b>";
                                            ?>
                            </div>
                            <div class="form-group">
                                Date: <?php echo "<b>" . $fix[1] . "</b>"; ?>
                            </div>

                            <form action="charge.php" method="POST" enctype='multipart/form-data'>
                                <input type='hidden' value='<?php echo $_POST['id'] ?>' name='fix_id'>
                                <input type='hidden' value='<?php echo $_POST['user_id'] ?>' name='user_id'>
                                <label>Seat Category</label>
                                <input class="form-control" type='text' readonly value='<?php echo $_POST['b_cat'] ?>' name='cat'>
                                <br>
                                <label class="form-group">Number Of Seat :</label>

                                <input class="form-control" type='text' readonly value='<?php echo $_POST['seats'] ?>' name='seats'><?php
                                                                                                                                    $category = $_POST['b_cat'];
                                                                                                                                    $fixtureId = $_POST['id'];
                                                                                                                                    if ($category == 'VVIP') {
                                                                                                                                        $quert = "SELECT `vvip_price` FROM `seats_and_prices` WHERE `fixture_id`='$fixtureId'";
                                                                                                                                    } else if ($category == "VIP") {
                                                                                                                                        $quert = "SELECT `vip_price` FROM `seats_and_prices` WHERE `fixture_id`='$fixtureId'";
                                                                                                                                    } else if ($category == "Roofed") {
                                                                                                                                        $quert = "SELECT `roofed_price` FROM `seats_and_prices` WHERE `fixture_id`='$fixtureId'";
                                                                                                                                    } else {
                                                                                                                                        $quert = "SELECT `unroofed_price` FROM `seats_and_prices` WHERE `fixture_id`='$fixtureId'";
                                                                                                                                    }
                                                                                                                                    $data = mysqli_query($con, "$quert");
                                                                                                                                    $row = mysqli_fetch_array($data);

                                                                                                                                    ?> <label class="form-group">Amount:</label> <input class="form-control" type='text' readonly value='<?php echo $row[0] * $_POST['seats'] ?>' name="amount">
                                <div class="row">
                                    <div class="col-lg-4">

                                        <div class="form-control">

                                            <script src="https://checkout.stripe.com/checkout.js" class="stripe-button" data-key="<?php echo $stripe['publishable_key']; ?>" data-description="Access for a year" data-amount="<?php echo $row[0] * $_POST['seats'] ?>" data-locale="auto"></script>
                                        </div>
                                    </div>
                                    <div class="col-lg-6"><a href="../booking.php?<?php echo $_POST['id'] ?>" class="btn btn-warning btn-block">cancel</a>
                            </form>
                    </div>
                </div>
                </fieldset>
            </div>
        </div>
    </div>
    </div>
    </div>
<?php } ?>