<?php
date_default_timezone_set('Asia/Jakarta');
$host = "192.168.1.90";
$user = "ymsjkt";
$pass = "ymsjkt";
$koneksi = mysqli_connect($host, $user, $pass);
$konak = mysqli_select_db($koneksi,"db_dailyplan") or die (mysql_error()); 
?>

<html>
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
	<title>Laporan</title>
	<link rel="stylesheet" href="css/jquery-ui.css"> 

<link href="css/bootstrap.min.css" rel="stylesheet">
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery-1.11.0.min.js"></script> 
<script src="js/jquery-ui.js"></script>
<script type="text/javascript"> 
$(function() { 
      $("#datepicker").datepicker();
});
$(function() { 
      $("#datepicker2").datepicker();
});
</script> 
</head>
<style>
body {
   //background-color: gray;
	font-family: arial;
	}
h2 { text-align: center; }
table, tr, th,td{border-collapse: collapse; text-align:center; font-size: 8px; }
th { background-color: blue; color: white; border: 1px solid white; }
#footer{
  text-align: center;
  padding: 20px;
  background-color: #D3D3D3;
  font-size: 13px;
}
</style>

<body>

<div class="container" align="center">
<h2>Lihat Laporan Dailyplan TS</h2>
<marquee style="color:blue" behavior="alternate" onmouseover="this.stop()" onmouseout="this.start()"><h3>Selamat datang di laporan dailyplan TS</h3></marquee>
<hr>
<form action="" method="post">
	<tr><td>Tanggal Awal </td><td><input type="text" name="tanggal" size="8" id="datepicker"></td></tr>
	<tr><td>Tanggal Akhir </td><td><input type="text" name="tanggal2" size="8" id="datepicker2"></td></tr>
	<tr><td>Nama TS </td>
	<td><select name="request_by">
		<option value="">-- Nama TS --</option>
		<?php
			$sql = mysqli_query($koneksi,"select b.nama from tbl_user a inner join tbl_pic b on a.username=b.nama where b.divisi='ts' and b.region='jakarta' order by nama asc");
			while($data = mysqli_fetch_array($sql)){
				echo '<option value="'.$data['nama'].'">'.$data['nama'].'</option>';
			}
		?>
	</select></td></tr>
	<tr><td></td><td><input type="submit" value="cari" name="pencarian" class="btn btn-primary btn-sm"></td></tr>
	</tr>
</form>

<?php
	echo '<center><a href="ts-export-excel.php?keyword='.@$_POST['request_by'].'&tanggal='.@$_POST['tanggal'].'&tanggal2='.@$_POST['tanggal2'].' ">
	<button class="btn btn-success btn-sm">Laporan Excel</button></a>    ';
	echo '<a target="blank" href="ts-export-pdf.php?keyword='.@$_POST['request_by'].'&tanggal='.@$_POST['tanggal'].'&tanggal2='.@$_POST['tanggal2'].' ">
	<button class="btn btn-danger btn-sm">Laporan PDF</button></a></center>';
?>

<hr>
</div>
<?php
if(isset($_POST['pencarian'])){
	$tanggals = $_POST['tanggal'];
	$tanggals2 = $_POST['tanggal2'];
	$request_by = $_POST['request_by'];

	function ubahTanggal($tanggals){
	 $pisah = explode('/',$tanggals);
	 @$array = array($pisah[2],$pisah[0],$pisah[1]);
	 $satukan = implode('/',$array);
	 return $satukan;
	}
	function ubahTanggal2($tanggals2){
	 $pisah = explode('/',$tanggals2);
	 @$array = array($pisah[2],$pisah[0],$pisah[1]);
	 $satukan = implode('/',$array);
	 return $satukan;
	}

	$tanggal = ubahTanggal($tanggals);
	$tanggal2 = ubahTanggal2($tanggals2);
	
	/*if($tanggal !=0 and $tanggal2!=0 and $request_by != null){
		$q = $q = "SELECT id,tgl_kunjungan, jam_kunjungan,request_by,partner1,partner2,partner3,
			tujuan,area,pic,pic_division,telepon,email,product,problem,hasil FROM tbl_dailyform where tgl_kunjungan between '$tanggal' and '$tanggal2' and (((request_by='$request_by' or partner1='$request_by') or partner2='$request_by') or partner3='$request_by') group by tujuan order by tgl_kunjungan asc, jam_kunjungan asc";
	}else if($tanggal == 0 and $tanggal2==0 and $request_by == null){
		$q = "SELECT id,tgl_kunjungan, jam_kunjungan,request_by,partner1,partner2,partner3,
		tujuan,area,pic,pic_division,telepon,email,product,problem,hasil FROM tbl_dailyform order by no asc, jam_kunjungan asc";
	}else if($tanggal == 0 and $tanggal2==0 and $request_by != null){
		$q = "SELECT id,tgl_kunjungan, jam_kunjungan,request_by,partner1,partner2,partner3,
		tujuan,area,pic,pic_division,telepon,email,product,problem,hasil FROM tbl_dailyform where (((request_by='$request_by' or partner1='$request_by') or partner2='$request_by') or partner3='$request_by') order by no asc, jam_kunjungan asc";
		//$ex = mysql_query($q);
	}else if($tanggal==0 || $tanggal2==0){
		?>
		<script type="text/javascript">
		alert("jangan pilih hanya kolom 1 tanggal");
		</script>
		<?php
	}else if($request_by == null and $tanggal != 0 and $tanggal2!=0){
		$q = "SELECT id,tgl_kunjungan, jam_kunjungan,request_by,partner1,partner2,partner3,
		tujuan,area,pic,pic_division,telepon,email,product,problem,hasil FROM tbl_dailyform where tgl_kunjungan between '$tanggal' and '$tanggal2' group by tujuan order by tgl_kunjungan asc, request_by asc, jam_kunjungan asc";
		//$ex = mysql_query($q);
	}*/

	if($tanggal !=0 and $tanggal2!=0 and $request_by != null){
		$q = $q = "SELECT id,tgl_kunjungan, jam_kunjungan,request_by,partner1,partner2,partner3,
			tujuan,area,pic,pic_division,telepon,email,product,problem,hasil FROM tbl_dailyform where 
			tgl_kunjungan between '$tanggal' and '$tanggal2' and 
			(((request_by='$request_by' or partner1='$request_by') or partner2='$request_by') or partner3='$request_by') 
			order by tgl_kunjungan asc, jam_kunjungan asc";
	}else if($tanggal == 0 and $tanggal2==0 and $request_by == null){
		$q = "SELECT id,tgl_kunjungan, jam_kunjungan,request_by,partner1,partner2,partner3,
		tujuan,area,pic,pic_division,telepon,email,product,problem,hasil FROM tbl_dailyform 
		where (((request_by in (select nama from tbl_pic where divisi='TS' and region='jakarta') or 
        partner1 in (select nama from tbl_pic where divisi='TS' and region='jakarta')) or 
        partner2 in (select nama from tbl_pic where divisi='TS' and region='jakarta')) or 
        partner3 in (select nama from tbl_pic where divisi='TS' and region='jakarta'))
         order by no asc, jam_kunjungan asc";
	}else if($tanggal == 0 and $tanggal2==0 and $request_by != null){
		$q = "SELECT id,tgl_kunjungan, jam_kunjungan,request_by,partner1,partner2,partner3,
		tujuan,area,pic,pic_division,telepon,email,product,problem,hasil FROM tbl_dailyform where (((request_by='$request_by' or partner1='$request_by') or partner2='$request_by') or partner3='$request_by') order by no asc, jam_kunjungan asc";
		//$ex = mysql_query($q);
	}else if($tanggal==0 || $tanggal2==0){
		?>
		<script type="text/javascript">
		alert("jangan pilih hanya kolom 1 tanggal");
		</script>
		<?php
	}else if($request_by == null and $tanggal != 0 and $tanggal2!=0){
		$q = "SELECT a.id,a.tgl_kunjungan, a.jam_kunjungan,a.request_by,b.divisi,a.partner1,a.partner2,a.partner3,
		a.tujuan,a.area,a.pic,a.pic_division,a.telepon,a.email,a.product,a.problem,a.hasil FROM tbl_dailyform a 
		inner join tbl_pic b on a.request_by=b.nama where  
		a.tgl_kunjungan between '$tanggal' and '$tanggal2' 
		and (((request_by in (select nama from tbl_pic where divisi='TS' and region='jakarta') or 
        partner1 in (select nama from tbl_pic where divisi='TS' and region='jakarta')) or 
        partner2 in (select nama from tbl_pic where divisi='TS' and region='jakarta')) or 
        partner3 in (select nama from tbl_pic where divisi='TS' and region='jakarta'))
		order by tgl_kunjungan asc, request_by asc, jam_kunjungan asc";
		//$ex = mysql_query($q);
	}

echo"<p align=center><div class='container'>
<section class='col-lg-12'>
<div class='table-responsive'>
<table class='table table-bordered table-striped' align='center'>";
echo"<tr>
<th>No</th>
<th>tgl_kunjungan</th>
<th>request_by</th>
<th>partner1</th>
<th>partner2</th>
<th>partner3</th>
<th>tujuan</th>
<th>area</th>
<th>jam</th>
<th>produk</th>
<th>pic</th>
<th>pic_division</th>
<th>telepon</th>
<th>problem</th>
<th>hasil</th>
</tr>";

$no=1;
$ex = @mysqli_query($koneksi,$q);
$brs = @mysqli_num_rows($ex);

echo "data tampil : <font color='red'>$brs</font>";

if($brs == 0){
	echo "<tr><td colspan='14' align='center'><font color='red'>data tidak ditemukan</font></td></tr>";
}else{
while($r = mysqli_fetch_array($ex)){
if($no%2 != 0){
    $color='#cccccc';
}else{
    $color='white';
}
	echo "<tr bgcolor='".$color."'>";
	echo "<td>".$no."</td>";
	echo "<td>".$r['tgl_kunjungan']."</td>";
    echo "<td>".$r['request_by']."</td>";
    echo "<td>".$r['partner1']."</td>";
    echo "<td>".$r['partner2']."</td>";
    echo "<td>".$r['partner3']."</td>";
    echo "<td>".$r['tujuan']."</td>";
    echo "<td>".$r['area']."</td>";
    echo "<td>".$r['jam_kunjungan']."</td>";
    echo "<td>".$r['product']."</td>";
    echo "<td>".$r['pic']."</td>";
    echo "<td>".$r['pic_division']."</td>";
    echo "<td>".$r['telepon']."</td>";
    echo "<td>".$r['problem']."</td>";
    echo "<td>".$r['hasil']."</td>";
	echo "</td></tr>";
	$no++;    
	}
}


}
echo "</table></p>";
?>
</div>
</section>
</div>

<div id="footer">
  Copyright &copy; 2017-<?php echo date('Y'); ?>. Created by Dimas Prasetio. All Rights Reserved
</div>

</body>
</html>