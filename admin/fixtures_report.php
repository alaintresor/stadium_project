<?php
include "connection.inc.php";
$competition = $_GET['competition'];
if ($competition == 1) {
    $sql = "SELECT * FROM fixtures WHERE `status`!='end' AND fixtures.competition='Ikikombe cya mahoro' order by id asc";
} else {
    $sql = "SELECT * FROM fixtures WHERE `status`!='end' AND fixtures.competition='Ikikombe cya champion' order by id asc";
}

$res = mysqli_query($con, $sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matches Fixtures for <?php if ($competition == 1)  echo "Ikikombe cya mahoro";
                                else echo "Ikikombe cya champion"; ?></title>
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

            <strong style="font-size:14px;"> Report of Matches Fixtures for
                <?php
                if ($competition == 1) {
                    echo "Ikikombe cya mahoro";
                } else {
                    echo "Ikikombe cya champion";
                } ?> </strong>

        </div>
        <table border="1" style="border-collapse: collapse;margin-top:20px;">
            <thead>
                <tr>
                    <th class="serial">#</th>
                    <th>ID</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>competition</th>
                    <th>Home</th>
                    <th>Away</th>
                    <th>Location</th>
                    <th>Desrciption</th>
                    <th>Status</th>

                </tr>
            </thead>

            <tbody>
                <?php
                $i = 0;
                $today = date("Y-m-d");
                while ($row = mysqli_fetch_assoc($res)) {
                    if ($row['date'] < $today) {
                        mysqli_query($con, "UPDATE `fixtures` SET `status`='end' WHERE `id`='{$row['id']}'");
                    }
                    $homeTeam = mysqli_fetch_array(mysqli_query($con, "select name from teams where id='{$row['home_team']}'"));

                    $awayTeam = mysqli_fetch_array(mysqli_query($con, "select name from teams where id='{$row['away_team']}'"));
                    $i++;
                ?>
                    <tr>
                        <td class="serial"><?php echo $i ?></td>
                        <td><?php echo $row['id'] ?></td>
                        <td><?php echo $row['date'] ?></td>
                        <td><?php echo $row['time'] ?></td>
                        <td><?php echo $row['competition'] ?></td>
                        <td><?php echo $homeTeam[0] ?></td>
                        <td><?php echo $awayTeam[0] ?></td>
                        <td><?php echo $row['location'] ?></td>
                        <td><?php echo $row['description'] ?></td>
                        <td>
                            <?php
                            if ($row['status'] == 'postponed') {
                                echo $row['status'];
                            } else {
                                echo "Active";
                            }
                            ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <div class="right-footer" style="margin-left:60%;">
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