<?php
session_start();
include 'db/connection.php';

if ($_SESSION['branch'] == 'any') {
	
$count_message = $dbConn->query("SELECT * FROM stocks where status = 'repo' AND price = '0' ");
$damn = $count_message->rowCount();
}else
{

$count_message = $dbConn->query("SELECT * FROM stocks where status = 'repo' AND price = '0' AND branch = '".$_SESSION['branch']."' ");
$damn = $count_message->rowCount();
}


if ($damn == 0) 
{
	echo '';
}
else
{

echo ' <p class="counter animated fadeIn">

                  '.$damn.'</p>';

}

?>