<!DOCTYPE html>
<html>
<body>

<?php
$time = "17:00";
$time2 = "00:15";
date_default_timezone_set("Africa/CAIRO");
$secs = strtotime($time2)-strtotime("00:00");
$result = date("H:i",strtotime($time)+$secs);
$currentTime=date("H:i");
echo "The time is " . $currentTime;
if($currentTime>$result){
    echo "match ended";
}else{
    echo "you can book";
}
echo $result;
?>

</body>
</html>