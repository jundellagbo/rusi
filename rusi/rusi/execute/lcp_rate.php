<?php
session_start();
include '../db/connection.php';

if (isset($_POST['SUBMIT'])) 
{
	$monthly_rates = $_POST['lcp_rates'] / 100;
	 $checkdata = $dbConn->query("SELECT * FROM settings");
	 $exist = $checkdata->fetch(PDO::FETCH_ASSOC);
	 if ($exist['lcp_rate'] == NULL)
	 {
	 
	 $checkexist= $dbConn->query("INSERT INTO settings (lcp_rate) VALUES ('".$monthly_rates."') ");

	 }
	 else
	 {

	 $checkexist= $dbConn->query("UPDATE settings SET lcp_rate = '".$monthly_rates."' ");
	
	 }
	 if ($checkexist) 
	 {
	 	 $activity  = 'CHANGING LCP RATES TO: '.$_POST['lcp_rates'].' ';

			$insertact = $dbConn->query("INSERT INTO logs (activity,user_id) VALUES ('".$activity."','".$_SESSION['username']."')");	

	 	echo '<div class="alert alert-success animted bounceInDown">
                      <button class="close" data-dismiss="alert" type="button">×</button>
                      <strong>LCP rates has been Set to</strong> '.$_POST['lcp_rates'].' %
                    </div>';
	 	//header("location:../index.php?display=settings");
	 }
	 else
	 {
	 	echo '<div class="alert alert-danger animted shake">
                      <button class="close" data-dismiss="alert" type="button">×</button>
                      <strong>Warning</strong> Something wrong.
                    </div>';
	 	//header("location:../index.php?display=settings");
	 }
}

?>