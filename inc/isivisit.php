<style type="text/css">
table,tr,th,td{
	padding: 5px;
	text-align: left;
}
</style>
<?php
include "inc/koneksi.php";
$no = @$_GET['no'];
$query = mysqli_query($link, "select * from tbl_dailyform where no=$no") or die (mysql_error());
$r = mysqli_fetch_array($query);
?>

<form action="" method="post">
<table>
<tr>
	<td></td>
	<td></td>
	<td><input class="form-control" type="hidden" name="no" value="<?php echo $r['no']; ?>" readonly /></td>
</tr>
<tr>
	<td>Visit Date</td>
	<td>:</td>
	<td><input class="form-control" type="text" name="date" value="<?php echo $r['tgl_kunjungan']; ?>" readonly /></td>
</tr>
<tr>
	<td>Customer Name</td>
	<td>:</td>
	<td><input class="form-control" type="text" name="customer" value="<?php echo $r['tujuan']; ?>" readonly /></td>
</tr>
<tr>
	<td>Area</td>
	<td>:</td>
	<td><input class="form-control" type="text" name="area" value="<?php echo $r['area']; ?>" readonly /></td>
</tr>
<tr>
	<td>PIC</td>
	<td>:</td>
	<td><input class="form-control" type="text" name="pic" value="<?php echo $r['pic']; ?>" readonly /><td>
<tr>
<tr>
	<td>Visit Report</td>
	<td>:</td><td>
	<textarea class="form-control" name="report" required></textarea><td>
<tr>
<tr><td></td><td></td><td><input type="submit" name="bok" value="Save" class="btn btn-success btn-sm"/></td></tr>
</table>
</form>

<?php
if(isset($_POST['bok'])) {
	$no = @$_GET['no'];
	$report = @$_POST['report'];
	if($report == null){
		?>
		<script type="text/javascript">
		alert("hasil harus diisi");
		</script>
		<?php
	}else{
	$q = "update tbl_dailyform set hasil='$report', status='3' ";
	$q .= "where no=$no";
	mysqli_query($link,$q);
	?>
		    <script language="javascript">
                window.location.href="index.php?page=visit";
            </script>
		    <?php
	}
}
?>

<script src="js/jquery-1.11.0.min.js"></script> 







		