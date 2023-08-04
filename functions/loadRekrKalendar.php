<?php
$cu6 = $_POST['cu6'];
$cu7 = $_POST['cu7'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ale_deve";

$conn = mysqli_connect($servername, $username, $password, $dbname);
//$sql = "SELECT * FROM yjh_kanban_tasks WHERE user_id_assigned = $cu6";
$sql = "SELECT * FROM yjh_kalendar WHERE uid = $cu7";



$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<p>";        
        echo "Тема: ";
        echo $row['title'] . '.';
        echo " Рекрутёр: ";
        echo $row['sotr'];
        echo "; Задание: ";
        echo $row['det'] . '.';

        echo "</p>";
    }
} else {
    echo "none.";
}

