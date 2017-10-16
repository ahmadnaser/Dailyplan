<style type="text/css">
table,tr,th,td{
	padding: 5px;
	border-collapse: collapse;
	text-align: center;
}
th{
	background-color: blue;
	color: white;
}
</style>

<fieldset>
	<legend>Visit Report</legend>
	<div class="container">
<section class="col-lg-12">
<div class="table-responsive">
<table class="table table-bordered table-striped" align="center">
<?php
if(@$_SESSION['username']){
	$username=@$_SESSION['username'];
}
	$ex = mysqli_query($link,"select * from tbl_dailyform where request_by='$username' and hasil='' ");
?>
		<tr>
			<th>No</th>
			<th>Visit date</th>
			<th>Customer name</th>
			<th>Area</th>
			<th>PIC</th>
			<th>Visit report</th>
			<th>Action</th>
		</tr>
<?php
$no=1;
$bnyk=0;
while($r = mysqli_fetch_array($ex)){
if($no%2 != 0){
    $color='white';
}else{
    $color='#CCCCCC';
}
	echo "<tr bgcolor='$color'>";
	echo "<td>".$r['no']."</td>";
	echo "<td>".$r['tgl_kunjungan']."</td>";
    echo "<td>".$r['tujuan']."</td>";
    echo "<td>".$r['area']."</td>";
    echo "<td>".$r['pic']."</td>";
    echo "<td>".$r['hasil']."</td>";
    echo "<td><a href='?page=visit&action=update&no=".$r['no']."'><button type='button' class='btn btn-success btn-sm'>content results</button></a></td>";
	echo "</tr>";
$no++; 
}
$bnyk = mysqli_num_rows($ex);
?>

	</table>
</div>
</section>
</div>
	
<font color="blue">Data : <?php echo $bnyk; ?></font>
</fieldset>

<script src="js/jquery-1.11.0.min.js"></script> 
