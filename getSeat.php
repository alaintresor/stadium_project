<?php

include "config.php";
//$_POST['item']='vvip';
$category = $_POST['item'];
if($category = 'vvip'){
$quert = "SELECT `vvip_seats` FROM `seats_and_prices`";
$data = mysqli_query($con, "$quert");
$row = mysqli_fetch_array($data);
//$result = explode(",", $row[0]);
//$index = 0;
while ($row = mysqli_fetch_array($data)) {
	echo $row[0];
	//$index++;
}}else{
    echo "tt";
}


