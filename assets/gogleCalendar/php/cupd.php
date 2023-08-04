<?php
$cu6 = $_POST['cu6'];
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ale_deve";
$id = $_POST['id'];
$title = $_POST['t'];
$url = $_POST['url'];
$start = $_POST['st'];
$end = $_POST['end'];
$sotr= $_POST['sotr'];
$det= $_POST['det'];

$conn = mysqli_connect($servername, $username, $password, $dbname);
$sql = 'UPDATE yjh_kalendar SET title="' . $title . '", det="' . $det . '", sotr="' . $sotr . '", stime="' . $start . '", etime="' . $end . '" WHERE id = "' . $id . '"';

$result = mysqli_query($conn, $sql);
$data1 = array();

//foreach ($result as $row1)
//{
//    $data1[] = array(
//        'id' => $row1["id"],
//        'title' => $row1["title"],
//        'url' => $row1["url"],
//        'start' => $row1["start"],
//        'end' => $row1["end"],
//        'sotr' => $row1["sotr"]
//    );
//}