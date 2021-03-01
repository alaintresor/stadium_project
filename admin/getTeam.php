<?php
include "connection.inc.php";

$team = $_POST['team'];
$id = $_POST['id'];
if ($team == 1) {
    $query = "select home_team from fixtures where id='$id'";
    $data = mysqli_query($con, "$query");
    $team = mysqli_fetch_array($data);
    echo $team[0];
} else {
    $query = "select away_team from fixtures where id='$id'";
    $data = mysqli_query($con, "$query");
    $team = mysqli_fetch_array($data);
    echo $team[0];
}
