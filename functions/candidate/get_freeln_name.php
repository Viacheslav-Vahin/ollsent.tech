<?php
$fr = $_POST['fr'];
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ale_deve";


$conn = mysqli_connect($servername, $username, $password, $dbname);
$usernames = "SELECT user_nicename, user_url, user_email, user_registered, display_name, ID FROM yjh_users WHERE ID = '" . $fr . "' ORDER BY ID DESC LIMIT 10";
$result = mysqli_query($conn, $usernames);
foreach ($result as $row1)
{
    echo ' фрилансер: ' . $row1["display_name"];
}

