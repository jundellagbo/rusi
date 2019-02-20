<?php
session_start();
include '../db/connection.php';



if (isset($_POST['SUBMIT'])) 
{

	 $rebate_rate = $_POST['rebateset'];
	 $checkdata = $dbConn->query("SELECT * FROM settings");
	 $exist = $checkdata->fetch(PDO::FETCH_ASSOC);
	 if ($exist['rebate_rate'] == NULL) 
	 {
	 
	 $checkexist= $dbConn->query("INSERT INTO settings (rebate_rate) VALUES ('".$rebate_rate."') ");

	 }
	 else
	 {

	 $checkexist= $dbConn->query("UPDATE settings SET rebate_rate = '".$rebate_rate."' ");
	
	 }
	 if ($checkexist) 
	 {
	 	 $activity  = 'CHANGING REBATES INTO : '.$_POST['rebateset'].' ';

			$insertact = $dbConn->query("INSERT INTO logs (activity,user_id) VALUES ('".$activity."','".$_SESSION['username']."')");	

	 	echo '<div class="alert alert-success animated bounceInDown">
                      <button class="close" data-dismiss="alert" type="button">×</button>
                      <strong>Rebate has been Set to</strong> Php '.$_POST['rebateset'].'
                    </div>';
	 	//header("location:../index.php?display=settings");
	 }
	 else
	 {
	 	echo '<div class="alert alert-danger animated bounceInDown">
                      <button class="close" data-dismiss="alert" type="button">×</button>
                      <strong>Warning</strong> Something wrong.
                    </div>';
	 	//header("location:../index.php?display=settings");
	 }

}


	



?>