<?php
$cu6 = $_POST['cu6'];
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ale_deve";

//$cu6 = $_POST['cu6'];
//$servername = "localhost";
//$username = "al_dev_db";
//$password = ")ftH61jJUur#ksvc9";
//$dbname = "ale_deve";

$conn = mysqli_connect($servername, $username, $password, $dbname);
$sql = "SELECT * FROM yjh_kalendar ORDER BY id";
//$sql = "SELECT P.ID, P.post_title, P.post_author, M.meta_key, M.meta_value FROM yjh_posts AS P RIGHT JOIN yjh_postmeta AS M ON M.post_id = P.ID
//WHERE P.post_type = 'notiajax' AND post_title = $cu6 AND M.meta_key = 'modify_date'";

$result = mysqli_query($conn, $sql);
$data1 = array();
//if (mysqli_num_rows($result) > 0) {
//    while ($row = mysqli_fetch_assoc($result)) {
//       echo "<p>gcal</p>";
foreach ($result as $row1)
{
    $start = $row1["day"] . ' ' . $row1["stime"];
    $end = $row1["day"] . ' ' . $row1["etime"];
    $data1[] = array(
        'id' => $row1["id"],
        'title' => $row1["title"],
        'url' => $row1["url"],
        'start' => $start,
        'end' => $end,
        'sotr' => $row1["sotr"],
        'det' => $row1["det"]
    );
}
echo json_encode($data1, JSON_UNESCAPED_UNICODE);

//echo '[{"title": "All Day Event9","start": "2021-10-01"},{"title": "Long Event9","start": "2021-10-07","end": "2021-10-10"}]';