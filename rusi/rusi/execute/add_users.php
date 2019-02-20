<?php
session_start();
include '../db/connection.php';

if (isset($_POST['submit'])) 
{

	 $firstname 	= $_POST['firstname'];
	 $middlename = $_POST['middlename'];
	 $lastname	= $_POST['lastname'];
	 $username	= $_POST['username'];
	 $password	= $_POST['password'];
	 $contact 	= $_POST['contact'];
	 $branch	= $_POST['branch'];
	 $accounttype= $_POST['accounttype'];
	 $status	= "active";

	  $checkexist= $dbConn->query("SELECT * FROM users where username = '".$username."'");
		

	  if($checkexist->rowCount() > 0)
	  {

	  	echo '<div class="alert alert-big alert-danger animated shake">
	  		 <h1 style="font-family:verdana;"><strong>USERNAME EXIST PLEASE FILL UP THE FORM AGAIN.</strong> </h1>
	  		</div>
	  	';
	  }
	  else
	  {
	  		  $activity  = 'ADDING USERS: '.$_POST['username'].' ';

			$insertact = $dbConn->query("INSERT INTO logs (activity,user_id) VALUES ('".$activity."','".$_SESSION['username']."')");	

			$query1	= $dbConn->query("INSERT INTO users(username,password,firstname,middlename,lastname,contact,type,branchid,status) VALUES ('".$username."','".$password."','".$firstname."','".$middlename."','".$lastname."','".$contact."','".$accounttype."','".$branch."','".$status."') ");

			if ($query1) 
			{
			echo '

			<div class="alert alert-success animated bounceInDown">
                      <button class="close" data-dismiss="alert" type="button">×</button>Successfully Added. Username: '.$username.'
                     
                    </div>
					';
			}
			else
			{
			echo '';
			}	  	
	  }


	

}

?>