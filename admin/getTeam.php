<?php
include "connection.inc.php";

$team = $_POST['team'];
$id = $_POST['id'];
if ($team == 1) {
    $query = "select home_team from fixtures where id='$id'";
    $data = mysqli_query($con, "$query");
    $team = mysqli_fetch_array($data);
} else {
    $query = "select away_team from fixtures where id='$id'";
    $data = mysqli_query($con, "$query");
    $team = mysqli_fetch_array($data);
}
$query2 = "select name from teams where id='$team[0]'";
$data2 = mysqli_query($con, "$query2");
$teamName = mysqli_fetch_array($data2);
echo $teamName[0];
