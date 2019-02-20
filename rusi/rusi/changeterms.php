<?php
session_start();
include 'db/connection.php';

$change = $dbConn->query("SELECT * FROM accounts where account_id = '".$_SESSION['id']."' ");
$dischange = $change->fetch(PDO::FETCH_ASSOC);

$start = 1 + $dischange['months'];
 $total = $dischange['monthly_installment'] * $start;

$getmodel = $dbConn->query("SELECT * FROM stocks where model_id = '".$dischange['model_id']."' ");
$dismodel = $getmodel->fetch(PDO::FETCH_ASSOC);

$getsettings = $dbConn->query("SELECT * FROM settings");
$display = $getsettings->fetch(PDO::FETCH_ASSOC);

$compute = ($dismodel['price'] - $dischange['downpayment']) * (1 + ($display['monthly_rate'] * 5)) / 5 * 5;

// if ($total < $compute) 
// {
// $new_contract_price = $compute - $total;
// echo $new_contract_price/5;
// }
// else
// {
// }


?>
<input type="hidden" id="find_account" value="<?php echo $_SESSION['id'];?>">
<input type="hidden" id="start" value="<?php echo $start;?>">
<input type="hidden" id="total" value="<?php echo $total;?>">
<input type="hidden" id="price" value="<?php echo $dismodel['price'];?>">
<input type="hidden" id="down" value="<?php echo $dischange['downpayment'];?>">
<input type="hidden" id="rates" value="<?php echo $display['monthly_rate'];?>">

<div class="col-md-12 animated fadeInDown">
            <div class="widget-container fluid-height">
              <div class="heading">
                <span class="fa fa-warning"></span>CHANGE TERMS
              </div>
              <div class="widget-content padded">
              
              <div class="row">
              <form method="post" id="newterms">
              <div class="form-group">
               <div class="col-md-offset-3 col-md-3">
               <h3>Input Terms</h3>
              	<input type="number" class="form-control" id="numberterms" required min="1" max="36" style="width:200px;">
             
           <br>
                 <input type="submit" class="btn btn-primary" value="Confirm" id="SUBMIT" name="SUBMIT"> 
                <input type="button" class="btn btn-danger" value="Cancel">
                   </div>
                    <div class="col-md-6">
                    <h3>Computations</h3>
              		<label >New Contract Price: <input readonly type="text" class="form-control" id="contract_price"></label>
                	<br>
                	<label>New Monthly Installment: <input readonly type="text" class="form-control" id="new_monthly_installment"></label>
                   </div>
                   </div>
              </form>
               </div>

             
              </div>
            </div>
          </div>
          <br>
            <script>
        $(document).ready(function  ()
        {
          
          $("#numberterms").on("change",function()
          {
          	
          	var	start = $("#start").val();
          	var	total = $("#total").val();
          	var	price = $("#price").val();
          	var	down = $("#down").val();
          	var	rates = $("#rates").val();
          	var	numberterms = $("#numberterms").val();

          	var compute = (price-down) * (1 + (rates * numberterms)) / numberterms * numberterms;

          	if (total < compute) 
          		{
          			var grand = compute - total;
          			var newmon = grand / numberterms;

          			$("#contract_price").val(grand.toFixed(2));

          			$("#new_monthly_installment").val(newmon.toFixed(2));
          		}
          		else
          		{
          			$("#numberterms").val("");
          			alert("Not Available choose another terms");
          		}

          });

           $("#newterms").submit(function () 
     {     

     	var	start = $("#start").val();
          	var	total = $("#total").val();
          	var	price = $("#price").val();
          	var	down = $("#down").val();
          	var	rates = $("#rates").val();
          	var	numberterms = $("#numberterms").val();

          	var compute = (price-down) * (1 + (rates * numberterms)) / numberterms * numberterms;

          	if (total < compute) 
          		{
          			var grand = compute - total;
          			var newmon = grand / numberterms;
          	
          		}
           
           $.ajax(
                    {

                        type: "POST",
                        url: "execute/change_terms.php",
                        data: "grand="+grand+"&newmon="+newmon+"&numberterms="+numberterms+  "&SUBMIT=",
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