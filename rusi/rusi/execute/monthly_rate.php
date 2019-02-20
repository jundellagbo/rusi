<?php
session_start();
include '../db/connection.php';

if (isset($_POST['SUBMIT'])) 
{
	$monthly_rates = $_POST['monthly_rates'] / 100;
	 $checkdata = $dbConn->query("SELECT * FROM settings");
	 $exist = $checkdata->fetch(PDO::FETCH_ASSOC);
	 if ($exist['monthly_rate'] == NULL)
	 {
	 
	 $checkexist= $dbConn->query("INSERT INTO settings (monthly_rate) VALUES ('".$monthly_rates."') ");

	 }
	 else
	 {

	 $checkexist= $dbConn->query("UPDATE settings SET monthly_rate = '".$monthly_rates."' ");
	
	 }
	 if ($checkexist) 
	 {
	 	 $activity  = 'CHANGING MONTHLY RATES TO: '.$_POST['monthly_rates'].' ';

			$insertact = $dbConn->query("INSERT INTO logs (activity,user_id) VALUES ('".$activity."','".$_SESSION['username']."')");	

	 	echo '<div class="alert alert-success animated bounceInDown" >
                      <button class="close" data-dismiss="alert" type="button">×</button> 
                      <strong>Monthly rates has been Set to</strong> '.$_POST['monthly_rates'].' %
                    </div>';
	 	//header("location:../index.php?display=settings");
	 }
	 else
	 {
	 	echo '<div class="alert alert-warning alert-dismissable">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      <strong>Warning</strong> Something wrong.
                    </div>';
	 	//header("location:../index.php?display=settings");
	 }
}

?>