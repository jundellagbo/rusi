<?php
include 'db/connection.php';

$check = $dbConn->query("SELECT * FROM accounts where terms = months");
echo $check->rowCount();

?>