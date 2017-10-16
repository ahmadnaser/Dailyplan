<?php                      
// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=ts-".date('dmy').".xls");
?>

<?php
date_default_timezone_set('Asia/Jakarta');
$host = "192.168.1.90";
$user = "ymsjkt";
$pass = "ymsjkt";
$koneksi = mysqli_connect($host, $user, $pass);
$konak = mysqli_select_db($koneksi,"db_dailyplan") or die (mysql_error()); 
?>

<h2>Laporan Dailyplan TS</h2>
<table border="1px">
		<tr>
			<th>no</th>
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
		</tr>
		<?php
		$inputan_pencarian = @$_GET['keyword'];
		$tanggals = @$_GET['tanggal'];
		$tanggals2 = @$_GET['tanggal2'];

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

			if($inputan_pencarian != null  and $tanggal==0 and $tanggal2==0){
				$sql = mysqli_query($koneksi,"SELECT id,tgl_kunjungan, jam_kunjungan,request_by,partner1,partner2,partner3,
				tujuan,area,pic,pic_division,telepon,email,product,problem,hasil FROM tbl_dailyform where 
				(((request_by like '%$inputan_pencarian%' or partner1 like '%$inputan_pencarian%') 
					or partner2 like '%$inputan_pencarian%') or partner3 like '%$inputan_pencarian%') order by no asc, jam_kunjungan asc ") or die (mysqli_error());
			}else if($inputan_pencarian == null  and $tanggal==0 and $tanggal2==0){
				$sql = mysqli_query($koneksi,"SELECT id,tgl_kunjungan, jam_kunjungan,request_by,partner1,partner2,partner3,
				tujuan,area,pic,pic_division,telepon,email,product,problem,hasil FROM tbl_dailyform 
				where (((request_by in (select nama from tbl_pic where divisi='TS' and region='jakarta') or 
		        partner1 in (select nama from tbl_pic where divisi='TS' and region='jakarta')) or 
		        partner2 in (select nama from tbl_pic where divisi='TS' and region='jakarta')) or 
		        partner3 in (select nama from tbl_pic where divisi='TS' and region='jakarta'))
		         order by no asc, jam_kunjungan asc") or die (mysqli_error());
			}else if($inputan_pencarian != null  and $tanggal!=0 and $tanggal2!=0){
				$sql = mysqli_query($koneksi,"SELECT id,tgl_kunjungan, jam_kunjungan,request_by,partner1,partner2,partner3,
				tujuan,area,pic,pic_division,telepon,email,product,problem,hasil FROM tbl_dailyform where 
				(((request_by like '%$inputan_pencarian%' or partner1 like '%$inputan_pencarian%') 
					or partner2 like '%$inputan_pencarian%') or partner3 like '%$inputan_pencarian%') 
				and tgl_kunjungan between '$tanggal' and '$tanggal2' order by no asc, jam_kunjungan asc ") or die (mysqli_error());
			}else if($tanggal==0 || $tanggal2==0){
				?>
				<script type="text/javascript">
				alert("jangan pilih hanya kolom 1 tanggal");
				</script>
				<?php
			}else if($inputan_pencarian == null  and $tanggal!=0 and $tanggal2!=0){
				$sql = mysqli_query($koneksi,"SELECT id,tgl_kunjungan, jam_kunjungan,request_by,partner1,partner2,partner3,
				tujuan,area,pic,pic_division,telepon,email,product,problem,hasil FROM tbl_dailyform 
				where tgl_kunjungan between '$tanggal' and '$tanggal2' and 
				(((request_by in (select nama from tbl_pic where divisi='TS' and region='jakarta') or 
		        partner1 in (select nama from tbl_pic where divisi='TS' and region='jakarta')) or 
		        partner2 in (select nama from tbl_pic where divisi='TS' and region='jakarta')) or 
		        partner3 in (select nama from tbl_pic where divisi='TS' and region='jakarta'))
		         order by tgl_kunjungan asc, request_by asc, jam_kunjungan asc") or die (mysqli_error());
			}

		$no=1;
		$cek=mysqli_num_rows($sql);
		if($cek <1){
			?>
			<tr>
				<td colspan="14" align="center" style="padding:10px;">Data tidak ditemukan</td>
			</tr>
			<?php
		}else{
			while($data = mysqli_fetch_array($sql)){
			?>
			<tr>
				<td><?php echo $no ?></td>
				<td><?php echo $data['tgl_kunjungan']; ?></td>
				<td><?php echo $data['request_by']; ?></td>
				<td><?php echo $data['partner1']; ?></td>
				<td><?php echo $data['partner2']; ?></td>
				<td><?php echo $data['partner3']; ?></td>
				<td><?php echo $data['tujuan']; ?></td>
				<td><?php echo $data['area']; ?></td>
				<td><?php echo $data['jam_kunjungan']; ?></td>
				<td><?php echo $data ['product']; ?></td>
                <td><?php echo $data ['pic']; ?></td>
                <td><?php echo $data ['pic_division']; ?></td>
                <td><?php echo $data ['telepon']; ?></td>
                <td><?php echo $data ['problem']; ?></td>
                <td><?php echo $data ['hasil']; ?></td>
			</tr>
			<?php
			$no++;
			}
		}
		?>
	</table>