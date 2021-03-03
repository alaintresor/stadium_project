
<?php
include('config.php');
session_start();
//date_default_timezone_set('Europe/Athens');
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Smart stadium ticket Selling System</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
<script src="js/jquery-1.7.2.min.js"></script>
<link rel="stylesheet" href="validation/vendor/bootstrap/css/bootstrap.min.css">
<script src="validation/vendor/bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
<div class="header">
    <div class="header-top">
        <div class="wrap">
              <div  class="nav-wrap" style="height:0px;line-height:30px">
                    <ul  class="group" id="example-one" style="height:0px;line-height:5px">
                       <li style="color:white" ><a href="index.php" style="color:white">Home</a></li>
                       <li style="color:white" ><a href="fixtures_events.php" style="color:white"> All Fixtures</a></li>
                     
                       <?php if(isset($_SESSION['user'])){
                       $us=mysqli_query($con,"select * from customers where id='".$_SESSION['user']."'");
        $user=mysqli_fetch_array($us);?> <li style="color:white" ><a href="profile.php" style="color:white"><?php echo $user['fullname'];?></a></li>
        <li style="color:white"><a style="color:white" href="logout.php">Logout</a></li>?<?php }else{?><li><a href="login.php" style="color:white">Login</a><?php }?></li>
                    </ul>	  
			  </div>
 			<div class="clear"></div>
   		</div>
    </div>
<div class="block">
	<div class="wrap">	
        <form action="process_search.php" id="reservation-form" method="post" onsubmit="myFunction()">
		       <fieldset>
		       	<div class="field" >
                                <input type="text"  placeholder="Search  Fixtures by Competition eg:peace cup" style="height:27px;width:500px"   id="search111" name="searching"> 
                                <input type="submit"   value="Search" style="height:28px;padding-top:4px" id="button111">
    </div>       	
		       </fieldset>
            </form>
            <div class="clear"></div>
   </div>
</div>
<script>
function myFunction() {
     if($('#search111').val()=="")
        {
            alert("Please enter a fixtures name...");//empty searchBar field 
        }
  }
    </script>
  }
