<?php
session_start();
include '../db/connection.php';


if (isset($_POST['SUBMIT'])) 
{
$checkuser = $dbConn->query("SELECT * FROM users where username = '".$_POST['username']."' and password = '".$_POST['password']."' ");
$row_users = $checkuser->fetch(PDO::FETCH_ASSOC);
if ($checkuser->rowCount() > 0) 
{
$_SESSION['username'] = $_POST['username'];
$_SESSION['type'] = $row_users['type'];
$_SESSION['fullname'] = $row_users['firstname'].' '.$row_users['lastname'];
$_SESSION['picture'] =  $row_users['picture'];
$_SESSION['branch'] =$row_users['branchid'];

    if ($row_users['status'] == 'active') 
    {
    
      echo "1";
    
    }
    else
    {
     echo '<div class="alert alert-danger animated shake">
                      <button class="close" data-dismiss="alert" type="button">×</button>INVALID! YOUR ACCOUNT IS DISABLED 
                     
                    </div>' ;
    }

}
else
{
 echo '<div class="alert alert-danger animated shake">
                      <button class="close" data-dismiss="alert" type="button">×</button>INVALID! USERNAME OR PASSWORD 
                     
                    </div>';
}

}

?>