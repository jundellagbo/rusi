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
            ACCOUNT HISTORY
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
                    <th hidden>
                     
                    </th>
                    <th>
                      Customer ID
                    </th>
                    <th>
                      Unit
                    </th>
                  
                  </thead>
                  <tbody>
                 
                     <?php
                        include 'db/connection.php';
                        $accounts = $dbConn->query("SELECT * FROM sold_items ");
                        
                        while ($getaccounts = $accounts->fetch(PDO::FETCH_ASSOC)) 
                        {
                          # code...
                        
                        ?>
                        <tr>
                         <td hidden>
                         </td>
                        <td><a id="get_account" href="javascript:void(0);" data-history="<?php echo $getaccounts['customer_id']; ?>"><?php echo $getaccounts['customer_id'];?></a></td>
                          <td style="text-transform:uppercase;"> <?php echo $getaccounts['category_name'].' '.$getaccounts['model_name'];
                        ?></td>
                                 </tr>
                                 <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div></div>
         <script>
    $(document).ready(function()
    {
      

      $(document).on("click", "#get_account", function() 
      {
          var id = $(this).data("history");
          $.ajax(
          {
          type : "post",
          url : "gethistory.php",
          
          data : {sid : id},
          success : function(data)
            {

              $("#content").html(data);
              
            }

          });
        return false;
      })
    });
    </script>
        <!-- end DataTables Example -->
