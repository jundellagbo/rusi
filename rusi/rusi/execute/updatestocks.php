<?php

include '../db/connection.php';

if (isset($_POST['SUBMIT'])) 
{

	$update = $dbConn->query("UPDATE stocks SET price = '".$_POST['newprice']."',downpayment = '".$_POST['newdownpayment']."' where model_id = '".$_POST['updateid']."'  ");
	if ($update) 
	{
		echo '<div class="alert alert-success">
                      <button class="close" data-dismiss="alert" type="button">×</button>Success! Updated Stocks
                     
                    </div>';
	}
}

?>