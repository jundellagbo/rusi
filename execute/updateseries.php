<?php

session_start();

include '../db/connection.php';
if (isset($_POST['submit'])) 
{
$checkcat = $dbConn->query("SELECT * FROM models where category_name = '".$_POST['category_name']."' AND model_name = '".$_POST['model_name']."' AND id != '".$_POST['model_id']."' ");

	if ($checkcat->rowCount() > 0) 
	{
	echo '<div class="alert alert-danger animated shake">
                      <button class="close" data-dismiss="alert" type="button">×</button>
                      <strong>Error!</strong> Category Name and Model Name is already Exist.
                    </div>';
	}
	else
	{
		echo '<div class="alert alert-success animated bounceInDown">
                      <button class="close" data-dismiss="alert" type="button">×</button>
                     
                     <strong>SUCCESS!!!</strong> Successfully updated.
                    
                    </div>' ;

    	$dbConn->query("UPDATE models SET category_name = '".$_POST['category_name']."',model_name = '".$_POST['model_name']."' where id = '".$_POST['model_id']."' ");            
  	
	}
}
?>