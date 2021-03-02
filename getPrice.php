<?php

include "config.php";

$category = $_POST['category'];
$fixtureId = $_POST['fixtureId'];
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
echo $row[0];
