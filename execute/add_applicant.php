<?php
include '../db/connection.php';

if (isset($_POST['SUBMIT'])) 
{
	$checkaccount = $dbConn->query("SELECT * FROM customerlists where firstname = '".$_POST['firstname']."' AND middlename = '".$_POST['middlename']."' AND lastname = '".$_POST['lastname']."' ");
	if ($checkaccount->rowCount() > 0) 
	{
		echo '<div class="alert alert-danger">
                      <button class="close" data-dismiss="alert" type="button">×</button>ACCOUNT ALREADY EXSIT!  
                     
                    </div>';
	}
	else
	{	
		
		
		$letter = 'CUSTOMERID';
				function numberletter() 
				{
						$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
						srand((double)microtime()*1000000);
						$i = 0;
						$passii = '' ;
						while ($i <= 8) {
							$num = rand() % 33;
							$tmp = substr($chars, $num, 1);
							$passii = $passii . $tmp;
							$i++;
						}
						return $passii;
				}
				$ccnumbers = numberletter();
				$confirmation = $letter.'-'.$ccnumbers;
				
		$insertacc = $dbConn->query("INSERT INTO customerlists(customerid,firstname,middlename,lastname,tin,address,contact,profile) VALUES ('".$confirmation."','".$_POST['firstname']."','".$_POST['middlename']."','".$_POST['lastname']."','".$_POST['tin']."','".$_POST['address']."','".$_POST['contact']."','".$_POST['uploadform']."') ");
		$insertaccs = $dbConn->query("INSERT INTO accounts (account_id,status) VALUES ('".$confirmation."','open')");
		
		echo '<div class="alert alert-success">
                      <button class="close" data-dismiss="alert" type="button">×</button>ACCOUNT CREATED!  
                     
                    </div>';

                    echo '';
	}
}




?>

<script>
	$(document).ready(function()
	{

		

	});

</script>