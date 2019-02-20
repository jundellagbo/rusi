<?php
session_start();
include 'db/connection.php';

extract($_POST);
  if(!empty($sid)) {

     $stmt = $dbConn->prepare("SELECT * FROM transaction WHERE customerid =:sid");
     $stmt->execute(array(":sid"=>$sid));
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      
  }


?>

          <div class="row"></div>
          
<div class="row animated bounceInRight">
<div class="col-lg-12">
            <div class="widget-container fluid-height clearfix">
              <div class="heading">
                <div class="pull-right">
              <a class="fa fa-undo hidden-print" id="backsettings" style="font-size:20px;">  </a></div>
              </div>

              <div class="widget-content padded clearfix"><a onclick="javascript:window.print();" class="btn btn-lg btn-teal hidden-print">
                  Print <i class="fa fa-print"></i>
                </a>

                </div>
               


              <center><h2>REPORTS</h2></center><BR>
                
                <?php 
                $getinfo = $dbConn->query("SELECT * FROM customerlists where customerid = '".$row['customerid']."' ");
                $disinfo = $getinfo->fetch(PDO::FETCH_ASSOC);
                ?>
                  <div class="widget-content padded clearfix">
                  <div class="row">
                 <div class="col-md-offset-2 col-md-5"><b>Customer ID:</b> <?php echo $row['customerid'];?></div><div class="col-md-4"><b>Customer Name:</b> <?php echo $disinfo['firstname'].' '.$disinfo['middlename'].' '.$disinfo['lastname'];?></div></div>
                 <div class="row">
                    <div class="col-md-offset-2 col-md-5"><b>Total Paid:</b> <?php 
                    $total = $dbConn->query("SELECT sum(total_paid) FROM transaction where customerid = '".$row['customerid']."' ");
                    $distotal = $total->fetch(PDO::FETCH_ASSOC);

                    echo number_format($distotal['sum(total_paid)'],2);
                    ?></div>
                 </div>

                </div>

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
                    $gettrans = $dbConn->query("SELECT * FROM transaction where customerid = '".$row['customerid']."' ");
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
                      <td style="text-transform:uppercase;"><?php 

                      $getmodel = $dbConn->query("SELECT * FROM stocks where model_id = '".$row['model_id']."' ");
                      $dismodel = $getmodel->fetch(PDO::FETCH_ASSOC);

                      echo $dismodel['category_name'].' - '.$dismodel['model_name'];

                      ?></td>
                      <td><?php echo $row['datepayment'];?></td>
                      <td><?php echo $row['total_paid'];?></td>
                   </tr>

                   <?PHP }}?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <script>
            $(document).ready(function () 
        { 

            $("#backsettings").click(function (e) 
     { 
        $("#content").load("overdue.php");
     });
        });
          </script>