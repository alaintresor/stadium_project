<?php
include "connection.inc.php";
$id = $_GET['id'];
$type = $_GET['type'];
if ($type == 1) {
    $sql = "SELECT * FROM `booking_teckets` WHERE `fixture_id`='$id' AND `status`='used'";
} else {
    $sql = "SELECT * FROM `booking_teckets` WHERE `fixture_id`='$id' AND `status`='expired'";
}

$res = mysqli_query($con, $sql);
$res2 = mysqli_query($con, $sql);
$data = mysqli_fetch_assoc($res2);
$homeTeam = mysqli_fetch_array(mysqli_query($con, "SELECT `name` FROM `teams`,fixtures WHERE `teams`.`id`=`fixtures`.`home_team` AND  `fixtures`.`id`='{$data['fixture_id']}'"));

$awayTeam = mysqli_fetch_array(mysqli_query($con, "SELECT `name` FROM `teams`,fixtures WHERE `teams`.`id`=`fixtures`.`away_team` AND  `fixtures`.`id`='{$data['fixture_id']}'"));

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php if ($type == 1)  echo "Checked tickets on match $homeTeam[0] VS $awayTeam[0]";
            else echo "Expired tickets on match $homeTeam[0] VS $awayTeam[0]"; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="style.css" rel="stylesheet">
    <link href="assets/css/font-awesome.css" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!-- Slick slider -->
    <link rel="stylesheet" type="text/css" href="assets/css/slick.css">
    <!-- Date Picker -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-datepicker.css">
    <!-- Gallery Lightbox -->
    <link href="assets/css/magnific-popup.css" rel="stylesheet">
    <!-- Theme color -->
    <link id="switcher" href="assets/css/theme-color/default-theme.css" rel="stylesheet">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <style>
        @page {
            size: letter landscape;
            margin: 2cm;
        }

        table {
            border: 1px solid black;
            border-collapse: collapse;
            margin: 0;

        }

        tr {
            padding: 10px;
            border: 1px solid #109d58;
        }

        td {
            padding: 4px;
            border: 1px solid #109d58;
        }

        th {
            padding: 4px;
            border: 1px solid #109d58;
        }

        .logo {
            font-family: Arial;
        }

        .logo .logo-img {
            margin-left: -40px;
        }

        .logo label {
            font-weight: bold;
        }

        .right-footer {
            margin-right: 50px;
            margin-top: 30px;
            font-family: Arial, sans-serif;
        }

        .right-footer p {
            font-size: 12px;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        th .no {
            width: 10%;
        }

        td .em {
            width: 130%;
        }

        body {
            background-color: white;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="logo">
            <br>
            <label style="font-size:15px;">Smart Stadium Ticket Selling System</label><br>
            <label style="font-size:12px;">Email: smartstadium@gmail.com</label><br>
            <label style="font-size:12px;">Mobile: +250780640237</label><br>

            <br><br>

            <strong style="font-size:14px;">
                <?php if ($type == 1)  echo "Checked tickets on match $homeTeam[0] VS $awayTeam[0]";
                else echo "Expired tickets on match $homeTeam[0] VS $awayTeam[0]"; ?> </strong>

        </div>
        <table border="1" style="border-collapse: collapse;margin-top:20px;width: 20cm;">
            <thead>
                <th>#</th>
                <th>Date</th>
                <th>Ticket Id</th>
                <th>Customer Name</th>
                <th>Match</th>
                <th>Saet</th>
                <th>Number Of Seats</th>

            </thead>
            <tbody>
                <?php
                $i = 1;
                while ($row = mysqli_fetch_assoc($res)) {
                    $customerName = mysqli_fetch_array(mysqli_query($con, "SELECT `fullname` FROM `customers` WHERE `id`='{$row['customer_id']}'"));
                    @$totalNberOfTicket = $totalNberOfTicket + $row['n_of_seats'];

                ?>
                    <tr>
                        <td class="serial"><?php echo $i ?></td>
                        <td><?php echo $row['date'] ?></td>
                        <td><?php echo $row['id'] ?></td>
                        <td><?php echo $customerName[0] ?></td>
                        <td><?php echo $homeTeam[0] . " VS " . $awayTeam[0] ?></td>
                        <td><?php echo $row['seat'] ?></td>
                        <td><?php echo $row['n_of_seats'] ?></td>

                    </tr>

                <?php $i++;
                } ?>
                <tr>
                    <td colspan="3"><b> Total Tickets</b></td>
                    <td colspan="5"><b> <?php echo $totalNberOfTicket ?></b></td>
                </tr>
            </tbody>
        </table>
        <div class="right-footer" style="margin-left:40%;">
            <p>Done at ................ on ..../..../20....</p>
            <p>Done by:</p>
            <p>Signature & stamp</p>
        </div>
    </div>
    <script>
        window.onload(window.print());
    </script>
</body>

</html>