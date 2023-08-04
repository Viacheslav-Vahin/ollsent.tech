<?php
$cu = $_POST['cu8'];
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ale_deve";


$conn = mysqli_connect($servername, $username, $password, $dbname);
$sql = "SELECT * FROM yjh_kevents AS E WHERE E.idcand =  '" . $cu . "' ORDER BY idevent";
//$sql = "SELECT * FROM yjh_kevents AS E INNER JOIN yjh_posts AS P ON M.post_id = P.ID INNER JOIN yjh_postmeta AS M ON M.post_id = E.idvac WHERE E.idrekr =  '" . $cu . "'  ORDER BY idevent";
//$sql = "SELECT * FROM yjh_kevents AS E INNER JOIN yjh_postmeta AS M ON M.post_id = E.idvac WHERE E.idrekr =  '" . $cu . "' AND E.idvac = M.post_id  ORDER BY idevent";
//$sql = "SELECT * FROM yjh_kevents AS E LEFT JOIN yjh_postmeta AS M ON M.post_id = E.idvac WHERE E.idrekr =  '" . $cu . "' ORDER BY idevent";
//$sql = "SELECT P.ID, P.post_title, P.post_author, M.meta_key, M.meta_value FROM yjh_posts AS P RIGHT JOIN yjh_postmeta AS M ON M.post_id = P.ID
//WHERE P.post_type = 'notiajax' AND post_title = $cu6 AND M.meta_key = 'modify_date'";

$result = mysqli_query($conn, $sql);
$data1 = array();
//if (mysqli_num_rows($result) > 0) {
//    while ($row = mysqli_fetch_assoc($result)) {
//       echo "<p>gcal</p>";

echo '<div class="lHist">';
foreach ($result as $row1)
{
    echo '<p>';
    //echo $row1["idevent"];
    echo '<span class="vac1">';
    echo $row1["idvac"];
    echo '</span>';
    // echo '<span class="vacRes">'; echo '</span>';
    echo '<span class="rekr1">';  
    echo $row1["idrekr"];
    echo '</span>';
    echo ' ';
    //echo $row1["idcand"];
    echo '<span class="frelns">';  
    echo $row1["idfreeln"];
    echo '</span>';
    
    echo ' ';
    echo $row1["evdate"];
    // echo ' ';
    // echo $row1["evdate2"];
    echo '</p>';
}
echo '</div>';

//print_r ($result);