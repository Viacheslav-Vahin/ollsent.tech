<?php
$cu6 = $_POST['cu6'];

$servername = "golden26.mysql.tools";
$username = "golden26_devusr";
$password = "gD29uz7VsNX8";
$dbname = "golden26_test";

$conn = mysqli_connect($servername, $username, $password, $dbname);
mysqli_set_charset($conn, "utf8");
$sql = "SELECT * FROM yjh_countries";

$result = mysqli_query($conn, $sql);


if (mysqli_num_rows($result) > 0) {
    echo "<option value='' selected='selected'>Виберіть країну</option>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<option data-region='"; echo $row['region']; echo "'"; echo "class='country' value='"; echo $row['country']; echo "'>";
        echo $row['country'];
        echo "</option>";
    }
}
