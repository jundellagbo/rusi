<?php
session_start();
include '../db/connection.php';

if (isset($_POST['SUBMIT'])) 
{
	$extend_days = $_POST['extend_days'];
	 $checkdata = $dbConn->query("SELECT * FROM settings");
	 $exist = $checkdata->fetch(PDO::FETCH_ASSOC);
	 if ($exist['extend_days'] == NULL)
	 {
	 
	 $checkexist= $dbConn->query("INSERT INTO settings (extend_days) VALUES ('".$extend_days."') ");

	 }
	 else
	 {

	 $checkexist= $dbConn->query("UPDATE settings SET extend_days = '".$extend_days."' ");
	
	 }
	 if ($checkexist) 
	 {
	 	 $activity  = 'CHANGING EXTEND DAYS TO: '.$_POST['extend_days'].' ';

			$insertact = $dbConn->query("INSERT INTO logs (activity,user_id) VALUES ('".$activity."','".$_SESSION['username']."')");	

		echo '<div class="alert alert-success animated bounceInDown" >
                      <button class="close" data-dismiss="alert" type="button">×</button> <strong>Extend Days has been Set to</strong> '.$_POST['extend_days'].' day(s)
                    </div>';		
	 	
	 }
	 else
	 {
	 	echo '<div class="alert alert-warning alert-dismissable">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      <strong>Warning</strong> Something wrong.
                    </div>';
	 }
}

?>