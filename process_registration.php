
<?php
   // session_start();
   // include('config.php');
$host = "127.0.0.1";
$user = "root";
$pass = "";
$db = "stadium";                                 
$con = mysqli_connect($host, $user, $pass, $db) or die(mysqli_error($con));

    extract($_POST);
    $sel=$con->query("SELECT * FROM customers WHERE email='$email' ");
    if(mysqli_num_rows($sel)>0){?>
    <script>alert("this user with this email is already exist in system")</script>
    <script>window.history.go(-1)</script>
   <?php  }else{
    $insert=mysqli_query($con,"INSERT INTO  customers(fullname,email,telephone,age,gender,password) VALUES('$name','$email','$phone','$age','$gender','$password')");
   // $id=mysqli_insert_id($con);
   $sel1=$con->query("SELECT * FROM customers WHERE email='$email'");
   $res=mysqli_fetch_array($sel1);
    if($insert){
     
       header('location:login.php');
    }else{ ?>
 
        <script>alert("error while registration")</script>
        <script>window.history.go(-1)</script>
   <?php }
}
    //mysqli_query($con,"insert into  tbl_login values(NULL,'$id','$email','$password','0')");
    //$_SESSION['user']=$id;
    //header('location:index.php');
?>