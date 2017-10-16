<?php
session_start();
include "inc/koneksi.php";
if(@$_SESSION['username']){
	header("location:index.php");
}else{
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
	<title>Halaman Login</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<div id="utama">
	<div id="judul">
		Halaman Login
	</div>
	<div id="inputan">
		<form action="" method="post">
			<div>
				<input type="text" name="user" placeholder="username" class="lg" />
			</div>
			<div style="margin-top: 10px;">
				<input type="password" name="pass" placeholder="password" class="lg" />
			</div>
			<div style="margin-top: 10px;">
				<input type="submit" name="login" value="login" class="btn" />
				<!--<span style="margin-left:130px;">
					<a href="register.php" class="btn-right">Register</a>
				</span>-->
			</div>
		</form>
<?php
if(isset($_POST['login'])){
	$user=$_POST['user'];
	$pass=$_POST['pass'];
	if($user=="" || $pass==""){
		?><script>alert("username/password tidak boleh kosong");</script><?php
	}else{
		$sql=mysqli_query($link, "select * from tbl_user where username='$user' and pass='$pass' ") or die (mysqli_error());
		$data=mysqli_fetch_array($sql);
		$cek=mysqli_num_rows($sql);
		if($cek >= 1){
			if($data['username']){
				$_SESSION['username']=$data['username'];
				?>
		    <script language="javascript">
                window.location.href="index.php";
            </script>
		    <?php
			}
		}else{
			echo "gagal";
		}
	}
}
?>
	</div>
</div>
</body>
</html>
<?php
}
?>