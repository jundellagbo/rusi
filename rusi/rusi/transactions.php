<link href="stylesheets/bootstrap.min.css" media="all" rel="stylesheet" type="text/css" />
    <link href="stylesheets/font-awesome.min.css" media="all" rel="stylesheet" type="text/css" /> 
    <link href="stylesheets/datatables.css" media="all" rel="stylesheet" type="text/css" /> 
    <link href="stylesheets/style.css" media="all" rel="stylesheet" type="text/css" /> 
   <script src="javascripts/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="javascripts/datatable-editable.js" type="text/javascript"></script>
    
    <script src="javascripts/main.js" type="text/javascript"></script>
    <script src="javascripts/respond.js" type="text/javascript"></script> 
    <div class="animated fadeInDown">
        <div class="page-title">
          <h1>
            Transactions
          </h1>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <div class="widget-container fluid-height clearfix">
              <div class="heading">
                <i class="fa fa-table"></i>Transactions
              </div>
              <div class="widget-content padded clearfix">
                <table class="table table-bordered table-striped" id="dataTable1">
                  <thead>
                   
                   
                    <th>
                      Transaction ID
                    </th>
                    <th class="hidden-xs">
                      Customer ID
                    </th>
                   
                    <th class="hidden-xs">
                      Model
                    </th>
                    <th class="hidden-xs">
                      Date Payment
                    </th>
                    <th class="hidden-xs">
                      Total Paid
                    </th>
                    <th>
                    User ID
                    </th>
                  </thead>
                  <tbody>
                 
                     <?php
                        include 'db/connection.php';
                        $accounts = $dbConn->query("SELECT * FROM transaction");
                        while ($getaccounts = $accounts->fetch(PDO::FETCH_ASSOC)) 
                        {
                          # code...
                        
                        ?>
                          <tr>
                                   <td><?php echo $getaccounts['trans_id'];?></td>
                                  <td><?php echo $getaccounts['customerid'];?></td>
                                  <td style="text-transform:uppercase;"><?php  
                                  $getmodel = $dbConn->query("SELECT * FROM models where id = '".$getaccounts['model_id']."' ");
                                  $dismodel = $getmodel->fetch(PDO::FETCH_ASSOC);
                                  echo  $dismodel['model_name'];
                       ?></td>
                                  <td><?php echo $getaccounts['datepayment'];?></td>
                                  <td><?php echo number_format($getaccounts['total_paid'],2);?></td>
                                  <td><?php echo $getaccounts['user_id'];?></td>




                                 
                          </tr>
                         
                        <?php 
                        }
                        ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <!-- end DataTables Example -->