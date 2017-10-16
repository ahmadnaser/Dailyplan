<?php
$link = mysqli_connect("localhost","root","") or die (mysql_error());
mysqli_select_db($link, "db_dailyplan") or die (mysql_error());
?>