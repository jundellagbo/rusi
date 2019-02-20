<?php
include '../db/connection.php';
session_start();
if (isset($_POST['SUBMIT'])) 
{
	$insertnewterms = $dbConn->query("UPDATE accounts SET terms = '".$_POST['numberterms']."',monthly_installment = '".$_POST['newmon']."',contract_price = '".$_POST['grand']."',months = '0',datepayment = '".date("Y-m-d")."' where account_id = '".$_SESSION['id']."' ");
	if ($insertnewterms) 
	{
		echo '<div class="alert alert-success animated bounceInDown">
                      <button class="close" data-dismiss="alert" type="button">×</button>Successfully! Change Terms 
                      
                    </div>';
	}
}

?>