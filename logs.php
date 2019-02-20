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
            USER LOGS
          </h1>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <div class="widget-container fluid-height clearfix">
              <div class="heading">
                <i class="fa fa-desktop"></i>Activity Logs
              </div>
              <div class="widget-content padded clearfix">
                <table class="table table-bordered table-striped" id="dataTable1">
                  <thead>
                   
                   
                    <th>
                      Activity
                    </th>
                    <th class="hidden-xs">
                      Date / Time
                    </th>
                   
                    <th class="hidden-xs">
                      User
                    </th>
                    
                  </thead>
                  <tbody>
                 
                     <?php
                        include 'db/connection.php';
                        $accounts = $dbConn->query("SELECT * FROM logs");
                        while ($getaccounts = $accounts->fetch(PDO::FETCH_ASSOC)) 
                        {
                          # code...
                        
                        ?>
                          <tr>
                                   <td><?php echo $getaccounts['activity'];?></td>
                                  <td><?php echo $getaccounts['date'];?></td>
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
        </div></div>
        <!-- end DataTables Example -->