<?php
$link = mysqli_connect("localhost","root","");
mysqli_select_db($link,"db_dailyplan");
$cname = $_GET['cname'];
$ccontact = mysqli_query($link,"SELECT * FROM tbl_customer WHERE cname='$cname' and ccontact not like '' group by ccontact order by ccontact asc");
$jsArray = "var dtMhs = new Array();\n";  
echo "<option value=''>--PILIH PIC--</option>";
while($row = mysqli_fetch_array($ccontact)){
echo "<option value=\"".$row['ccontact']."\">".$row['ccontact']."</option>\n"; 
  $jsArray .= "dtMhs['" . $row['ccontact'] . "'] = {
          cdiv:'" . addslashes($row['cdiv']) . "',
          cphone:'".addslashes($row['cphone'])."',
        email:'".addslashes($row['email'])."'};\n"; 
}
?>

<script type="text/javascript">    
    <?php echo $jsArray; ?>  
    function changeValue(ccontact){  
    document.getElementById('cdiv').value = dtMhs[ccontact].cdiv;  
    document.getElementById('cphone').value = dtMhs[ccontact].cphone;  
    document.getElementById('email').value = dtMhs[ccontact].email;  
    };  
</script> 