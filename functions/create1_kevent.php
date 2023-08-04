<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "ale_deve";
// $tableName = "yjh_kevents";

$con = mysqli_connect($host,$user,$pass,$db);

 $q = 'INSERT INTO yjh_kevents(idfreeln, idrekr, idvac, idcand, evdate, evdate2) VALUES ("'.$_POST['ef'].'", "'.$_POST['er'].'",
  "'.$_POST['ev'].'", "'.$_POST['ec'].'", "'.$_POST['edt'].'", "'.$_POST['ed2'].'")';


$query = mysqli_query($con,$q);
