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
            Series
          </h1>
        </div>
        <div class="row animated fadeInDown">
          <div class="col-lg-12">
            <div class="widget-container fluid-height clearfix">
              <div class="heading">
                <i class="fa fa-desktop"></i>List of Series  <div class="pull-right">
              <a href="#" class="fa fa-undo" style="font-size:20px;" id="backcategory"></a>
              </div>
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
                    <th>
                      Downpayment
                    </th>

                    <th class="hidden-xs">
                      Actions
                    </th>
                  </thead>
                  <tbody>
                 
                     <?php
                        include 'db/connection.php';
                        $series = $dbConn->query("SELECT * FROM models");
                        while ($getseries = $series->fetch(PDO::FETCH_ASSOC)) 
                        {
                          # code...
                        
                        ?>
                          <tr>
                                  
                                    <td style="text-transform:uppercase;"><?php echo $getseries['category_name'];?></td>
                                    <td style="text-transform:uppercase;"><?php echo $getseries['model_name'];?></td>
                                    <td style="text-transform:uppercase;"><?php echo $getseries['price'];?></td>
                                    <td style="text-transform:uppercase;"><?php echo $getseries['downpayment'];?></td>
                                    <td style="text-transform:uppercase;"><a id="edit_series" href="javascript:void(0);" data-series="<?php echo $getseries['id'];?>"class="btn btn-primary">EDIT</a>
                                  </center></td>
                                    
                                    
                                    
                                 
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
      
      $("#backcategory").click(function()
      {
        $("#content").load("settings.php");
      });


      $(document).on("click", "#edit_series", function() 
      {
          var id = $(this).data("series");

          $.ajax(
          {
          type : "post",
          url : "editseries.php",
          
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