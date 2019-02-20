<?php

session_start();

include '../db/connection.php';
if (isset($_POST['SUBMIT'])) 
{
$checkcat = $dbConn->query("SELECT * FROM customerlists where firstname = '".$_POST['firstname']."' AND middlename = '".$_POST['middlename']."' AND lastname = '".$_POST['lastname']."'  AND id != '".$_POST['infoid']."' ");

	if ($checkcat->rowCount() > 0) 
	{
	echo '<div class="alert alert-danger animated shake">
                      <button class="close" data-dismiss="alert" type="button">×</button>
                      <strong>Warning!</strong> Profile Already Exist.
                    </div>';
	}
	else
	{
		echo '<div class="alert alert-success animated bounceInDown">
                      <button class="close" data-dismiss="alert" type="button">×</button>
                     
                     <strong>SUCCESS!!!</strong> Successfully updated.
                    
                    </div>';

        $dbConn->query("UPDATE customerlists SET firstname = '".$_POST['firstname']."',middlename = '".$_POST['middlename']."',lastname = '".$_POST['lastname']."',tin = '".$_POST['tin']."',address = '".$_POST['address']."',contact = '".$_POST['contact']."' where id = '".$_POST['infoid']."'");
                  
	}
}
?>