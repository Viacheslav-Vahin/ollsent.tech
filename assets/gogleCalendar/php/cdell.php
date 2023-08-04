<?php
$host = "localhost";
$user = "root";
$pass = "";
$databaseName = "ale_deve";
$tableName = "yjh_kalendar";
$id = $_POST['id'];
$con = mysqli_connect($host,$user,$pass,$databaseName);
$sql = 'DELETE FROM yjh_kalendar WHERE id = "' . $id . '"';
$query = mysqli_query($con,$sql);
//if ($sql) {
//    echo $id;
//}
