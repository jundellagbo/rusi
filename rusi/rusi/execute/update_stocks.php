<?php
session_start();
include '../db/connection.php';

if (isset($_POST['submit'])) 
{

	

	  
	 $updateusers = $dbConn->query("UPDATE stocks SET category_name = '".$_POST['category_name']."',model_name = '".$_POST['model_name']."',color = '".$_POST['color']."',engine_number = '".$_POST['engine_number']."',chassis = '".$_POST['chassis']."' where model_id = '".$_POST['model_id']."' ");

	  if ($updateusers) 
	  {
	  	echo '<div class="alert alert-success">
                      <button class="close" data-dismiss="alert" type="button">×</button>Success! Updated 
                     
                    </div>';
	  }
	  else
	  {
	  	echo '<div class="alert alert-danger">
                      <button class="close" data-dismiss="alert" type="button">×</button>Error!  
                    </div>';
	  }
	

}

?>