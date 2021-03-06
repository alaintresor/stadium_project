<?php
require('connection.inc.php');
require('functions.inc.php');
if (isset($_SESSION['ADMIN_LOGIN']) && $_SESSION['ADMIN_LOGIN'] != '') {
} else {
   header('location:login.php');
   die();
}
?>
<!doctype html>
<html class="no-js" lang="">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <title>ADMIN DASHBOARD PAGE</title>
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="assets/css/normalize.css">
   <link rel="stylesheet" href="assets/css/bootstrap.min.css">
   <link rel="stylesheet" href="assets/css/font-awesome.min.css">
   <link rel="stylesheet" href="assets/css/themify-icons.css">
   <link rel="stylesheet" href="assets/css/pe-icon-7-filled.css">
   <link rel="stylesheet" href="assets/css/flag-icon.min.css">
   <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
   <link rel="stylesheet" href="assets/css/style.css">
   <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
   <script src="assets/js/jquery.min.js"></script>
   <script src="assets/js/bootstrap.min.js"></script>

</head>

<body>
   <aside id="left-panel" class="left-panel">
      <nav class="navbar navbar-expand-sm navbar-default">
         <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
               <li class="menu-item-has-children dropdown">
                  <a href="index.php"> DASHBOARD </a>
               </li>
               <?php if ($_SESSION['ADMIN_ROLE'] == 0) { ?>
                  <li class="menu-item-has-children dropdown">
                     <a href="teams_management.php"> TEAMS </a>
                  </li>
                  <li class="menu-item-has-children dropdown">
                     <a href="stadium_management.php"> STADIUMS </a>
                  </li>
                  <li class="menu-item-has-children dropdown">
                     <a href="stadiumManager_management.php"> STADIUM'S MANAGERS </a>
                  </li>
                  <li class="menu-item-has-children dropdown">
                     <a href="competitions_management.php"> COMPETITONS </a>
                  </li>
                  <li class="menu-item-has-children dropdown">
                     <a href="fixtures_management.php"> FIXTURES </a>
                  </li>
                  <li class="menu-item-has-children dropdown">
                     <a href="result_management.php">MATCH RESULT </a>
                  </li>
                  <li class="menu-item-has-children dropdown">
                     <a href="postpone_management.php"> POSTPONE A MATCH </a>
                  </li>
                  <li class="menu-item-has-children dropdown">
                     <a href="football_agent_reports.php"> REPORT</a>
                  </li>
               <?php } else if ($_SESSION['ADMIN_ROLE'] == 1) { ?>
                  <li class="menu-item-has-children dropdown">
                     <a href="stadiumAgent_management.php"> STADIUM AGENTS </a>
                  </li>
                  <li class="menu-item-has-children dropdown">
                     <a href="select_fixtures.php"> SELECT FIXTURES </a>
                  </li>
                  <li class="menu-item-has-children dropdown">
                     <a href="seats_management.php">PRICE & SEAT </a>
                  </li>
                  <li class="menu-item-has-children dropdown">
                     <a href="postponed.php">POSTPONED MATCH </a>
                  </li>
                  <li class="menu-item-has-children dropdown">
                     <a href="manger_reports.php"> REPORT </a>
                  </li>
               <?php } else if ($_SESSION['ADMIN_ROLE'] == 2) { ?>
                  <li class="menu-item-has-children dropdown">
                     <a href="check_tickets.php">CHECK TICKET </a>
                  </li>
                  <li class="menu-item-has-children dropdown">
                     <a href="stadiumAgent_reports.php"> REPORT </a>
                  <?php } ?>
            </ul>
         </div>
      </nav>
   </aside>
   <div id="right-panel" class="right-panel">
      <header id="header" class="header">
         <div class="top-left">
            <div class="navbar-header">
               <?php if ($_SESSION['ADMIN_ROLE'] == 0) { ?>
                  <a class="navbar-brand" href="index.php">Football Agent Panel</a>
               <?php } else if ($_SESSION['ADMIN_ROLE'] == 1) { ?>
                  <a class="navbar-brand" href="index.php">Stadium Manager Panel</a>
               <?php } else { ?>
                  <a class="navbar-brand" href="index.php">Stadium Agent Panel</a>
               <?php } ?>
               <br>
            </div>
         </div>
         <div class="top-right">
            <div class="header-menu">
               <div class="user-area dropdown float-right">
                  <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">WELCOME <?php echo $_SESSION['ADMIN_USERNAME'] ?></a>
                  <div class="user-menu dropdown-menu">
                     <a class="nav-link" href="settings.php?id=<?php echo $_SESSION['ADMIN_ID'] ?>"><i class="fa fa-power-off"></i>SETTINGS</a>
                     <a class="nav-link" href="logout.php"><i class="fa fa-power-off"></i>LOGOUT</a>
                  </div>
               </div>
            </div>
         </div>
      </header>