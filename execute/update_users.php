<?php
session_start();
include '../db/connection.php';

if (isset($_POST['submit'])) 
{

	

	  
	 $updateusers = $dbConn->query("UPDATE users SET firstname = '".$_POST['firstname']."',lastname = '".$_POST['lastname']."',middlename = '".$_POST['middlename']."',contact = '".$_POST['contact']."',type = '".$_POST['accounttype']."',status = '".$_POST['status']."',branchid = '".$_POST['branch']."' where username = '".$_POST['username']."' ");

	  if ($updateusers) 
	  {
	  	echo '<div class="alert alert-success">
                      <button class="close" data-dismiss="alert" type="button">×</button>Success! Updated Username'.$_POST['username'].'
                     
                    </div>';
	  }
	  else
	  {
	  	echo '<div class="alert alert-danger">
                      <button class="close" data-dismiss="alert" type="button">×</button>Error!  Username'.$username.'
                     
                    </div>';
	  }
	

}

?>