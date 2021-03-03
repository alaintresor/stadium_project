<?php

include "connection.inc.php";

$ticketId = $_POST['ticketId'];
$quert = "SELECT * FROM `booking_teckets` WHERE `id`='$ticketId'";



$data = mysqli_query($con, "$quert");
$row = mysqli_fetch_array($data);
if (mysqli_num_rows($data)) {
    if ($row['status'] == 'used') { ?>
        <h3 style="color:#adad16">The ticket with ID <b><?php echo $ticketId ?></b> is already used </h3>
    <?php } else if ($row['status'] == 'expired') {
    ?>
        <h3 style="color:red">The ticket with the ID <b><?php echo $ticketId ?></b> is expired</h3>
    <?php  } else {

        $customerName = mysqli_fetch_array(mysqli_query($con, "SELECT `fullname` FROM `customers` WHERE `id`='{$row['customer_id']}'"));

        $homeTeam = mysqli_fetch_array(mysqli_query($con, "SELECT `name` FROM `teams`,fixtures WHERE `teams`.`id`=`fixtures`.`home_team` AND  `fixtures`.`id`='{$row['fixture_id']}'"));

        $awayTeam = mysqli_fetch_array(mysqli_query($con, "SELECT `name` FROM `teams`,fixtures WHERE `teams`.`id`=`fixtures`.`away_team` AND  `fixtures`.`id`='{$row['fixture_id']}'"));
    ?>
        <style>
            th {
                text-align: center;
            }
        </style>
        <center>

            <table border="1" style="text-align: center;">
                <thead>
                    <th>Ticket Id</th>
                    <th>Customer Name</th>
                    <th>Match</th>
                    <th>Saet</th>
                    <th>Number Of Seats</th>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $row[0] ?></td>
                        <td><?php echo $customerName[0] ?></td>
                        <td><?php echo $homeTeam[0] . " VS " . $awayTeam[0] ?></td>
                        <td><?php echo $row['seat'] ?></td>
                        <td><?php echo $row['n_of_seats'] ?></td>
                    </tr>
                </tbody>
            </table>
            <br>
            <button class="btn" type="btn" onclick="markAsUsed('<?php echo $row[0] ?>')">Mark As Checked</button>
        </center>
    <?php }
} else {
    ?>
    <h3 style="color: red;">There is no ticket with ID <b><?php echo $ticketId ?></b></h3>
<?php } ?>