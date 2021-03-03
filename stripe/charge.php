<?php
include '../config.php';
  require_once('../stripe/config.php');
// $id=$_GET['id'];
// $sel="SELECT `school_id` FROM `applications` WHERE `student_id`='$id'";
// $query=mysqli_query($connect,$sel);
// $result=mysqli_fetch_array($query);
//echo $result[0];
// $id1=$result[0];
// $query1=mysqli_query($connect,"SELECT reg_fee,name FROM schools WHERE id='$id1'");
// $result2=mysqli_fetch_array($query1);
// $amount=$result2[0];

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
   $day=date("d");
   $month=date("m");
   $year=2000+date("y");
   
     echo "<h1>Successfully Transaction</h1>";
   
   //update if payfull successed
   $insert=mysqli_query($con,"INSERT INTO booking_teckets(customer_id,fixture_id,seat,n_of_seats,amount) VALUES('".$_POST['user_id']."','".$_POST['fix_id']."','".$_POST['cat']."','".$_POST['seats']."','".$_POST['amount']."') "); 
   if($_POST['cat']=='vip'){
    $update_seat=$con->query("UPDATE seats_and_prices SET vip_seats=vip_seats-'".$_POST['seats']."' WHERE fixture_id='".$_POST['fix_id']."'");
   }else if($_POST['cat']=='vvip'){
    $update_seat=$con->query("UPDATE seats_and_prices SET vvip_seats=vvip_seats-'".$_POST['seats']."' WHERE fixture_id='".$_POST['fix_id']."'");
   }else if($_POST['cat']=='roofed'){
    $update_seat=$con->query("UPDATE seats_and_prices SET roofed_seats=roofed_seats-'".$_POST['seats']."' WHERE fixture_id='".$_POST['fix_id']."'");
   }else{
    $update_seat=$con->query("UPDATE seats_and_prices SET unroofed_seats=unroofed_seats-'".$_POST['seats']."' WHERE fixture_id='".$_POST['fix_id']."'");
   }

   if ($insert && $update) {
    echo "<center><script>alert('Successfully charged')</center>";
  //  echo "<center><script>alert('Successfully charged');window.open('receipt.php','_self');</center>";
   }
  
?>