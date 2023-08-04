<?php
// $cu6 = $_POST['cu6'];

$servername = "golden26.mysql.tools";
$username = "golden26_devusr";
$password = "gD29uz7VsNX8";
$dbname = "golden26_test";

$conn = mysqli_connect($servername, $username, $password, $dbname);
mysqli_set_charset($conn, "utf8");
$sql = "SELECT * FROM yjh_countries_regions";

$result = mysqli_query($conn, $sql);


if (mysqli_num_rows($result) > 0) {
    echo "<option value=''>Виберіть регіон</option>";
    while ($row = mysqli_fetch_assoc($result)) {        
        echo "<option class='region' value='"; echo $row['regions']; echo "'>";
        echo $row['regions'];
        echo "</option>";
    }
}
