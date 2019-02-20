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
     <div id="msg"></div><div id="stocks1">
    <div class="animated fadeInDown">
        <div class="page-title">
          <h1>
            LIST OF APPLICATIONS
          </h1>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <div class="widget-container fluid-height clearfix">
              <div class="heading">
                <i class="fa fa-users"></i>Application Lists
              </div>
              <div class="widget-content padded clearfix">
                <table class="table table-bordered table-striped" id="dataTable1">
                  <thead>
                    <th hidden>
                     </th>
                    <th>
                      Full Name
                    </th>
                    <th>
                     Address
                    </th>
                    <th class="hidden-xs">
                     Contact
                    </th>
                   
                    <th class="hidden-xs">
                      TIN
                    </th>
                    <th>Actions(S)</th>
                  </thead>
                  <tbody>
                 
                     <?php
                        include 'db/connection.php';
                        $accounts = $dbConn->query("SELECT * FROM customerlists");
                        
                        while ($getaccounts = $accounts->fetch(PDO::FETCH_ASSOC)) 
                        {
                          # code...
                        
                        ?>
                        <tr>
                         <td hidden>
                           </td>
                        <td><a href="#<?php echo $getaccounts['id'];?>" class="fancybox"><?php echo $getaccounts['firstname'].' '.$getaccounts['lastname'];?></a></td>
                          <td> <?php echo $getaccounts['address'];?></td>
                           <td><?php echo $getaccounts['contact'];?></td>
                           <td><?php echo $getaccounts['tin'];?></td>
                          <td class="actions">
                    
                        <button class="btn btn-success" data-edit="<?php echo $getaccounts['id'];?>" id="edit_info">EDIT INFO</button>  <button class="btn btn-primary" data-update="<?php echo $getaccounts['id'];?>" id="update_profile">UPDATE PROFILE</button> 
                      
               
                      </td>
                      <div id="<?php echo $getaccounts['id'];?>" style="display: none">
                  <p style="font-size:40px;">
                    Profile
                  </p>
                  <p>
                  <?php echo $getaccounts['profile'];?>

                    </p>
                </div>
                                 </tr>
                                 <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        </div>
        </div>
        <!-- end DataTables Example -->
        <script>
           $(document).ready(function()
    {
      
    

      $(document).on("click", "#edit_info", function() 
      {
          var id = $(this).data("edit");

          $.ajax(
          {
          type : "post",
          url : "editinfo.php",
          
          data : {sid : id},
          success : function(data)
            {
              
              $("#stocks1").hide();
              $("#msg").html(data);

            }

          });
        return false;
      })

      $(document).on("click", "#update_profile", function() 
      {
          var id = $(this).data("update");

          $.ajax(
          {
          type : "post",
          url : "updateprofile.php",
          
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