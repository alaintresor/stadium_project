
<?php
include('config.php');
session_start();
$email = $_POST["Email"];
$pass = $_POST["Password"];
//$attempt=2;
$qry=mysqli_query($con,"select * from customers where email='$email' and password='$pass' ");
//$qry2=mysqli_query($con,"select * from customers where email='$email'");

if(mysqli_num_rows($qry)>0)
{
	$usr=mysqli_fetch_array($qry);

		$_SESSION['user']=$usr['id'];
		$_SESSION['email']=$email;
		//$_SESSION['id']=$res[0];
		if(isset($_SESSION['show']))
		{
			header('location:booking.php');
		}
		else
		{
			header('location:index.php');
		}
	}

// else if(mysqli_num_rows($qry2)){

   
//         $qryupdt=mysqli_query($con,"update customers set user_type=user_type + 1 where username='$email' ");
//         $_SESSION['error']="Login Failed!";
//              $attempt--;
// 		header("location:login.php");
        


// }
// else if(!mysqli_num_rows($qry2))
// {

//          $_SESSION['error']="Login Failed!Your account has been blocked.";
// 		header("location:login.php");

// }


else
{
//echo "trr".mysqli_error($con);
	$_SESSION['error']="Login Failed!".mysqli_error($con);
	header("location:login.php");
}
?>