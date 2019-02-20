<?php include("db/connection.php"); ?>
<?php
	extract($_POST);
	if(!empty($sid)) {

		 $stmt = $dbConn->prepare("SELECT * FROM models WHERE  category_name =:sid");
 		 $stmt->execute(array(":sid"=>$sid));
  		
  		
  		
  		echo "<option value=''>PLEASE CHOOSE</option>";

  		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) 
  		{
  			echo "<option value='".$row['model_name']."'>".$row['model_name']."</option>";
  		}
  			
	}
?>