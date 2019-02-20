<?php include("db/connection.php"); ?>
<?php
  extract($_POST);
  if(!empty($sid)) {

     $stmt = $dbConn->prepare("SELECT * FROM stocks WHERE  model_id =:sid");
     $stmt->execute(array(":sid"=>$sid));
     $row = $stmt->fetch(PDO::FETCH_ASSOC);
     

        
  }

    $getstocks = $dbConn->query("SELECT * FROM models where category_name = '".$row['category_name']."' and model_name = '".$row['model_name']."'  ");
    $disstocks = $getstocks->fetch(PDO::FETCH_ASSOC);

?>
<div id="msg"></div>
<div class="row animated fadeInDown">
              <div class="col-lg-12">
                <div class="widget-container fluid-height">
                  <div class="heading tabs">
                    <i class="fa fa-edit"></i>Stock Overview  
                 
                  </div>
                  <div class="tab-content padded" >
                    
       
                   
                      <h2>
                        <?php echo $row['category_name']?> - <?php echo $row['model_name']?>
                      </h2>
                      <p>
                      <form class="form-horizontal" id="changeprice">
                        <div class="form-group">
                          <div class="col-md-5">
                            <h3>UNIT INFORMATION  </h3>
                          </div>
                             </div>
                        <div class="form-group">
                          
                          <div class="col-md-offset-2 col-md-4"><b>ENGINE NUMBER:</b> <?php echo $row['engine_number']?></div>

                          <div class="col-md-4"><b>CHASSIS NUMBER:</b> <?php echo $row['chassis']?></div>
                          <div class="col-md-2"><b>COLOR:</b> <?php echo $row['color']?></div>
                        </div>
                        <div class="form-group">
                          <div class="col-md-2">
                            <h3>HISTORY</h3>
                          </div>
                         
                          
                        </div>
                        <?php

                   $getover = $dbConn->query("SELECT * FROM sold_items where engine = '".$row['engine_number']."'");
                   while($disover = $getover->fetch(PDO::FETCH_ASSOC))
                   {
                    echo '<div class="form-group">
                           <div class="col-md-offset-2 col-md-5">   <b>ACCOUNT-ID: </b>'.$disover['customer_id'];

                    $total = $dbConn->query("SELECT sum(total_paid) FROM transaction where customerid = '".$disover['customer_id']."' ");
                    $distotal = $total->fetch(PDO::FETCH_ASSOC);

                    echo ' </div><div class="col-md-2"><b>AMOUNT PAID: </b>'.number_format($distotal['sum(total_paid)'],2).'</div></div>';

                   }
                   ?>
                   <hr>
                           <div class="form-group">
                           <div class="col-md-3">
                             Input New Price and Downpayment
                           </div>
                          <div class="col-md-4">
                          <input type="hidden" value="<?php echo $row['model_id'];?>" id="updateid">
                          <input type="hidden" value="<?php echo $disstocks['price']?>" id="price">
                            Price: <input type="number" class="form-control" required id="newprice" min="1">
                          </div>
                          <div class="col-md-4">
                            Downpayment: <input type="number" class="form-control" required id="newdownpayment" min="1">
                          </div>
                        </div>
                        <div class="form-group">
                           
                          <div class="col-md-offset-3 col-md-4">
                            <input type="submit" class="btn btn-primary" value="Submit" id="SUBMIT" name="SUBMIT">
                            <input type="reset" class="btn btn-danger" value="reset" id="reset" name="reset"> 
                          
                          </div>
                         
                        </div>
                        </div>
                       
                      </form>    
                    
                      </p>
                    </div>
                    <!-- back up database -->
                                      

                  </div>
                </div>
              </div>
              <script>
                     $(document).ready(function () 
        { 

           
            $("#newprice").on("change",function()
            {
               var price = $("#price").val();
              var newprice = $("#newprice").val();
              $("#newdownpayment").val("");
              if (parseFloat(price) < parseFloat(newprice)) 
              {
                alert("Your New Price is bigger than Original price");
                $("#newprice").val("");
              }
              else if (parseFloat(price) > parseFloat(newprice))
              {
                 
              }
              else
              {
                $("#newprice").val("");
              }

            })

            $("#newdownpayment").on("change",function()
            {
              var price = $("#price").val();
               var newprice = $("#newprice").val();
              var newdownpayment = $("#newdownpayment").val();

              if (parseFloat(newprice) < parseFloat(newdownpayment)) 
              {
                alert("Your New Downpayment is bigger than new price");
                $("#newdownpayment").val("");
              }

              if (parseFloat(price) < parseFloat(newdownpayment)) 
              {
                alert("Your New Downpayment is bigger than Original price");
                $("#newdownpayment").val("");
              }
              else if (parseFloat(price) > parseFloat(newdownpayment))
              {
                 
              }
              else
              {
                $("#newdownpayment").val("");
              }

            })



    $("#changeprice").submit(function (e) 
     {     

              var newprice = $("#newprice").val();
              var newdownpayment = $("#newdownpayment").val();
              var updateid = $("#updateid").val();
             $.ajax(
                    {

                        type: "POST",
                        url: "execute/updatestocks.php",
                        data: "newprice="+newprice+"&newdownpayment="+newdownpayment+"&updateid="+updateid+ "&SUBMIT=",
                        cache: false,
                        success: function (data) 
                        {
                            
                         $("#msg").html(data);
                        }

                    });

            
            return false; 
        
         });

});
              </script>