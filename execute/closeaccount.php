<?php
include '../db/connection.php';
session_start();

$getmodel = $dbConn->query("SELECT * FROM accounts where account_id = '".$_SESSION['id']."' ");
$dismodel = $getmodel->fetch(PDO::FETCH_ASSOC);

$dbConn->query("UPDATE stocks SET price = '0',downpayment = '0', status = 'repo' where model_id = '".$dismodel['model_id']."' ");

$close = $dbConn->query("UPDATE accounts SET model_id = ' ',status = 'open',terms =' ',monthly_installment = '',contract_price = '0',months ='0',datepayment = '0000-00-00',downpayment = '0' where account_id = '".$_SESSION['id']."' ");


$dbConn->query("INSERT INTO history (account_id,model_id,status) VALUES ('".$_SESSION['id']."','".$dismodel['model_id']."','CLOSE')");

if ($close) 
{
	echo '<div class="alert alert-success animated bounceInDown">
                      <button class="close" data-dismiss="alert" type="button">×</button>Successfully! Close Account 
                      
                    </div>';
}

?>