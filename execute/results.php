<?php
session_start();
include '../db/connection.php';

// if (isset($_POST['SUBMIT'])) 
// {
// 	if ($_POST['search_name'] == 'category_name') 
// 	{
// 		$category_name = $dbConn->query("SELECT * FROM categories where category_name = '".$_POST['searchcat']."' ");
		
// 	}
// 	else
// 	{

// 	}
// }


?>

          <div class="row"></div>
          
<div class="row animated bounceInRight">
<div class="col-lg-12">
            <div class="widget-container fluid-height clearfix">
              <div class="heading">
                <i class="fa fa-calendar"></i>Reports
              </div>

              <div class="widget-content padded clearfix"><a onclick="javascript:window.print();" class="btn btn-lg btn-teal hidden-print">
									Print <i class="fa fa-print"></i>
								</a>
              <center><h2>REPORTS</h2></center><BR>
              <center><h3>From: <?php echo $_POST['datefrom']; ?> To <?php echo $_POST['dateto']; ?></h3></center>
                <table class="table table-bordered">
                  <thead>
                    <tr><th>
                      Transaction ID
                    </th>
                    <th>
                      Customer ID
                    </th>
                    <th>
                      Model Name
                    </th>
                    <th class="hidden-xs">
                      Date Payment
                    </th>
                    <th class="hidden-xs">
                      Total Paid
                    </th>
                  </tr></thead>
                  <tbody>
               		<?php 
               			include '../db/connection.php';
               			$gettrans = $dbConn->query("SELECT * FROM transaction where datepayment BETWEEN '".$_POST['datefrom']."' AND '".$_POST['dateto']."' ");
                    if ($gettrans->rowCount() == 0) 
                    {
                      echo "<tr><td colspan='5'><center><b>NO RECORDS FOUND</b></center></td></tr>";
                    }
                    else
                    {
               			while ($row = $gettrans->fetch(PDO::FETCH_ASSOC)) 
               			{
               				
               			
               		?>
                   <tr>
                   		<td><?php echo $row['trans_id'];?></td>
                   		<td><?php echo $row['customerid'];?></td>
                   		<td><?php echo $row['model_id'];?></td>
                   		<td><?php echo $row['datepayment'];?></td>
                   		<td><?php echo $row['total_paid'];?></td>
                   </tr>

                   <?PHP }}?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          </div>