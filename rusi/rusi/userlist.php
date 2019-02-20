<link href="stylesheets/bootstrap.min.css" media="all" rel="stylesheet" type="text/css" />
    <link href="stylesheets/font-awesome.min.css" media="all" rel="stylesheet" type="text/css" /> 
    <link href="stylesheets/datatables.css" media="all" rel="stylesheet" type="text/css" /> 
    <link href="stylesheets/style.css" media="all" rel="stylesheet" type="text/css" /> 
   <script src="javascripts/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="javascripts/datatable-editable.js" type="text/javascript"></script>
    
    <script src="javascripts/main.js" type="text/javascript"></script>
    <script src="javascripts/respond.js" type="text/javascript"></script> 
    <div id="msg"></div>
    <div class="animated fadeInDown">
        <div class="page-title">
          <h1>
            ALL USERS
          </h1>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <div class="widget-container fluid-height clearfix">
              <div class="heading">
                <i class="fa fa-user"></i>Users List
              </div>
              <div class="widget-content padded clearfix">
                <table class="table table-bordered table-striped" id="dataTable1">
                  <thead>
                    <th class="check-header hidden">
                      <label><input id="checkAll" name="checkAll" type="checkbox"><span></span></label>
                    </th>
                    <th>
                     Employee Name
                    </th>
                    <th>
                      Username
                    </th>
                    <th class="hidden-xs">
                      Branch Assign
                    </th>
                   
                    <th class="hidden-xs">
                      Status
                    </th>
                    <th>Action(S)</th>
                  </thead>
                  <tbody>
                 
                      <?php
                        include 'db/connection.php';
                        $models = $dbConn->query("SELECT * FROM users where branchid != 'any' ");
                        while ($get_models= $models->fetch(PDO::FETCH_ASSOC)) 
                        {
                          # code...
                        
                        ?>
                        <tr>
                         <td class="check hidden">
                        <label><input name="optionsRadios1" type="checkbox" value="option1"><span></span></label>
                      </td>
                        <td><?php echo $get_models['firstname'] .' '.$get_models['lastname'];?></td>
                          <td> <?php echo $get_models['username'];?></td>
                           <td><?php echo $get_models['branchid'];?></td>
                           <td style="text-transform:uppercase;"><?php  
                                  if ($get_models['status'] == 'active') 
                                  {
                                    echo '<span class="label label-success">'.$get_models['status'].'</span>';
                                  }
                                  else
                                  {
                                    echo '<span class="label label-danger">'.$get_models['status'].'</span>';
                                  }
                                  ?></td>
                          <td class="actions" style="font-size:20px;">
                        <div class="action-buttons"><center>
                          <a class="fancybox" href="#<?php echo $get_models['username'];?>"><i class="fa fa-eye"></i></a><a class="table-actions" id="edit_users" href="javascript:void(0);" data-accounts="<?php echo $get_models['username']; ?>"><i class="fa fa-pencil"></i></a></center>
                        </div>
                      </td>
                      <div id="<?php echo $get_models['username'];?>" style="display:none;width:300px;">
                         Employee Name: <?php echo $get_models['firstname'];?> <?php echo $get_models['lastname'];?><br>
                         Username: <?php echo $get_models['username'];?><br>
                         Branch Assign: <?php echo $get_models['branchid'];?><br>
                         Status: <?php  
                                  if ($get_models['status'] == 'active') 
                                  {
                                    echo '<span class="label label-success" style="text-transform:uppercase;">'.$get_models['status'].'</span>';
                                  }
                                  else
                                  {
                                    echo '<span class="label label-danger" style="text-transform:uppercase;">'.$get_models['status'].'</span>';
                                  }
                                  ?><br>
                                  Contact: <?php echo $get_models['contact'];?><br>
                                  User Type: <?php echo $get_models['type'];?><br>
                        
                        
                      </div>
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
      

      $(document).on("click", "#edit_users", function() 
      {
          var id = $(this).data("accounts");
          $.ajax(
          {
          type : "post",
          url : "getuser.php",
          
          data : {sid : id},
          success : function(data)
            {
              
              $("#msg").html(data);
            }

          });
        return false;
      })
    });
    </script>