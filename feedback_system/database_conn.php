<!-- Gokul Gampala @ Team 30 | w18031735 | Northumbria University | Team Project and Professionalism KV6002-->
<?php
$dbConn = new mysqli('localhost', 'unn_w19030982', 'qwerty81', 'unn_w19030982'); //credentials for database
if ($dbConn->connect_error) {
    echo "<p>Connection failed: ".$dbConn->connect_error."</p>\n"; //failed to connect to database
    exit;
}
?>
