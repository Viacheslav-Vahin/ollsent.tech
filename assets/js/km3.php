<?php
$cu6 = $_POST['cu6'];
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ale_deve";

$conn = mysqli_connect($servername, $username, $password, $dbname);
//$sql = "SELECT * FROM yjh_kanban_tasks WHERE user_id_assigned = $cu6";
$sql = "SELECT P.ID, P.post_title, P.post_author, M.meta_key, M.meta_value FROM yjh_posts AS P RIGHT JOIN yjh_postmeta AS M ON M.post_id = P.ID
WHERE P.post_type = 'notiajax' AND post_title = $cu6 AND M.meta_key = 'modify_date'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
//        echo "<p>";
//        echo $row['post_title']; echo " ";
//        echo $row['meta_value'];
        ?><input value="<?php echo $row['meta_value']; ?>" class="" id="savedDate"><?php
//        echo "</p>";
    }
} else {
    echo "none.";
}
