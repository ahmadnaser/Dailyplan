<script src="js/jquery-1.11.0.min.js"></script> 
<style type="text/css">
table,tr,th,td{
	padding: 5px;
	border-collapse: collapse;
	text-align: left;
}
th{
	background-color: blue;
	color: white;
}
</style>
<fieldset>
	<legend>Create Dailyplan</legend>
	<form action="" method="post" enctype="multipart/form-data">
	<table>
	<?php
	date_default_timezone_set('Asia/Jakarta');
				if(@$_SESSION['username']){
					$username=@$_SESSION['username'];
				}
				$sql_pic=mysqli_query($link,"select * from tbl_pic where nama='$username'") or die (mysql_error());
				$data_pic=mysqli_fetch_array($sql_pic);
				?>
	<tr>
		<td>Request By</td>
		<td> : </td>
		<td><input type="text" name="request" value="<?php echo $data_pic['nama'] ?>" readonly=""  class="form-control" /></td>
	</tr>
	<tr>
		<td>Division</td>
		<td> : </td>
		<td><input type="text" name="divisi" value="<?php echo $data_pic['divisi'] ?>" readonly="" class="form-control" /></td>
	</tr>
	<tr>
		<td>Partner</td>
		<td> : </td>
		<td><div class="form-inline"><div class="form-group">
		<select name="partner1" class="form-control" >
		<option value="">PARTNER 1</option>
	<?php
	$sql = mysqli_query($link,"select nama from tbl_pic where nama not like '$username' ");
	while($data = mysqli_fetch_array($sql)){
		echo '<option value="'.$data['nama'].'">'.$data['nama'].'</option>';
	}
	?>
		</select>  
		<select name="partner2" class="form-control" >
		<option value="">PARTNER 2</option>
	<?php
	$sql = mysqli_query($link,"select nama from tbl_pic  where nama not like '$username' ");
	while($data = mysqli_fetch_array($sql)){
		echo '<option value="'.$data['nama'].'">'.$data['nama'].'</option>';
	}
	?>
		</select>   
		<select name="partner3" class="form-control">
		<option value="">PARTNER 3</option>
	<?php
	$sql = mysqli_query($link,"select nama from tbl_pic  where nama not like '$username' ");
	while($data = mysqli_fetch_array($sql)){
		echo '<option value="'.$data['nama'].'">'.$data['nama'].'</option>';
	}
	?>
		</select></div></div>
		</td>
	</tr>
	<tr>
		<td>Product</td>
		<td> : </td>
		<td><div class="form-inline"><div class="form-group">
		 <select name="product1" class="form-control" required>
		 <option value="">PRODUCT 1</option>
	<?php
	$sql = mysqli_query($link,"select product_name from tbl_product order by product_name asc");
	while($data = mysqli_fetch_array($sql)){
		echo '<option value="'.$data['product_name'].'">'.$data['product_name'].'</option>';
	}
	?>
		</select>  
		<select name="product2" class="form-control" >
		<option value="">PRODUCT 2</option>
	<?php
	$sql = mysqli_query($link,"select product_name from tbl_product order by product_name asc");
	while($data = mysqli_fetch_array($sql)){
		echo '<option value="'.$data['product_name'].'">'.$data['product_name'].'</option>';
	}
	?>
		</select>
		</td></div></div>
	</tr>
	<tr>
		<td>Visit Date</td>
		<td> : </td>
		<td><div class="form-inline"><div class="form-group">
			<select name="tgl" class="form-control">
			<?php
			for ($i=1; $i <= 31; $i++) { //membuat looping tgl 1-31
			if ($i == date("j")){ $selectdate ="selected";}//menentukan yang sesuai dg tanggal hari ini
			else {$selectdate="";}
			if ($i <=9 ) {$i2="0$i";}//jika tgl 1-9 menjadi 01-09, jika menggunakan type data DATE
			else{$i2="$i";}//selain tgl 1-9 akan tetap
			echo ("<option value=\"$i2\" $selectdate>$i2</option>"."\n");//untuk mengeluarkan pilihannya
			}
			?>
			</select>
			
			<select name="bln" class="form-control">
			<?php
			for ($i=1; $i <= 12; $i++) { //membuat looping tgl 1-31
			if ($i == date("m")){ $selectdate ="selected";}//menentukan yang sesuai dg tanggal hari ini
			else {$selectdate="";}
			if ($i <=9 ) {$i2="0$i";}//jika tgl 1-9 menjadi 01-09, jika menggunakan type data DATE
			else{$i2="$i";}//selain tgl 1-9 akan tetap
			echo ("<option value=\"$i2\" $selectdate>$i2</option>"."\n");//untuk mengeluarkan pilihannya
			}
			?>
			</select>
			
			<select name="thn" class="form-control">
			<?php
			$nowthn = date("Y");
			for ($i=$nowthn-1; $i <= $nowthn+1; $i++) { //membuat looping tgl 1-31
			if ($i == date("Y")){ $selectdate ="selected";}//menentukan yang sesuai dg tanggal hari ini
			else {$selectdate="";}
			echo ("<option value=\"$i\" $selectdate>$i</option>"."\n");//untuk mengeluarkan pilihannya
			}
			?>
			</select>
			</div>
			</div>
		</td>
	</tr>
	<tr>
		<td>Visit Time</td>
		<td> : </td>
		<td>
		<select name="time" class="form-control" required>
		<option>07:00</option><option>08:00</option><option>09:00</option><option>10:00</option><option>11:00</option><option>12:00</option>
		<option>13:00</option><option>14:00</option><option>15:00</option><option>16:00</option><option>17:00</option>
		</select>
		</td>
	</tr>
	<tr>
		<td>Problem / Issue</td>
		<td> : </td>
		<td><textarea name="problem" class="form-control" required></textarea></td>
	</tr>
	<tr>
		<td>Customer Name</td>
		<td> : </td>
		<td>
		<input list="cn" name="cname" id="cname" class="form-control" required>
		</td>
	</tr>
	<tr>

		<td>Area</td>
		<td> : </td>
		<td>
		<select name="area" class="form-control" required>
	<?php
	$sql = mysqli_query($link,"select area_name from tbl_area");
	while($data = mysqli_fetch_array($sql)){
		echo '<option value="'.$data['area_name'].'">'.$data['area_name'].'</option>';
	}
	?>
		</select>
		</td>
	</tr>
	<tr>
		<td>PIC</td>
		<td> : </td>
		<td>
		<select name="ccontact" id="ccontact" class="form-control" onchange="changeValue(this.value)" required>
	<option value="">--PILIH PIC--</option>
	<?php
	/*$sqlccontact = mysql_query("select * from tbl_customer order by ccontact asc");
	while($data = mysql_fetch_array($sqlcname)){
		echo '<option value="'.$data['ccontact'].'">'.$data['ccontact'].'</option>'; 
	}*/
	?>	</select>
	</td>
	</tr>
	<tr>
		<td>Division</td>
		<td> : </td>
		<td>
		<!--
	<select name="cdiv" id="cdiv">
	<option>--Pilih Divisi--</option>
	</select>
	-->
	<input type="text" name="cdiv" id="cdiv" readonly="" class="form-control" />
		</td>
	</tr>
	<tr>
		<td>Phone</td>
		<td> : </td>
		<td><input type="text" name="cphone" id="cphone" readonly="" class="form-control" /></td>
	</tr>
	<tr>
		<td>Email</td>
		<td> : </td>
		<td><input type="text" name="email" id="email" readonly="" class="form-control" /></td>
	</tr>
	<tr>
			<td></td>
			<td></td>
			<td><input type="submit" name="tambah" value="Save" class="btn btn-success btn-sm"/>   
			<input type="reset" value="Cancel" class="btn btn-success btn-sm"/></td>
		</tr>
	</table>		
	</form>

<?php
if(isset($_POST['tambah'])){
	$request = $_POST['request'];
	$divisi = $_POST['divisi'];
	$requestr = substr($request, 0, 3);	

	$gabung = date("ymd")."/".date("Hi");
	$id = $requestr."/".$gabung;
	$tgl_bikin = date("Y/m/d");
	$jam_bikin = date("H:i:s");

	$tgl = $_POST['tgl'];
	$bln = $_POST['bln'];
	$thn = $_POST['thn'];

	$date = $thn."/".$bln."/".$tgl;

	$time = $_POST['time'];
	$partner1 = $_POST['partner1'];
	$partner2 = $_POST['partner2'];
	$partner3 = $_POST['partner3'];
	$product1 = $_POST['product1'];
	$product2 = $_POST['product2'];
	$problem = $_POST['problem'];
	$cname = $_POST['cname'];
	$area = $_POST['area'];
	$ccontact = $_POST['ccontact'];
	$cdiv = $_POST['cdiv'];
	$cphone = $_POST['cphone'];
	$email = $_POST['email'];
	$status = 0;

	if($product1=="" || $date=="" || $time=="" || $problem=="" || $cname=="" || $area=="" || $ccontact==""){
		?>
		<script type="text/javascript">
		alert("harus diisi partner1, produk1, date, time, problem, customer, area, pic");
		</script>
		<?php
	}else{
	/*echo "id : ".$id."<br>";
	echo "tgl bikin : ".$tgl_bikin."<br>";
	echo "jam bikin : ".$jam_bikin."<br>";
	echo "tgl kunjungan : ".$date."<br>";
	echo "jam kunjungan : ".$time."<br>";
	echo "request : ".$request."<br>";
	echo "divisi : ".$divisi."<br>";
	echo "partner 1 : ".$partner1."<br>";
	echo "partner 2 : ".$partner2."<br>";
	echo "partner 3 : ".$partner3."<br>";
	echo "product 1 : ".$product1."<br>";
	echo "product 2 : ".$product2."<br>";
	echo "tujuan : ".$cname."<br>";
	echo "area : ".$area."<br>";
	echo "pic : ".$ccontact."<br>";
	echo "divisi : ".$cdiv."<br>";
	echo "telepon : ".$cphone."<br>";
	echo "email : ".$email."<br>";
	echo "problem : ".$problem."<br>";
	echo "status : ".$status."<br>";*/
	mysqli_query($link,"insert into tbl_dailyform(id,created_date,created_time,tgl_kunjungan,jam_kunjungan,request_by,divisi,partner1,
partner2,partner3,product,product2,tujuan,area,pic,pic_division,telepon,email,problem,status) values
('$id','$tgl_bikin','$jam_bikin','$date','$time','$request','$divisi','$partner1','$partner2','$partner3',
'$product1','$product2','$cname','$area','$ccontact','$cdiv','$cphone','$email','$problem','$status')");
	echo "<font color='red'>DailyPlan sukses dibuat</font>";
	}
}
?>

</fieldset>
<datalist id="cn">
<?php
	$sqlcname = mysqli_query($link,"select cname from tbl_customer group by cname order by cname asc");
	while($data = mysqli_fetch_array($sqlcname)){
		echo '<option value="'.$data['cname'].'">';
	}
?>
</datalist>


<script type="text/javascript">
var htmlobjek;
$(document).ready(function(){
	//apabila terjadi event onchange terhadap object <select id=propinsi>
	$("#cname").change(function(){
	var cname = $("#cname").val();
	$.ajax({
	url: "inc/ambilccontact.php",
	data: "cname="+cname,
	cache: false,
	success: function(msg){
	//jika data sukses diambil dari server kita tampilkan
	//di <select id=kota>
	$("#ccontact").html(msg);
	}
	});
	});
});
</script> 