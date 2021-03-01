<?php
include '../connection.php';
  require_once('../stripe/config.php');
$id=$_GET['id'];
$sel="SELECT `school_id` FROM `applications` WHERE `student_id`='$id'";
$query=mysqli_query($connect,$sel);
$result=mysqli_fetch_array($query);
//echo $result[0];
$id1=$result[0];
$query1=mysqli_query($connect,"SELECT reg_fee,name FROM schools WHERE id='$id1'");
$result2=mysqli_fetch_array($query1);
$amount=$result2[0];

  $token  = $_POST['stripeToken'];
  $email  = $_POST['stripeEmail'];

  $customer = \Stripe\Customer::create([
      'email' => $email,
      'source'  => $token,
  ]);

  $charge = \Stripe\Charge::create([
      'customer' => $customer->id,
      'amount'   => $amount,
      'currency' => 'rwf',
  ]);
   $day=date("d");
   $month=date("m");
   $year=2000+date("y");
   
     echo "<h1>Successfully Transaction</h1>";
   
   //update if payfull successed
   $update=mysqli_query($connect,"UPDATE `applications` SET `isPayed`='yes',`reg_day`='$day',`reg_month`='$month',`reg_year`='$year' WHERE `student_id`='$id'"); 
   if ($update) {
    echo "<center><script>alert('Successfully charged');window.open('receipt.php','_self');</center>";
   }
  
?>