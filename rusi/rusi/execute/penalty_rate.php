<?php
session_start();
include '../db/connection.php';



if (isset($_POST['SUBMIT'])) 
{

	 $penalty_rates = $_POST['penalty_rates'] / 100;
	 $checkdata = $dbConn->query("SELECT * FROM settings");
	 $exist = $checkdata->fetch(PDO::FETCH_ASSOC);
	 if ($exist['penalty_rate'] == NULL)
	 {
	 
	 $checkexist= $dbConn->query("INSERT INTO settings (penalty_rate) VALUES ('".$penalty_rates."') ");

	 }
	 else
	 {

	 $checkexist= $dbConn->query("UPDATE settings SET penalty_rate = '".$penalty_rates."' ");
	
	 }
	 if ($checkexist) 
	 {
	 	 $activity  = 'CHANGING PENALTY RATES TO: '.$_POST['penalty_rates'].' ';

			$insertact = $dbConn->query("INSERT INTO logs (activity,user_id) VALUES ('".$activity."','".$_SESSION['username']."')");	

	 	echo '<div class="alert alert-success animated bounceInDown" >
                      <button class="close" data-dismiss="alert" type="button">×</button>       <strong>Penalty Rates has been Set to</strong> '.$_POST['penalty_rates'].' %
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