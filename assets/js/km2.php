<?php
$cu6 = $_POST['cu6'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ale_deve";

$conn = mysqli_connect($servername, $username, $password, $dbname);
//$sql = "SELECT * FROM yjh_kanban_tasks WHERE user_id_assigned = $cu6";
$sql = "SELECT *, yjh_kanban_tasks.title AS name, yjh_kanban_tasks.modified_dt_gmt AS lastDate, yjh_kanban_estimates.title AS name2 FROM yjh_kanban_tasks LEFT JOIN yjh_kanban_estimates
   ON yjh_kanban_tasks.estimate_id = yjh_kanban_estimates.id
LEFT JOIN yjh_kanban_projects ON yjh_kanban_tasks.project_id = yjh_kanban_projects.id
WHERE user_id_assigned = $cu6 ORDER BY yjh_kanban_tasks.modified_dt_gmt DESC";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<p>";
       // echo $row['user_id_assigned'];
        echo " Task: ";
        echo $row['name'];
        echo "; Project: ";
        echo $row['title'];
//        echo " ";
//        echo $row['hours'];
       ?><span class="estimateT"><?php echo "; Estimate: "; ?></span><?php
        echo $row['name2'];
        ?><input class="lastDate1" value="<?php echo $row['lastDate']; ?>"><?php
        echo "</p>";
    }
} else {
    echo "none.";
}

