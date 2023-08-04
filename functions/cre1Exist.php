<?php
// $cu6 = $_POST['cu6'];
// $server = "localhost";
// $username = "al_dev_db";
// $pass = ")ftH61jJUur#ksvc9";
// $db = "ale_deve";

// $conn = mysqli_connect($server, $username, $pass, $db);
// $sql = "SELECT * FROM yjh_kalendar ORDER BY id";


$host = "localhost";
$user = "root";
$pass = "";
$db = "ale_deve";
// $tableName = "yjh_kevents";

$con = mysqli_connect($host,$user,$pass,$db);
$sql = "SELECT yjh_kevents.idcand AS eid FROM yjh_kevents";
//$sql = "SELECT yjh_kevents.idcand AS eid FROM yjh_kevents ORDER BY idevent";

$result = mysqli_query($con, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<p>";
        echo $row['eid'];
        
        echo "</p>";
    }
} else {
    echo "none.";
}
// $data1 = array();
// foreach ($result as $row1)
// {
//     $start = $row1["day"] . ' ' . $row1["stime"];
//     $end = $row1["day"] . ' ' . $row1["etime"];
//     $data1[] = array(
//         'id' => $row1["id"],
//         'title' => $row1["title"],
//         'url' => $row1["url"],
//         'start' => $start,
//         'end' => $end,
//         'sotr' => $row1["sotr"],
//         'det' => $row1["det"]
//     );
// }
// echo json_encode($data1, JSON_UNESCAPED_UNICODE);
