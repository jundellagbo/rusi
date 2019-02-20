<?php
session_start();
include '../db/connection.php';

if (isset($_POST['SUBMIT'])) 
{

	$checks = $dbConn->query("SELECT * FROM models where category_name = '".$_POST['choose_cats']."' and model_name='".$_POST['model_name']."' ");
	
	if ($checks->rowCount() > 0) 
	{
		echo '<div class="alert alert-danger animated shake">
                      <button class="close" data-dismiss="alert" type="button">×</button>
                      <strong>Warning!</strong> Already Exist! '.$_POST['model_name'].'
                    </div>';
		//header("location:../?display=settings");
	}
	else
	{
		if ($_POST['model_price'] > $_POST['model_down']) 
		{
			echo '<div class="alert alert-success animated bounceInDown">
                      <button class="close" data-dismiss="alert" type="button">×</button>
                      <strong>Success!</strong> Model name added: '.$_POST['model_name'].' to '.$_POST['choose_cats'].'
                    </div>';
        $dbConn->query("INSERT INTO models (category_name,model_name,price,downpayment) VALUES ('".$_POST['choose_cats']."','".strtolower($_POST['model_name'])."','".$_POST['model_price']."','".$_POST['model_down']."')");
		//header("location:../?display=settings");
		 $activity  = 'ADDING MODEL: '.$_POST['model_name'].' ';

			$insertact = $dbConn->query("INSERT INTO logs (activity,user_id) VALUES ('".$activity."','".$_SESSION['username']."')");	

		}
		else
		{
			echo '<div class="alert alert-danger animated bounceInDown">
                      <button class="close" data-dismiss="alert" type="button">×</button>
                      <strong>Warning!</strong> Downpayment is greater than price
                    </div>';
        
		//header("location:../?display=settings");
	
		}
		} 
}


?>