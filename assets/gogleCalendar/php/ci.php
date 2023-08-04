<?php
$host = "localhost";
$user = "root";
$pass = "";
$databaseName = "ale_deve";
$tableName = "yjh_kalendar";

$con = mysqli_connect($host,$user,$pass,$databaseName);
$title = $_POST['t'];
// $q = 'INSERT INTO yjh_kalendar(title, start, end, sotr) VALUES ("'.$_POST['t'].'", "'.$_POST['s'].'", "'.$_POST['e'].'", "'.$_POST['eso'].'")';
$q = 'INSERT INTO yjh_kalendar(title, sotr, stime, etime, day, det, uid) VALUES ("'.$_POST['t'].'", "'.$_POST['eso'].'", "'.$_POST['s1'].'",
 "'.$_POST['e1'].'", "'.$_POST['d'].'", "'.$_POST['de'].'", "'.$_POST['uid'].'")';
$data = array();

$query = mysqli_query($con,$q);
//if($query){
//    echo ' Data Inserted Successfully';
//        mysqli_close($con);
//
//}
//while ($row = mysql_fetch_array($result))
//{
//    echo $row['message']." - ".$row['date'];
//    echo "<br />";
//}

//echo ' Data Inserted Successfully';

// ========================
//$q = $con->prepare('INSERT INTO yjh_kalendar (title, start, end) VALUES (?, ?, ?)');
//$q = $con->prepare('INSERT INTO yjh_kalendar (title, start, end) VALUES (?, ?, ?)');
//$q->bind_param($title, $start, $end);
//$q->execute();