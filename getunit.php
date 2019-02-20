<?php include("db/connection.php"); ?>
<?php
	extract($_POST);
	if(!empty($sid)) {

		 $stmt = $dbConn->prepare("SELECT * FROM accounts WHERE account_id =:sid");
 		 $stmt->execute(array(":sid"=>$sid));
  		$row = $stmt->fetch(PDO::FETCH_ASSOC);
  		

  		session_start();

  		$_SESSION['id'] = $sid;
	}

  

?>



<div id="closeform"></div>
<div class="page-title">
          <h1>
            ACCOUNT SETTINGS
          </h1>
        </div>
<div class="animated fadeInDown" id="unit">
<div class="row hidden-print" style="margin:0px 300px 0px;">
          <div class="col-md-12">
            <div class="widget-container fluid-height">
              <div class="heading">
                <span class="fa fa-bar-chart-o"></span>SETTINGS
              </div>
              <div class="widget-content padded">

              <?php 
              	if ($row['status'] == 'current') 
              	{
              		# code...
              	
              ?>

              <center><button id="changeterms" class="btn btn-success btn-lg" >CHANGE TERMS</button><button id="closeaccount" class="btn btn-danger btn-lg" >CLOSE ACCOUNT</button></center>
              
              <?php 
              }
              else
              {
               ?>
               <center><button id="applyunit" class="btn btn-primary btn-lg" >APPLY UNIT</button></center>
               <?php }?>

              </div>
            </div>
          </div>
</div>
</div>
         
        <script>
        $(document).ready(function  ()
        {
          
          $("#closeaccount").on("click",function()
          {
          	$("#closeform").load("closeform.php");
          })
          $("#changeterms").on("click",function()
          {
            $("#closeform").load("changeterms.php");
          })

          $("#applyunit").on("click",function()
          {
          	$("#content").load("applyunit.php");
          })

        });

        </script>
