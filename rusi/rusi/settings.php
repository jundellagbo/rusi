<script src="javascripts/parsley.min.js"></script>
<link href="stylesheets/animate.min.css" media="all" rel="stylesheet" type="text/css" />
    <div class="animated fadeInDown">
<div class="row">

 <script>
$(function()
{
     function loadnow()
              {
                $("#settings_count").load("execute/settings_count.php");
              }
              setInterval(function(){loadnow()},1000);
});
           
            </script>

          <div class="col-lg-12">
            <div class="widget-container stats-container" id="settings_count">
             
            </div>
          </div>
        </div>
<div class="row">
              <div class="col-lg-12" >
                <div class="widget-container fluid-height">
                  <div class="heading tabs">
                    <i class="fa fa-gears"></i>Settings  
                    <ul class="nav nav-tabs pull-right" data-tabs="tabs" id="tabs">
                      <li class="active">
                        <a data-toggle="tab" href="#tab1"><i class="fa fa-bell"></i><span>Notification</span></a>
                      </li>
                      <li>
                        <a data-toggle="tab" href="#tab2"><i class="fa fa-user"></i><span>Rates</span></a>
                      </li>
                      <li>
                        <a data-toggle="tab" href="#tab3"><i class="fa fa-list"></i><span>Category / Series</span></a>
                      </li>
                      <li>
                        <a data-toggle="tab" href="#tab4"><i class="fa fa-download"></i><span>Database Back Up</span></a>
                      </li>
                      <li>
                        <a data-toggle="tab" href="#tab5"><i class="fa fa-upload"></i><span>Restore Database</span></a>
                      </li>
                    </ul>
                  </div>
                  <div class="tab-content padded" id="my-tab-content">
                    <div class="tab-pane active animated fadeInDown" id="tab1">
                      <h3>
                        Extend Days
                      </h3>
                      <p>
                       <form class="form-horizontal" parsley-validate="" method="post" id="extend_days_form">
                       
              <input class="form-control" style="width:200px;" placeholder="Extend Days" type="text" parsley-validated parsley-trigger="change" id="extend_days" name="extend_days" parsley-required="true" parsley-minlength="1" parsley-type="number" parsley-validation-minlength="1" parsley-min="0" ><br><input type="submit" class="btn btn-primary" id="submit" name="submit">
                       </form>
                      </p>
                    </div>
                    <div class="tab-pane animated fadeInDown" id="tab2">
                      <h3>
                        Rates
                      </h3>

<div id="display"></div>
                      <p>
                    <form class="form-horizontal" id="penalty_rate_form" parsley-validate="" method="post">
                    <div class="form-group">
                      
                        <div class="col-md-3">
                        Penalty Rates
                        </div>
                       <div class="col-md-6">
              <input class="form-control " placeholder="Penalty Rates" type="text" name="penalty_rates" id="penalty_rates" parsley-trigger="change" parsley-required="true" parsley-minlength="1" parsley-type="digits" maxlength="2" parsley-validation-minlength="1" parsley-min="0"></div>
              <div class="col-md-3">
              <input type="submit" class="btn btn-primary" name="SUBMIT" value="SET PENALTY"> <input type="reset" class="btn btn-danger"></div>
         </div>
                       </form>
                       <form class="form-horizontal" parsley-validate="" method="post" id="monthly_rate_form" >
                    <div class="form-group">
                        <div class="col-md-3">
                        Monthly Interest Rate
                        </div>
                       <div class="col-md-6">
              <input class="form-control " placeholder="Monthly Fees" type="text" name="monthly_rates" id="monthly_rates" parsley-trigger="change" parsley-required="true" parsley-minlength="1" parsley-type="digits" maxlength="2" parsley-validation-minlength="1"></div>
              <div class="col-md-3">
              <input type="submit" class="btn btn-primary" name="SUBMIT" value="SET MONTHLY"> <input type="reset" class="btn btn-danger"></div>
          </div>
                       </form>
                       <form class="form-horizontal" parsley-validate="" id="rebate_form" method="post">
                    <div class="form-group">
                        <div class="col-md-3">
                        Rebate
                        </div>
                       <div class="col-md-6">
              <input class="form-control " placeholder="Rebate" type="number" min="0" step="0.01" required name="rebateset" id="rebateset" parsley-trigger="change" parsley-required="true" parsley-minlength="1" parsley-type="number" parsley-validation-minlength="1"></div>
              <div class="col-md-3">
              <input type="submit" class="btn btn-primary" name="SUBMIT" value="SET REBATE"> <input type="reset" class="btn btn-danger"></div>
          </div>
                       </form>
                       <form class="form-horizontal" parsley-validate="" method="post" id="lesscashprice_form">
                    <div class="form-group">
                        <div class="col-md-3">
                        Less Cash Price
                        </div>
                       <div class="col-md-6">
              <input class="form-control " placeholder="Less Cash Price" type="text" name="lcp_rates" id="lcp_rates" parsley-trigger="change" parsley-required="true" parsley-minlength="1" parsley-type="digits" maxlength="2" parsley-validation-minlength="1"></div>
              <div class="col-md-3">
              <input type="submit" class="btn btn-primary" name="SUBMIT" value="SET LCP"> <input type="reset" class="btn btn-danger"></div>
          </div>
                       </form>
                      </p>
                    </div>
                    <div class="tab-pane animated fadeInDown" id="tab3">
                      <h3>
                        Category <div class="pull-right"><button class="btn btn-success" id="categorylist">Category List</button> <button class="btn btn-success" id="listofseries">List of Series</button></div>
                      </h3>
                      <br>
                      <p>

<div id="display3"></div>
                      <div id="errormsg" hidden>
                         <div class="alert alert-danger animated fadeIn">
                      Invalid Downpayment!
                       </div>
                      </div>
                        <form class="form-horizontal" parsley-validate="" method="post" id="category_form" >
                          <div class="form-group">
                          
                          <div class="col-md-3">
                          Category name
                          </div>
                          <div class="col-md-6">
                          <input class="form-control " placeholder="Category Name" type="text" name="category_name" id="category_name" parsley-trigger="change" parsley-required="true" parsley-minlength="4" parsley-validation-minlength="1"></div>
                          <div class="col-md-2">
                          <input type="submit" class="btn btn-primary" name="SUBMIT"> <input type="reset" class="btn btn-danger"></div>
                          </div>
                       </form>
                       <form class="form-horizontal" parsley-validate="" method="post" id="model_form" name="model_form">
                          <div class="form-group">
                          
                          <div class="col-md-3">
                          Add Series
                          </div>
                          <div class="col-md-3">
                          <select class="form-control" required id="choose_cats" name="choose_cats" parsley-trigger="change" parsley-required="true" parsley-error-container="#selectbox">
                          <option value="">Please Choose</option>
                             <?php 
                            include 'db/connection.php';
                            $querycategory = $dbConn->query("SELECT * FROM categories");
                            while ($row = $querycategory->fetch(PDO::FETCH_ASSOC)) {
                              # code...
                            
                            ?>
                            <option value="<?php echo $row['category_name'];?>"><?php echo $row['category_name'];?></option>
                            <?php }?>
                          </select></div>
                          <div class="col-md-5">
                          <input class="form-control " placeholder="Enter Model / Series Name" type="text" name="model_name" id="model_name" parsley-trigger="change" parsley-required="true" parsley-minlength="4" parsley-validation-minlength="1">
                          </div>
                          
                          </div>
                          <div class="form-group">
                          
                          <div class="col-md-3">

                          </div>
                          <div class="col-md-3">
                          <input type="number" step="0.01" placeholder="Price" class="form-control" name="model_price" id="model_price" parsley-trigger="change" parsley-required="true" parsley-minlength="4" parsley-validation-minlength="1">
                          </div>
                          <div class="col-md-5">
                          <input class="form-control " placeholder="Enter Downpayment" type="number" name="model_down" id="model_down" min="0">
                          </div>
                          </div> 
                          <div class="form-group">
                          
                          <div class="col-md-3">

                          </div>
                          <div class="col-md-4">
                          <input type="submit" class="btn btn-primary btn-block" value="Submit" name="SUBMIT">
                          </div>
                          <div class="col-md-3">
                          <input type="reset" class="btn btn-danger btn-block" value="reset">
                          </div>
                          
                          </div> 
                       </form>
                      </p>
                    </div>
                    <!-- back up database -->
                                        <div class="tab-pane animated fadeInDown" id="tab4">
                      <h3>
                        Back Up System
                      </h3>
                      <p>
                        <form class="form-horizontal">
                          <div class="form-group">
                          
                          <div class="col-md-3">
                          
                          </div>
                          <div class="col-md-6">
                         <button class="btn btn-lg btn-block btn-primary">BACKUP DATABASE</button> </div><div class="col-md-2">
                          
                          </div>
                       </form>
                   
                      </p>
                    </div>
                    </div>
                    <!-- restore databse -->
                      <div class="tab-pane animated fadeInDown" id="tab5">
                      <h3>
                        Restore Database <small>(Warning: Use your own caution)</small>
                      </h3>
                      <p>
                        <form class="form-horizontal">
                          <div class="form-group">
                          
                          <div class="col-md-3">
                          
                          </div>
                          <div class="col-md-6">
                          <input class="form-control " placeholder="Choose File" type="file"></div>
                          <div class="col-md-2">
                          <input type="submit" class="btn btn-primary" value="RESTORE"></div>
                          </div>
                       </form>
                    
                      </p>
                    </div>

                  </div>
                </div>
              </div>
            </div>
            <script>
             $(document).ready(function () 
        { 

          $("#listofseries").click(function()
          {
            $("#content").load("series.php");
          });

            $("#categorylist").click(function()
          {
            $("#content").load("categorylist.php");
          });


        //   $("#model_down").change(function() 
        // { 
        //   var model_price = $("#model_price").val();
        //   var model_down = $(this).val();
        //   if(model_price < model_down) 
        //     {
        //       $("#errormsg").show();
        //       $(this).val(" ");
        //       $(this).focus();
        //     }
        //     else
        //     {
        //        $("#errormsg").hide();
        //     }
        // });


              $("#extend_days_form").submit(function (e) 
     {      e.preventDefault();
      if($(this).parsley().isValid())
      {
            var extend_days = $("#extend_days").val();
            
             $.ajax(
                    {

                        type: "POST",
                        url: "execute/extend_days.php",
                        data: "extend_days="+extend_days+ "&SUBMIT=",
                        cache: false,
                        success: function (data) 
                        {
                            
                            $("#extend_days_form").trigger("reset");
                             
                            $("#display").html('<div id="display1" animate>'+data+'</div>');
                            $("#display1").show();
                            $("#display1").scrollTop();
                            $("#extend_days_form").parsley().reset();
                             $('html,body').animate({scrollTop:
              $("#display").offset().top},1000);
                                                  
                        }

                    });

            
            return false; 
        }
         });


      $("#penalty_rate_form").submit(function (e) 
     {      e.preventDefault();
      if($(this).parsley().isValid())
      {
            var penalty_rates = $("#penalty_rates").val();
            
             $.ajax(
                    {

                        type: "POST",
                        url: "execute/penalty_rate.php",
                        data: "penalty_rates="+penalty_rates+ "&SUBMIT=",
                        cache: false,
                        success: function (data) 
                        {
                            
                            $("#penalty_rate_form").trigger("reset");
                             
                            $("#display").html('<div id="display1" >'+data+'</div>');
                            $("#display1").show();
                            $("#display1").scrollTop();
                            $("#penalty_rate_form").parsley().reset();
                             $('html,body').animate({scrollTop:
              $("#display").offset().top},$row);
                                                  
                        }

                    });

            
            return false; 
        }
         });

$("#monthly_rate_form").submit(function (e) 
     {      e.preventDefault();
      if($(this).parsley().isValid())
      {
            var monthly_rates = $("#monthly_rates").val();
            
             $.ajax(
                    {

                        type: "POST",
                        url: "execute/monthly_rate.php",
                        data: "monthly_rates="+monthly_rates+ "&SUBMIT=",
                        cache: false,
                        success: function (data) 
                        {
                            
                            $("#monthly_rate_form").trigger("reset");
                             
                            $("#display").html('<div id="display1" >'+data+'</div>');
                            $("#display1").show();
                            $("#display1").scrollTop();
                            $("#monthly_rate_form").parsley().reset();
                             $('html,body').animate({scrollTop:
              $("#display").offset().top},1000);
                        }

                    });

            
            return false; 
        }
         });

    $("#rebate_form").submit(function (e) 
     {      e.preventDefault();
      if($(this).parsley().isValid())
      {
            var rebateset = $("#rebateset").val();
            
             $.ajax(
                    {

                        type: "POST",
                        url: "execute/saverebate.php",
                        data: "rebateset="+rebateset+ "&SUBMIT=",
                        cache: false,
                        success: function (data) 
                        {
                            
                            $("#rebate_form").trigger("reset");
                             
                            $("#display").html('<div id="display1" >'+data+'</div>');
                            $("#display1").show();
                            $("#display1").scrollTop();
                            $("#rebate_form").parsley().reset();
                             $('html,body').animate({scrollTop:
              $("#display").offset().top},1000);
        
                        }

                    });

            
            return false; 
        }
         });

 $("#lesscashprice_form").submit(function (e) 
     {      e.preventDefault();
      if($(this).parsley().isValid())
      {
            var lcp_rates = $("#lcp_rates").val();
            
             $.ajax(
                    {

                        type: "POST",
                        url: "execute/lcp_rate.php",
                        data: "lcp_rates="+lcp_rates+ "&SUBMIT=",
                        cache: false,
                        success: function (data) 
                        {
                            
                            $("#lesscashprice_form").trigger("reset");
                             
                            $("#display").html('<div id="display1" >'+data+'</div>');
                            $("#display1").show();
                            $("#display1").scrollTop();
                            $("#lesscashprice_form").parsley().reset();
                            $('html,body').animate({scrollTop:
              $("#display").offset().top},1000);
        
                        }

                    });

            
            return false; 
        }
         });

      $("#category_form").submit(function (e) 
     {      e.preventDefault();
      if($(this).parsley().isValid())
      {
            var category_name = $("#category_name").val();
            
             $.ajax(
                    {

                        type: "POST",
                        url: "execute/category_add.php",
                        data: "category_name="+category_name+ "&SUBMIT=",
                        cache: false,
                        success: function (data) 
                        {
                            
                            $("#category_form").trigger("reset");
                             
                            $("#display3").html('<div id="display1" >'+data+'</div>');
                            $("#display1").show();
                            $("#display1").scrollTop();
                            $("#choose_cats").append("<option value="+category_name+">"+category_name+"</option>");
                            $("#category_form").parsley().reset();
                            $('html,body').animate({scrollTop:
              $("#display").offset().top},1000);
                        }

                    });

            
            return false; 
        }
         });

    $("#model_form").submit(function (e) 
     {      e.preventDefault();
        if($(this).parsley().isValid())
        {
            var choose_cats = $("#choose_cats option:selected").text();
            
            var model_name = $("#model_name").val();
            var model_price = $("#model_price").val();
            var model_down = $("#model_down").val();

             $.ajax(
                    {

                        type: "POST",
                        url: "execute/check_availability.php",
                        data: "choose_cats="+choose_cats+"&model_name="+model_name+"&model_price="+model_price+"&model_down="+model_down+ "&SUBMIT=",
                        cache: false,
                        success: function (data) 
                        {
                            

                            $("#model_form").trigger("reset");
                            $("#display3").html('<div id="display1" >'+data+'</div>');
                            $("#display1").show();
                            $("#display1").scrollTop();
                            $("#model_form").parsley().reset();
                            $('html,body').animate({scrollTop:
                            $("#display").offset().top},1000);
        

                        }

                    });

            
            return false; 
        }
         });

});
            </script></div>