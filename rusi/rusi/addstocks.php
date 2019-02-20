<script src="javascripts/parsley.min.js"></script>
<link href="stylesheets/animate.min.css" media="all" rel="stylesheet" type="text/css" />
    <div class="animated fadeInDown">
<div class="row">
<div id="display"></div>

 
         
        </div>
<div class="row">
              <div class="col-lg-12">
                <div class="widget-container fluid-height">
                  <div class="heading tabs">
                    <i class="fa fa-list"></i>Stocks  
                   
                  </div>
                  <div class="tab-content padded" >
                    
       
                   
                      <h3>
                        Add Stocks<div class="pull-right"><button class="btn btn-success" id="addspecial">ADD SPECIAL STOCKS</button></div>
                      </h3>
                      <p>
                        
                       <form class="form-horizontal" parsley-validate="" method="post" id="model_form" name="model_form">
                          <div class="form-group">
                          
                          <div class="col-md-3">
                          Add Series
                          </div>
                          <div class="col-md-3">
                         <select required class="form-control" id="category_name" name="category_name" parsley-trigger="change" parsley-required="true" parsley-error-container="#selectbox" required>
                            <option value="">CHOOSE CATEGORY</option>
                           <?php 
                           include 'db/connection.php';

                           $getmodel = $dbConn->query("SELECT * FROM categories");
                           while ($row = $getmodel->fetch(PDO::FETCH_ASSOC)) 
                           {
                            echo '<option value="'.$row['category_name'].'">'.$row['category_name'].'</option>';
                           }

                           ?>
                          </select></div>
                          <div class="col-md-2">
                         <select id="model_name" class="form-control" required>
                              
                            </select>
                          </div>
                          <div class="col-md-3">
                       <input type="text" class="form-control" placeholder="Enter Color" id="color" name="color">
                          </div>
                          
                          </div>
                          <div class="form-group">
                          
                          <div class="col-md-3">

                          </div>
                          <div class="col-md-3">
                          <input type="text" placeholder="Enter Engine Number" class="form-control" name="engine_number" id="engine_number" parsley-trigger="change" parsley-required="true" parsley-minlength="4" parsley-validation-minlength="1">
                          </div>
                          <div class="col-md-3">
                          <input class="form-control " placeholder="Enter Chassis Number" type="text" name="chassis" id="chassis" parsley-trigger="change" parsley-required="true" parsley-minlength="4" parsley-validation-minlength="1">
                          </div>

                          <div class="col-md-2">
                          <select class="form-control" id="branchname" required>
                            <option value="">Branch</option>
                            <option value="Mandaue">Mandaue</option>
                            <option value="Cordova">Cordova</option>
                          </select>
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
                                      

                  </div>
                </div>
              </div>
            </div>
            <script>
             $(document).ready(function () 
        { 
             $(document).on("change", "#category_name", function() 
      {
          var category_name = $("#category_name option:selected").text();
           var id = $(this).data("accounts");
          $.ajax(
          {
          type : "post",
          url : "getidstocks.php",
          
          data : {sid : category_name},
          success : function(data)
            {
              
              $("#model_name").html(data);
            
            }

          });
        return false;
          
      })
          

               $("#addspecial").click(function (e)
            { 
             
              $('#content').html('<center><br><br><br><img src="loader.gif"></center>');

              $("#content").load("addspecial.php");

            });         

    $("#model_form").submit(function (e) 
     {      e.preventDefault();
        if($(this).parsley().isValid())
        {
            var category_name = $("#category_name option:selected").text();
            
            var model_name = $("#model_name option:selected").text();
            var chassis = $("#chassis").val();
            var engine_number = $("#engine_number").val();
            var color = $("#color").val();
            var branchname = $("#branchname").val();


             $.ajax(
                    {

                        type: "POST",
                        url: "execute/add_stocks.php",
                        data: "category_name="+category_name+"&model_name="+model_name+"&chassis="+chassis+"&engine_number="+engine_number+"&color="+color+"&branchname="+branchname+ "&SUBMIT=",
                        cache: false,
                        success: function (data) 
                        {
                            
                            $("#model_form").trigger("reset");
                             
                            $("#display").html('<div id="display1" >'+data+'</div>');
                            $("#display1").show();
                            $("#display1").scrollTop();
                            $("#model_form").parsley().reset();

                        }

                    });

            
            return false; 
        }
         });

});
            </script></div>