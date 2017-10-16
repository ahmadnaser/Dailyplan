<style type="text/css">
table,tr,th,td{
	padding: 5px;
	border-collapse: collapse;
	text-align: left;
}
th{
	background-color: blue;
	color: white;
	text-align: center;
}
</style>
<fieldset>
	<legend>Report</legend>
<div class="container">
<section class="col-lg-12">
<div class="table-responsive">
<table class="table table-bordered table-striped" align="center">
<?php
if(@$_SESSION['username']){
	$username=@$_SESSION['username'];
}
	$ex = mysqli_query($link,"select * from tbl_dailyform where request_by='$username' and hasil!='' order by no desc, jam_kunjungan desc limit 30");
?>
		<tr>
			<th>Visit date</th>
			<th>Time</th>
			<th>Request</th>
			<th>Partner 1</th>
			<th>Partner 2</th>
			<th>Partner 3</th>
			<th>Customer name</th>
			<th>Area</th>
			<th>PIC</th>
			<th>Visit report</th>
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
	echo "<td>".$r['tgl_kunjungan']."</td>";
	echo "<td>".$r['jam_kunjungan']."</td>";
	echo "<td>".$r['request_by']."</td>";
	echo "<td>".$r['partner1']."</td>";
	echo "<td>".$r['partner2']."</td>";
	echo "<td>".$r['partner3']."</td>";
    echo "<td>".$r['tujuan']."</td>";
    echo "<td>".$r['area']."</td>";
    echo "<td>".$r['pic']."</td>";
    echo "<td>".$r['hasil']."</td>";
	echo "</tr>"; 
$no++;
}
$bnyk = mysqli_num_rows($ex);
?>
	</table>
</div>
</section>
</div>
	
<font color="blue">Data : <?php echo $bnyk; ?> of 30</font>
</fieldset>
<script src="js/jquery-1.11.0.min.js"></script> 