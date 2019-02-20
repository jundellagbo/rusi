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
    <div id="display"></div>
    <div class="animated fadeInDown " id="accounthide">
        <div class="page-title">
          <h1>
            ALL ACCOUNTS
          </h1>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <div class="widget-container fluid-height clearfix">
              <div class="heading">
                <i class="fa fa-users"></i>Account Lists
              </div>
              <div class="widget-content padded clearfix">
                <table class="table table-bordered table-striped" id="dataTable1">
                  <thead>
                    <th  hidden>
                       </th>
                    <th>
                      Customer ID
                    </th>
                    <th hidden></th>
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
                        $accounts = $dbConn->query("SELECT * FROM accounts");
                        
                        while ($getaccounts = $accounts->fetch(PDO::FETCH_ASSOC)) 
                        {
                          # code...
                        
                        ?>
                        <tr>
                         <td hidden>
                        </td>
                        <td><a href="#dis<?php echo $getaccounts['account_id'];
                        ?>" class="fancybox"><?php echo $getaccounts['account_id'];
                        ?></a></td>

                        <td hidden><?php $displayname = $dbConn->query("SELECT * FROM customerlists where customerid = '".$getaccounts['account_id']."' ");
                        $getname = $displayname->fetch(PDO::FETCH_ASSOC);
                        echo $getname['firstname'].' '.$getname['lastname'];
                        ?></td>
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
                                    echo '<a class="fa fa-edit" id="edit_accounts" data-accounts="'.$getaccounts['account_id'].'" href="#"></a>';
                                  }
                                  
                                   else{
                                    echo '  <a class="fa fa-eye fancybox" href="#'.$getaccounts['account_id'].'"></a> <a class="fa fa-edit" id="edit_accounts" data-accounts="'.$getaccounts['account_id'].'" href="#"></a>';
                                    } ?></CENTER>
                         </div>
                         <div id="<?php echo $getaccounts['account_id'];?>" style="display: none">
                  <p style="font-size:40px;">
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
                <?php 
                  $modal = $dbConn->query("SELECT * FROM customerlists");
                  while ( $displaymodal = $modal->fetch(PDO::FETCH_ASSOC)) {
                    # code...
                  
                ?>
                <div id="dis<?php echo $displaymodal['customerid'];?>" style="display: none">
                  <p style="font-size:40px;">
                    <?php echo $displaymodal['customerid'];?>
                  </p>
                  <p>
                  Name: <?php echo $displaymodal['firstname'].' '. $displaymodal['lastname'];?><br>
                  Address: <?php echo $displaymodal['address'];?><br>
                  Contact: <?php echo $displaymodal['contact'];?><br>
                  Tin: <?php echo $displaymodal['tin'];?><br>
                  

                  

                  


                    </p>
                </div>

                <?php } ?>
             <!--     <div class="modal fade" id="modal<?php echo $getaccounts['account_id'];?>">
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
                </div> -->
                      </td>
                                 </tr>
                                 <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div></div>
        <!-- end DataTables Example -->
<script>
  $(document).ready(function()
    {
      

      $(document).on("click", "#edit_accounts", function() 
      {
          var id = $(this).data("accounts");

          $.ajax(
          {
          type : "post",
          url : "getunit.php",
          
          data : {sid : id},
          success : function(data)
            {
              $("#accounthide").hide();
              $("#display").html(data);

            }

          });
        return false;
      })
    });

</script>