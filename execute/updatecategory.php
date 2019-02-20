<?php

session_start();

include '../db/connection.php';
if (isset($_POST['submit'])) 
{
$checkcat = $dbConn->query("SELECT * FROM categories where category_name = '".$_POST['category_name']."' AND id != '".$_POST['categoryid']."'");

	if ($checkcat->rowCount() > 0) 
	{
	echo '<div class="alert alert-danger animated shake">
                      <button class="close" data-dismiss="alert" type="button">×</button>
                      <strong>Warning!</strong> Category Name Already Exist
                    </div>';
	}
	else
	{
		echo '<div class="alert alert-success animated bounceInDown">
                      <button class="close" data-dismiss="alert" type="button">×</button>
                     
                     <strong>SUCCESS!!!</strong> Successfully updated.
                    
                    </div>' ;

                    $dbConn->query("UPDATE categories SET category_name = '".$_POST['category_name']."' where id = ".$_POST['categoryid']." ");
  
	}
}
?>