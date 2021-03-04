<?php
include '../config.php';
require_once('../stripe/config.php');

$token  = $_POST['stripeToken'];
$email  = $_POST['stripeEmail'];

$customer = \Stripe\Customer::create([
  'email' => $email,
  'source'  => $token,
]);

$charge = \Stripe\Charge::create([
  'customer' => $customer->id,
  'amount'   => $_POST['amount'],
  'currency' => 'rwf',
]);
$day = date("d");
$month = date("m");
$year = 2000 + date("y");
$num = rand(9999999, 100000);
$tckCode = "RNTC$num";
$sele = $con->query("SELECT * FROM customers WHERE id='" . $_POST['user_id'] . "'");
$res1 = mysqli_fetch_array($sele);
$sel2 = $con->query("SELECT * FROM fixtures WHERE id='" . $_POST['fix_id'] . "'");
$fix = mysqli_fetch_array($sel2);
$selt = $con->query("SELECT name,logo FROM teams WHERE id='" . $fix['home_team'] . "'");
$selt2 = $con->query("SELECT name,logo FROM teams WHERE id='" . $fix['away_team'] . "'");
$rest = mysqli_fetch_array($selt);
$rest2 = mysqli_fetch_array($selt2);
//update if payfull successed
$inseryQuery = "INSERT INTO `booking_teckets` (`id`, `customer_id`, `fixture_id`, `seat`, `n_of_seats`, `amount`) VALUES ('$tckCode','{$_POST['user_id']}','{$_POST['fix_id']}','{$_POST['cat']}','{$_POST['seats']}','{$_POST['amount']}');";
$insert = mysqli_query($con, "$inseryQuery");
$category = $_POST['cat'];
if ($category == 'vip') {
  $update_seat = $con->query("UPDATE seats_and_prices SET vip_seats=vip_seats-'" . $_POST['seats'] . "' WHERE fixture_id='" . $_POST['fix_id'] . "'");
} else if ($category == 'vvip') {
  $update_seat = $con->query("UPDATE seats_and_prices SET vvip_seats=vvip_seats-'" . $_POST['seats'] . "' WHERE fixture_id='" . $_POST['fix_id'] . "'");
} else if ($category == 'roofed') {
  $update_seat = $con->query("UPDATE seats_and_prices SET roofed_seats=roofed_seats-'" . $_POST['seats'] . "' WHERE fixture_id='" . $_POST['fix_id'] . "'");
} else {
  $update_seat = $con->query("UPDATE seats_and_prices SET unroofed_seats=unroofed_seats-'" . $_POST['seats'] . "' WHERE fixture_id='" . $_POST['fix_id'] . "'");
}

if ($insert) {
} else {
  echo "not" . mysqli_error($con);
}

$phone = "+25" . $res1['telephone'];
$message = "Dear " . $res1['fullname'] . ", your ticket reservation code is " . $tckCode . " for " . $rest[0] . " Vs " . $rest2[0] . " at " . $fix['location'] . " on " . $fix['date'] . ", " . $fix['time'] . ".  Amount paid: " . $_POST['amount'] . "   THANK YOU FOR BOOKING WITH US";
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.mista.io/sms',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => array('to' => $phone, 'from' => 'SmarTicket', 'unicode' => '0', 'sms' => $message, 'action' => 'send-sms'),
  CURLOPT_HTTPHEADER => array(
    'x-api-key:andrass7'
  ),
));

$response = curl_exec($curl);

curl_close($curl);

echo "<script>alert('Your ticket is booked successfully,Check your SMS on phone');window.open('../index.php','_self');</script>";
