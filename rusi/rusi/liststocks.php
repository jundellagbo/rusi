<link href="stylesheets/bootstrap.min.css" media="all" rel="stylesheet" type="text/css" />
    <link href="stylesheets/font-awesome.min.css" media="all" rel="stylesheet" type="text/css" /> 
    <link href="stylesheets/datatables.css" media="all" rel="stylesheet" type="text/css" /> 
    <link href="stylesheets/style.css" media="all" rel="stylesheet" type="text/css" /> 
   <script src="javascripts/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="javascripts/datatable-editable.js" type="text/javascript"></script>
    
    <script src="javascripts/main.js" type="text/javascript"></script>
    <script src="javascripts/respond.js" type="text/javascript"></script> 
    <div id="msg"></div><div id="stocks1">
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
                        $accounts = $dbConn->query("SELECT * FROM stocks");
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
                                    <td style="text-transform:uppercase;"><?php if ($getaccounts['status'] == 'sold' ) 
                                    {
                                      echo '<span class="label label-danger">SOLD</span>';
                                    }
                                    else
                                    {
                                      echo '<span class="label label-success">'.$getaccounts['status'].'</span>';
                                    }
                                    ?></td>
                                    <td style="text-transform:uppercase;" hidden><?php echo $getaccounts['branch'];?></td>
                                    <td style="text-transform:uppercase;font-size:20px;"><center><?php if ($getaccounts['status'] == 'sold' ) 
                                    {
                                      echo '<span class="fa fa-ban"></span>';
                                    }
                                    else
                                    {
                                      echo '<a id="edit_student" href="javascript:void(0);" data-stocks="'.$getaccounts['model_id'].'"class="fa fa-edit"></a>';
                                    }
                                    ?></center></td>
                                    <div id="<?php echo $getaccounts['model_id'];?>" style="display: none">
                                    <h2></h2>
                                    <p>
                                    Color: <?php echo $getaccounts['color'];?><br>
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
      

      $(document).on("click", "#edit_student", function() 
      {
          var id = $(this).data("stocks");

          $.ajax(
          {
          type : "post",
          url : "getstocks.php",
          
          data : {sid : id},
          success : function(data)
            {
              $("#stocks1").hide();
              $("#msg").html(data);

            }

          });
        return false;
      })
    });
    </script>