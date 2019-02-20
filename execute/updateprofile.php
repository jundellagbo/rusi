<?php

session_start();

include '../db/connection.php';
if (isset($_POST['SUBMIT'])) 
{


$checkcat = $dbConn->query("SELECT * FROM customerlists where id = '".$_POST['profile_id']."' ");
$row = $checkcat->fetch(PDO::FETCH_ASSOC);




		echo '<div class="alert alert-success animated bounceInDown">
                      <button class="close" data-dismiss="alert" type="button">×</button>
                     
                     <strong>SUCCESS!!!</strong> Successfully updated. 
                    
                    </div>';

          $newupdate = '<h3>'.date("M d Y").' Updated by '.$_SESSION['fullname'].'</h3><br>'.$_POST['uploadform'].'<br>'.$row['profile'];

    $dbConn->query("UPDATE customerlists SET profile = '".$newupdate."' where id = '".$_POST['profile_id']."' ");
       
                  
	
}
?>