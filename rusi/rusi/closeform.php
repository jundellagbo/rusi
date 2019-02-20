<div class="animated fadeInDown" id="unit">
<div class="row">
          <div class="col-md-12">
            <div class="widget-container fluid-height">
              <div class="heading">
                <span class="fa fa-warning"></span>Confirmation
              </div>
              <div class="widget-content padded">
              <center><h3>Are you sure to close this account? <?php session_start();echo $_SESSION['id'];?></h3>
              <div class="row">
              <form id="confirmclose" method="post">
              <div class="form-group">
                <div class="col-sm-offset-4 col-sm-4">
                <input type="submit" class="btn btn-primary" value="Confirm" id="SUBMIT" name="SUBMIT"> 
                <input type="button" class="btn btn-danger" value="Cancel">
                </div>
              </div>
                
              </form></div>
              </center>
              </div>
            </div>
          </div>
</div>
</div>
<script>
  $(document).ready(function () 
  {
  
   $("#confirmclose").submit(function () 
     {      
      
           
           
             $.ajax(
                    {

                        type: "POST",
                        url: "execute/closeaccount.php",
                        data: "SUBMIT=",
                        cache: false,
                        success: function (data) 
                        {
                          
                          $("#closeform").html(data);  
                                                          
                        }

                    });

            
            return false; 
            
         });

  });
</script>
<br>