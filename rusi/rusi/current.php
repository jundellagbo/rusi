<link href="stylesheets/bootstrap.min.css" media="all" rel="stylesheet" type="text/css" />
    <link href="stylesheets/font-awesome.min.css" media="all" rel="stylesheet" type="text/css" /> 
    <link href="stylesheets/datatables.css" media="all" rel="stylesheet" type="text/css" /> 
    <link href="stylesheets/style.css" media="all" rel="stylesheet" type="text/css" /> 
   <script src="javascripts/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="javascripts/datatable-editable.js" type="text/javascript"></script>
     <link href="stylesheets/jquery.fancybox.css" media="all" rel="stylesheet" type="text/css" /> 
    <script src="javascripts/jquery.fancybox.pack.js" type="text/javascript"></script>
   
    <script src="javascripts/main.js" type="text/javascript"></script>
    <script src="javascripts/respond.js" type="text/javascript"></script> 
    <div class="animated fadeInDown">
        <div class="page-title">
          <h1>
            CURRENT ACCOUNTS
          </h1>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <div class="widget-container fluid-height clearfix">
              <div class="heading">
                <i class="fa fa-users"></i>Current Account Lists
              </div>
              <div class="widget-content padded clearfix">
                <table class="table table-bordered table-striped" id="dataTable1">
                  <thead>
                    <th hidden>
                     </th>
                    <th>
                      Customer ID
                    </th>
                    <th>
                      Current Owned Unit
                    </th>
                    <th class="hidden-xs">
                      Contract Price
                    </th>
                   
                    <th class="hidden-xs">
                      Status
                    </th>
                    <th>Action(S)</th>
                  </thead>
                  <tbody>
                 
                     <?php
                        include 'db/connection.php';
                        $accounts = $dbConn->query("SELECT * FROM accounts where status = 'current' ");
                        
                        while ($getaccounts = $accounts->fetch(PDO::FETCH_ASSOC)) 
                        {
                          # code...
                        
                        ?>
                        <tr>
                         <td hidden>
                           </td>
                        <td><?php echo $getaccounts['account_id'];?></td>
                          <td> <?php 
                                  $querymodel = $dbConn->query("SELECT * FROM stocks where model_id = '".$getaccounts['model_id']."' ");
                                  $dismodel = $querymodel->fetch(PDO::FETCH_ASSOC);
                                  if($dismodel['model_id'] == NULL) 
                                  { 
                                  echo 'NONE';
                                  }
                                  else
                                  {


                                  echo '<label style="text-transform:uppercase;">'.$dismodel['model_name'].'</label>'; 
                                  }
                                  ?></td>
                           <td><?php echo number_format($getaccounts['contract_price'],2);?></td>
                           <td><?php  if ($getaccounts['status'] == 'open') 
                                  {
                                    echo '<span class="label label-success">OPEN</span>';
                                  }
                                  elseif($getaccounts['status'] == 'current')
                                  {
                                    echo '<span class="label label-primary">CURRENT</span>';
                                   }
                                   else{
                                    echo '<span class="label label-danger">CLOSE</span>';
                                    } ?></td>
                          <td class="actions" style="font-size:20px;">
                        <div class="action-buttons">
                        <CENTER>
                        <?php  if ($getaccounts['status'] == 'open') 
                                  {
                                    echo '<a class="fa fa-edit" data-toggle="modal" href="#modal'.$getaccounts['account_id'].'"></a>';
                                  }
                                  
                                   else{
                                    echo '  <a class="fa fa-eye fancybox" href="#'.$getaccounts['account_id'].'"></a>';
                                    } ?></CENTER>
                         </div>
                         <div id="<?php echo $getaccounts['account_id'];?>" style="display: none" class="animated fadeIn">
                  <p style="font-size:39px;">
                    <?php echo $getaccounts['account_id'];?>
                  </p>
                  <p>
                  Status: <?php echo $getaccounts['status'];?><br>
                  Terms:  <?php echo $getaccounts['terms'];?><br>
                  Monthly Installment:  <?php echo number_format($getaccounts['monthly_installment'],2);?><br>
                  Total Paid:  <?php echo number_format($getaccounts['totalpaid'],2);?><br>
                  Deposit:  <?php echo number_format($getaccounts['deposit'],2);?><br>
                  Rebate:  <?php echo number_format($getaccounts['rebate'],2);?><br>
                  Contract Price:  <?php echo number_format($getaccounts['contract_price'],2);?><br>
                  Months:  <?php echo $getaccounts['months'];?><br>
                  Date payment:  <?php echo $getaccounts['datepayment'];?><br>


                    </p>
                </div>
                 <div class="modal fade" id="modal<?php echo $getaccounts['account_id'];?>">
                  <div class="modal-dialog" style="width:300px">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button aria-hidden="true" class="close" data-dismiss="modal" type="button">&times;</button>
                        <h4 class="modal-title">
                          Apply Unit
                        </h4>
                      </div>
                      <div class="modal-body">
                       
                        <p>
                          <i class="fa fa-warning"></i> Confirmation </p>
                      </div>
                      <div class="modal-footer">
                      <form id="applyunit" method="post">
                        <input type="hidden" value="<?php echo $getaccounts['account_id'];?>" id="proid">
                        <input type="submit" value="PROCEED" class="btn btn-primary"><button class="btn btn-danger-outline" data-dismiss="modal" type="button">Close</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                      </td>
                                 </tr>
                                 <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        </div>
        <!-- end DataTables Example -->
