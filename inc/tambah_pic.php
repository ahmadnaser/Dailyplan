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
	<legend>Create Customer</legend>
	<form action="" method="post" enctype="multipart/form-data">
	<table>
		<tr>
			<td>Customer Name</td>
			<td>:</td>
			<td>
			<input list="cnm" name="cname" class="form-control" required>
			</td>
		</tr>
		<tr>
			<td>PIC</td>
			<td>:</td>
			<td><input type="text" name="pic" class="form-control" required/></td>
		</tr>
		<tr>
			<td>Divisi</td>
			<td>:</td>
			<td>
				<select name="cdiv" id="cdiv" class="form-control" >
				<?php
				$sqldiv = mysqli_query($link,"select * from tbl_divisi order by div_id asc");
				while($datadiv = mysqli_fetch_array($sqldiv)){
					echo '<option value="'.$datadiv['div_name'].'">'.$datadiv['div_name'].'</option>';
				}
				?>
				</select>
			</td>
		</tr>
		<tr>
			<td>Phone</td>
			<td>:</td>
			<td><input type="text" name="cphone" class="form-control" /></td>
		</tr>
		<tr>
			<td>Email</td>
			<td>:</td>
			<td><input type="text" name="cemail" class="form-control" /></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td><input type="submit" name="tambah" value="Save" class="btn btn-success btn-sm" />   
			<input type="reset" value="Cancel" class="btn btn-success btn-sm" /></td>
		</tr>
	</table>		
	</form>

	<?php
	if(isset($_POST['tambah'])){
		$cnames = $_POST['cname'];
		$cname = strtoupper($cnames);
		$pics = $_POST['pic'];
		$pic = strtoupper($pics);
		$cdiv = $_POST['cdiv'];
		$cphone = $_POST['cphone'];
		$email = $_POST['cemail'];

		if($cname=="" || $pic=="" || $cdiv==""){
			?>
				<script type="text/javascript">
				alert("data tidak boleh kosong");
				</script>
			<?php
		}else{
			mysqli_query($link,"insert into tbl_customer(cname,ccontact,cdiv,cphone,email) values('$cname','$pic','$cdiv','$cphone','$email')");
			echo "<font color='red'>PIC sukses dibuat</font>";
		}
	}
	?>
</fieldset>
<datalist id="cnm">
<?php
$sqlcname = mysqli_query($link,"select cname from tbl_customer group by cname order by cname asc");
while($datanam = mysql_fetch_array($sqlcname)){
echo '<option value="'.$datanam['cname'].'">';
}
?>
</datalist>
<script src="js/jquery-1.11.0.min.js"></script> 