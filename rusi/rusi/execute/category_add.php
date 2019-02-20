<?php
session_start();
include '../db/connection.php';

if (isset($_POST['SUBMIT'])) 
{

	$checkcategory = $dbConn->query("SELECT * FROM categories where category_name = '".$_POST['category_name']."' ");
	if ($checkcategory->rowCount() > 0) 
	{
		 echo '<div class="alert alert-danger animated shake">
                      <button class="close" data-dismiss="alert" type="button">×</button>
                      <strong>Category Name Exist:</strong> '.$_POST['category_name'].'
                    </div>' ;
		//header("location:../?display=settings");
	}
	else
	{
			
		$insertcat = $dbConn->query("INSERT INTO categories (category_name) VALUES ('".strtolower($_POST['category_name'])."')");
		 $activity  = 'ADDING CATEGORIES: '.$_POST['category_name'].' ';

			$insertact = $dbConn->query("INSERT INTO logs (activity,user_id) VALUES ('".$activity."','".$_SESSION['username']."')");	

		if ($insertcat) 
		{
			echo '<div class="alert alert-success animated bounceInDown">
                      <button class="close" data-dismiss="alert" type="button">×</button>
              
                      <strong>Category Name Added:</strong> '.$_POST['category_name'].'
                    </div>' ;
			//header("location:../?display=settings");
		}
		else
		{
			echo '<div class="alert alert-danger animated shake">
                      <button class="close" data-dismiss="alert" type="button">×</button>
              
                      <strong>Something Wrong :</strong>
                    </div>' ;
			//header("location:../?display=settings");
		}

	}

}


?>