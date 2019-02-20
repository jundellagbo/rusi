<link href="stylesheets/bootstrap.min.css" media="all" rel="stylesheet" type="text/css" />
    <link href="stylesheets/font-awesome.min.css" media="all" rel="stylesheet" type="text/css" /> 
    <link href="stylesheets/datatables.css" media="all" rel="stylesheet" type="text/css" /> 
    <link href="stylesheets/style.css" media="all" rel="stylesheet" type="text/css" /> 
   <script src="javascripts/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="javascripts/datatable-editable.js" type="text/javascript"></script>
    
    <script src="javascripts/main.js" type="text/javascript"></script>
    <script src="javascripts/respond.js" type="text/javascript"></script> 
    <div id="msg1"></div>
    <div id="stocks11">
        <div class="page-title">
          <h1>
            Stocks
          </h1>
        </div>
        <div class="row animated fadeInDown">
          <div class="col-lg-12">
            <div class="widget-container fluid-height clearfix">
              <div class="heading">
                <i class="fa fa-desktop"></i>List of Stocks 
              </div>
              <div class="widget-content padded clearfix">
                <table class="table table-bordered table-striped" id="dataTable1">
                  <thead>
                   
                   
                    <th>
                      Category Name
                    </th>
                    <th class="hidden-xs">
                      Model Name
                    </th>
                   
                    <th class="hidden-xs">
                      Price
                    </th>
                    <th hidden>
                      Downpayment
                    </th>
                    <th hidden>
                      Color
                    </th>
                    <th class="hidden-xs">
                      Engine Number
                    </th>
                    <th class="hidden-xs">
                      Chassis
                    </th>
                    <th class="hidden-xs">
                      Status
                    </th>

                    <th hidden>
                      Branch
                    </th>

                    <th class="hidden-xs">
                      Actions
                    </th>
                  </thead>
                  <tbody>
                 
                     <?php
                        include 'db/connection.php';
                        $accounts = $dbConn->query("SELECT * FROM stocks where status != 'sold' || price = '0.00' ");
                        while ($getaccounts = $accounts->fetch(PDO::FETCH_ASSOC)) 
                        {
                          # code...
                        
                        ?>
                          <tr>
                                   <td><?php echo $getaccounts['category_name'];?></td>
                                  <td><a href="#<?php echo $getaccounts['model_id'];?>" class="fancybox"><?php echo $getaccounts['model_name'];?></a>  </td>
                                  <td><?php echo number_format($getaccounts['price'],2);?></td>
                                   <td hidden><?php echo number_format($getaccounts['downpayment'],2);?></td>
                                    <td style="text-transform:uppercase;" hidden><?php echo $getaccounts['color'];?></td>
                                    <td style="text-transform:uppercase;"><?php echo $getaccounts['engine_number'];?></td>
                                    <td style="text-transform:uppercase;"><?php echo $getaccounts['chassis'];?></td>
                                    <td><?php if ($getaccounts['status'] == 'sold' ) 
                                    {
                                      echo '<span class="label label-danger">SOLD</span>';
                                    }
                                    else if ($getaccounts['status'] == 'repo' ) 
                                    {
                                     echo '<span class="label label-warning">REPO</span>';
                                    }
                                    else
                                    {
                                      echo '<span class="label label-success">NEW</span>';
                                    }
                                    ?></td>
                                    <td style="text-transform:uppercase;" hidden><?php echo $getaccounts['branch'];?></td>
                                    <td style="text-transform:uppercase;"><center><?php 
                                    if ($getaccounts['price'] == '0.00') 
                                    {
                                      echo '<span class="fa fa-ban"></span>';
                                    }
                                    else{
                                      echo '<button class="btn btn-primary" id="apply_unit" href="javascript:void(0);" data-apply="'.$getaccounts['model_id'].'">APPLY</button>';
                                    }
                                    ?></center></td>
                                    <div id="<?php echo $getaccounts['model_id'];?>" style="display: none">
                                    <h2></h2>
                                    <p>
                                    Status: <?php echo $getaccounts['color'];?><br>
                                    Downpayment: <?php echo $getaccounts['downpayment'];?><br>
                                    </p>

                                    </div>

                                    
                                    
                                 
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
        </div></div>
        <!-- end DataTables Example -->

          <script>
    $(document).ready(function()
    {
      

      $(document).on("click", "#apply_unit", function() 
      {
          var id = $(this).data("apply");

          $.ajax(
          {
          type : "post",
          url : "getapply.php",
          
          data : {sid : id},
          success : function(data)
            {
              $("#stocks11").hide();
              $("#msg1").html(data);

            }

          });
        return false;
      })
    });
    </script>