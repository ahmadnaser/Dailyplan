<?php
@session_start();
include "inc/koneksi.php";
if(@$_SESSION['username']){
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>App Dailyplan</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
  </head>
<style type="text/css">
body {
  padding-top: 70px;
}
#footer{
  text-align: center;
  padding: 20px;
  background-color: #D3D3D3;
  font-size: 13px;
}
</style>
  <body>

    <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" style="background-color:#1E90FF" href="index.php"><font color="white">Application Dailyplan</font></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            
            <li><a href="?page=daily">Dailyplan</a></li>
            <li><a href="?page=customer">Customer</a></li>
            <li><a href="?page=visit">Visit Report</a></li>
            <li><a href="?page=report">Report</a></li>
          </ul>
            <?php
            if(@$_SESSION['username']){
              $username=@$_SESSION['username'];
            }
            $sql_user=mysqli_query($link,"select * from tbl_user where username='$username'") or die (mysql_error());
            $data_user=mysqli_fetch_array($sql_user);
            ?>
          <ul class="nav navbar-nav navbar-right">
            <li class="active"><a href=""><font color="#1E90FF">Hay, <?php echo $data_user['username']; ?></font></a></li>
            <li style="background-color:#DC143C;"><a href="inc/logout.php"><font color="white">Logout</font><span class="sr-only">(current)</span></a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">

      <!-- Main component for a primary marketing message or call to action -->
      
  <?php
  $page=@$_GET['page'];
  $action=@$_GET['action'];
  if($page=="daily"){
    if(@$_SESSION['username']){
        include ("inc/tambah_daily.php");
    }else{
      echo "anda tidak punya akses di halaman ini";
    }
  }else if($page=="visit"){
    if(@$_SESSION['username']){
      if($action==""){
        include ("inc/visit_report.php");
      }else if ($action=="update") {
        include ("inc/isivisit.php");
      }
    }else{
      echo "anda tidak punya akses di halaman ini";
    }
  }else if($page=="customer"){
    if(@$_SESSION['username']){
        include ("inc/tambah_pic.php");
    }else{
      echo "anda tidak punya akses di halaman ini";
    }
      
  }else if($page=="report"){
    if(@$_SESSION['username']){
        include ("inc/laporan.php");
    }else{
      echo "anda tidak punya akses di halaman ini";
    }
    
  }else if($page==""){
    //echo "Selamat datang di halaman utama <b>Dailyplan</b>";?>
    <marquee style="font-size:24px; color:#1E90FF">Welcome in web application dailyplan</marquee>
      <br><br><br><br><br><br><br><br><br><br>
      <br><br><br><br><br>
    <script src="js/jquery-1.11.0.min.js"></script> <?php
  }else{
    echo "404 NOT FOUND";
  }
  ?>

    </div> <!-- /container -->

    <br>
    <div id="footer">
  Copyright &copy; 2017-<?php echo date('Y'); ?>. Created by Dimas Prasetio. All Rights Reserved
  </div>

    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-1.11.0.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
  </body>
</html>
<?php
}else{
  header("location:login.php");
}
?>