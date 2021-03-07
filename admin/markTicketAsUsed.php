<?php

include "connection.inc.php";
include "functions.inc.php";

$id = $_POST['id'];

$date = get_safe_value($con, $_POST['id']);
$done = mysqli_query($con, "UPDATE `booking_teckets` SET `status`='used',`stadiumAgent_id`='{$_SESSION['ADMIN_ID']}' WHERE `id`='$id'");
if ($done) {
    echo "<script>alert('Ticket mark as used')</script>";
}
