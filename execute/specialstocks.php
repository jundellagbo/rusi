<?php
session_start();
include '../db/connection.php';
if (isset($_POST['SUBMIT'])) 
{
	$checkstocks = $dbConn->query("SELECT * FROM stocks where chassis = '".$_POST['chassis']."' or engine_number = '".$_POST['engine_number']."' ");
	if ($checkstocks->rowCount() > 0) 
	{
	echo '<div class="alert alert-danger alert-dismissable animated bounceInDown">
                      <button type="button" class="close" data-dismiss="alert" >×</button>
                      <strong>ALREADY EXIST:</strong>  

                    </div>' ;
	}
	else
	{
		echo '<div class="alert alert-success animated bounceInDown">
                      <button class="close" data-dismiss="alert" type="button">×</button>
                     
                    
                      <strong>Stocks Added:</strong> '.$_POST['category_name'].','.$_POST['model_name'].','.$_POST['engine_number'].','.$_POST['chassis'].' 

                    </div>' ;
    
    
	 $insertstocks = $dbConn->query("INSERT INTO stocks (category_name,model_name,price,downpayment,color,engine_number,chassis,status,branch) VALUES ('".$_POST['category_name']."','".$_POST['model_name']."','".$_POST['price']."','".$_POST['downpayment']."','".$_POST['color']."','".$_POST['engine_number']."','".$_POST['chassis']."','SPECIAL','".$_POST['branchname']."')");
	
	}
}



?>