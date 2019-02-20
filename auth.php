<?php
	//Start session
	session_start();
	
	//Check whether the session variable username is present or not
	if(!isset($_SESSION['username']) || (trim($_SESSION['username']) == '')) {
		header("location: login.php");
		$_SESSION['error'] = '<div class="alert alert-red">
                      <strong>ERROR!</strong> Please input <em>Username</em> and <em>password</em>.
                    </div>';
	}
?>