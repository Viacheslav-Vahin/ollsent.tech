<?php
//$cu6 = $_POST['cu6'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ale_deve";

$conn = mysqli_connect($servername, $username, $password, $dbname);
$sql0 = "SELECT P.ID, P.post_title, P.post_author, M.meta_key, M.meta_value FROM yjh_posts AS P RIGHT JOIN yjh_postmeta AS M ON M.post_id = P.ID
WHERE P.post_type = 'notiajax' AND post_title = $cu6 AND M.meta_key = 'modify_date'";

$sql = "SELECT P.ID, P.post_title, M.meta_key, M.meta_value FROM yjh_posts AS P RIGHT JOIN yjh_postmeta AS M ON M.post_id = P.ID
WHERE P.post_type = 'rekomend' AND M.meta_key = 'status_r' AND M.meta_value = 'Горящий'";

$sql2 = "SELECT P.ID, P.post_title, M.meta_key AS mk, M.meta_value AS mv FROM yjh_posts AS P RIGHT JOIN yjh_postmeta AS M ON M.post_id = P.ID
WHERE P.post_type = 'rekomend' AND M.meta_key = 'status_r' AND M.meta_value LIKE 'field\_%'";
// WHERE P.post_type = 'rekomend' AND M.meta_key = 'status_r' AND M.meta_value = 'Горящий'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
//        echo "<p>";
//        echo $row['post_title']; echo " ";
//        echo $row['meta_value'];
        // $name = get_field('imya', $row);
        ?>
        <div class="dynam">
        <span><?php echo $row['ID']; ?></span>
        <span><?php echo $row['post_title']; ?></span>
        <span><?php echo $row['meta_value']; ?></span>
        
        </div>
        <?php
//        echo "</p>";
    }
} else {
    echo "none.";
}
//echo 'tttttttttttttttttttttttttttttttt99999999999999999999999999999999999999999900';
