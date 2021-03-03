<?php

include "config.php";

$ticketId = $_POST['ticketId'];
$quert = "SELECT `unroofed_seats` FROM `seats_and_prices` WHERE `fixture_id`='$fixtureId'";



$data = mysqli_query($con, "$quert");
$row = mysqli_fetch_array($data);
echo $row[0];
