<link href="stylesheets/bootstrap.min.css" media="all" rel="stylesheet" type="text/css" />
    <link href="stylesheets/font-awesome.min.css" media="all" rel="stylesheet" type="text/css" /> 
    <link href="stylesheets/datatables.css" media="all" rel="stylesheet" type="text/css" /> 
    <link href="stylesheets/style.css" media="all" rel="stylesheet" type="text/css" /> 
   <script src="javascripts/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="javascripts/datatable-editable.js" type="text/javascript"></script>

     <link href="stylesheets/jquery.fancybox.css" media="all" rel="stylesheet" type="text/css" /> 
    <script src="javascripts/jquery.fancybox.pack.js" type="text/javascript"></script>
   
    
    <script src="javascripts/main.js" type="text/javascript"></script>
    <script src="javascripts/respond.js" type="text/javascript"></script> <div class="animated fadeInDown">
        <div class="page-title">
          <h1>
            Payments
          </h1>
        </div>
        <div id="msg"></div>
       
        <div class="row">
          <div class="col-lg-12">
            <div class="widget-container fluid-height clearfix">
              <div class="heading">
                <i class="fa fa-user"></i>Find Account
              </div>
              <div class="widget-content padded clearfix">
                <table class="table table-bordered table-striped" id="dataTable1">
                  <thead>
                   
                   
                    <th>
                      Account ID
                    </th>
                    <th class="hidden-xs">
                      Model Name
                    </th>
                   
                    <th hidden>
                      Terms
                    </th>
                    <th hidden>
                       Monthly Installment
                    </th>
                    <th>
                      Total Paid
                    </th>
                    <th hidden>
                      Deposit
                    </th>
                    <th hidden>
                      Contract Price
                    </th>
                    <th hidden>
                      Months
                    </th>

                    <th>
                      Datepayment
                    </th>

                    <th class="hidden-xs">
                      Actions
                    </th>
                  </thead>
                  <tbody>
                 <?php
                        include 'db/connection.php';
                        $models = $dbConn->query("SELECT * FROM accounts where status != 'open' ");
                        while ($get_models= $models->fetch(PDO::FETCH_ASSOC)) 
                        {
                          # code...
                          
                        ?>
                          <tr>
                                <td>
                                <a class="fancybox" href="#<?php echo $get_models['account_id']; ?>"><?php echo $get_models['account_id']; ?></a>

                                <?php $getcus = $dbConn->query("SELECT * FROM customerlists where customerid = '".$get_models['account_id']."' ");
                                  $discus = $getcus->fetch(PDO::FETCH_ASSOC);
                                    ?>
                                
                                    <div  style="display:none" id="<?php echo $get_models['account_id']; ?>">
                                      <h2 style="width:400px;"><?php echo $get_models['account_id']; ?></h2>
                                      <p>
                                       Name: <?php echo $discus['firstname'];?> <?php echo $discus['middlename'];?> <?php echo $discus['lastname'];?><br>
                                       TIN: <?php echo $discus['tin'];?> <br>
                                       Address: <?php echo $discus['address'];?> <br>
                                       Contact: <?php echo $discus['contact'];?> <br>

                                      </p>
                                    </div>

                                </td>
                                <td>
                                          
                                <?php $getcus = $dbConn->query("SELECT * FROM customerlists where customerid = '".$get_models['account_id']."' ");
                                  $discus = $getcus->fetch(PDO::FETCH_ASSOC);
                                    ?>
                                
                                    <div  style="display:none" id="<?php echo $get_models['account_id']; ?>">
                                      <h2 style="width:400px;"><?php echo $get_models['account_id']; ?></h2>
                                      <p>
                                       Name: <?php echo $discus['firstname'];?> <?php echo $discus['middlename'];?> <?php echo $discus['lastname'];?><br>
                                       TIN: <?php echo $discus['tin'];?> <br>
                                       Address: <?php echo $discus['address'];?> <br>
                                       Contact: <?php echo $discus['contact'];?> <br>
                                       
                                      </p>
                                    </div>
                                          <a style="text-transform:uppercase;" href="#<?php echo $get_models['model_id'];?>" class="fancybox">

                                <?php $getmod = $dbConn->query("SELECT * FROM stocks where model_id = '".$get_models['model_id']."' ");
                                  $dismod = $getmod->fetch(PDO::FETCH_ASSOC);
                                  echo $dismod['model_name'];
                                    ?>
                                
                                    
                                          </a>
                                          <div  style="display:none" id="<?php echo $get_models['model_id']; ?>">
                                      <h2 style="width:400px;text-transform:uppercase;"><?php echo $dismod['model_name']; ?></h2>
                                      <p>
                                       Color: <?php echo $dismod['color'];?> <br>
                                       Engine Number: <?php echo $dismod['engine_number'];?> <br>
                                       Chassis: <?php echo $dismod['chassis'];?> <br>
                                     
                                      </p>
                                    </div>

                                </td>
                                <td hidden><?php echo $get_models['terms'];?></td>
                                <td hidden><?php echo $get_models['monthly_installment'];?></td>
                                <td><?php echo number_format($get_models['totalpaid'],2);?></td>
                                <td hidden><?php echo $get_models['deposit'];?></td>
                                <td hidden><?php echo $get_models['contract_price'];?></td>
                                <td hidden><?php echo $get_models['months'];?></td>
                                <td><?php echo $get_models['datepayment'];?></td>
                                 <td>
                                 <?php if ($get_models['terms'] == $get_models['months']) 
                                 {
                                  echo "FULLY PAID";
                                 }
                                 else{
                                 ?>


                                 <span class="btn btn-primary" id="edit_payments" href="javascript:void(0);" data-accounts="<?php echo $get_models['account_id']; ?>">PAY</span></td>
                                    
                                 
                          </tr>
                         
                        <?php 
                      }
                        }
                        ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        </div>
        <!-- end DataTables Example -->
       <script>
    $(document).ready(function()
    {
      

      $(document).on("click", "#edit_payments", function() 
      {
          var id = $(this).data("accounts");
          $.ajax(
          {
          type : "post",
          url : "getpay.php",
          
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