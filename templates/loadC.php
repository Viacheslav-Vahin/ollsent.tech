<?php
$connect1 = new PDO('mysql:host=localhost;dbname=ale_deve', 'root', '');
$data1 = array();
$guery1 = "SELECT * FROM yjh_gcevents ORDER BY id";
$statement1 = $connect1->prepare($guery1);
$statement1->execute();
$result1 = $statement1->fetchAll();
foreach ($result1 as $row1)
{
    $data1[] = array(
        'id' => $row1["id1"],
        'title' => 'hihi5',
        'start' => $row1["start1"],
        'end' => $row1["end1"]
    );
}
echo json_encode($data1);


//$servername = "localhost";
//$username = "al_dev_db";
//$password = ")ftH61jJUur#ksvc9";
//$dbname = "ale_deve";
//
//$connect1 = mysqli_connect($servername, $username, $password, $dbname);
////$connect1 = new PDO('mysql:host=localhost;dbname=ale_deve', 'al_dev_db', ')ftH61jJUur#ksvc9');
//$data1 = array();
//$guery1 = "SELECT * FROM yjh_gcevents ORDER BY id";
////$statement1 = $connect1->prepare($guery1);
////$statement1->execute();
//$result1 = mysqli_query($connect1, $guery1);
////$result1 = $statement1->fetchAll();
//foreach ($result1 as $row1) {
//    $data1[] = array(
//        'id' => $row1["id1"],
//        'title' => 'hihi5',
//        'start' => $row1["start1"],
//        'end' => $row1["end1"]
//    );
//}
//echo json_encode($data1);