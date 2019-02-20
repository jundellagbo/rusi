<?php include("db/connection.php"); ?>
<?php
	extract($_POST);
	if(!empty($sid)) {

		 $stmt = $dbConn->prepare("SELECT * FROM stocks WHERE model_id =:sid");
 		 $stmt->execute(array(":sid"=>$sid));
  		$row = $stmt->fetch(PDO::FETCH_ASSOC);
  		

  		session_start();
	}
?>
       
<script src="javascripts/parsley.min.js"></script>
<div id="display"></div>
<div class="animated fadeInDown">
<div class="widget-container fluid-height">
<div class="row">
  <div class="col-md-12">
    <div class="widget-content padded">
      <div class="heading">
        <i class="fa fa-money"></i>Choose Payment Method
      </div>
      <div class="widget-container" id="choosepayments">  
      <a href="#" class="fa fa-arrow-left" id="backunit"></a>
                         <center> <h1>CHOOSE PAYMENT</h1></center>
       
                           <div class="form-group">
                         
                          <div class="col-sm-offset-3 col-sm-3">
                          <input type="button" class="btn btn-primary btn-lg btn-block" id="cash" value="CASH">
                          </div>
                           
                          <div class="col-sm-3">
                           <input type="button" class="btn btn-info btn-lg btn-block" id="terms" value="TERMS">
                         
                          </div>
                          </div>


      </div>
      <div class="widget-container" hidden id="cashform">
        <table width="100%">
                        
                        <tr>
                          <td> <label class="col-sm-2 control-label ">Item </label></td>
                          <td> <label for="minval" class=" control-label"><?php echo isset($row['category_name']) ? $row['category_name']: '';?>-<?php echo isset($row['model_name']) ? $row['model_name']: '';?></label></td>
                          <td>NOTE:</td>
                        </tr>
                        <tr>
                          <td> <label class=" control-label ">Account ID </label></td>
                          <td>  <label for="minval" class=" control-label"><?php echo isset($_SESSION['id']) ? $_SESSION['id']: '';?></label></td>
                          <td rowspan="7"><textarea rows="7" id="note" name="note" class="form-control"></textarea></td>
                        </tr>
                         <?php 
                      include 'db/connection.php';
                      $queryname = $dbConn->query("SELECT * FROM customerlists where customerid='".$_SESSION['id']."' ");
                      $getname = $queryname->fetch(PDO::FETCH_ASSOC);
                      ?>
                        <tr>
                          <td> <label class=" control-label ">Customer Name </label></td>
                          <td>  
                        <label for="minval" class=" control-label"><?php echo $getname['firstname'].' '.$getname['lastname'];?></label></td>
                        </tr>
                         <?php 
                      $querycash = $dbConn->query("SELECT * FROM stocks where model_id = '".$row['model_id']."' ");
                      $getcash = $querycash->fetch(PDO::FETCH_ASSOC);
                      ?>

                      <tr>
                        <td><label class=" control-label ">Price </label>
                        
                     </td>
                        <td><label for="minval" class=" control-label"><?php echo number_format($getcash['price'],2);?></label></td>
                      </tr>
                      </table>
                    <form class="form-horizontal" role="form" parsley-validate id="cash_form">
                    
                     <!-- variables -->
                     <input type="hidden" id="category_name" name="category_name" value="<?php echo $row['category_name'];?>">
                   
                     <input type="hidden" id="model_name" name="model_name" value="<?php echo $row['model_name'];?>">

                     <input type="hidden" id="customer_id" name="customer_id" value="<?php echo $_SESSION['id'];?>">

                     <input type="hidden" id="engine2" name="engine2" value="<?php echo $row['engine_number'];?>">
                    
                     <input type="hidden" id="chassis2" name="chassis2" value="<?php echo $row['chassis'];?>">
                     
                     
                        <HR>
                        <div class="form-group">
                        <label class="col-sm-2 control-label ">Total Payment </label>
                        <label for="minval" class="col-md-3 control-label"><?php echo number_format($getcash['price'],2);?></label>
                      </div>
                     

                      <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-8">
                          <input type="submit" class="btn btn-primary btn-lg" name="SUBMIT" id="SUBMIT" name="SUBMIT">
                          <button type="reset" class="btn btn-danger btn-lg">CANCEL</button>
                        </div>
                      </div>

                    </form>
      </div>
      <!-- <div class="widget-container" hidden id="termsform">
        <form method="post" parsley-validate id="addterms"  class="form-horizontal">
                      <table width="100%"  cellspacing="" cellpadding="10" height="500px">
                        
                        <?php 
                        include 'db/connection.php';
                        $querysettings = $dbConn->query("SELECT * FROM settings");
                        $fetchsettings = $querysettings->fetch(PDO::FETCH_ASSOC);
                        ?>
                         <tr>
                          <td> <label class="col-sm-2 control-label ">ITEM: </label></td>
                          <td> <label for="minval" class=" control-label"><?php echo isset($row['category_name']) ? $row['category_name']: '';?>-<?php echo isset($row['model_name']) ? $row['model_name']: '';?></label></td>
                          <td><b>NOTE:</b></td>
                        </tr>
                        <tr>
                          <td> <label class=" control-label ">ACCOUNT ID </label></td>
                          <td>  <label for="minval" class=" control-label"><?php echo isset($_SESSION['id']) ? $_SESSION['id']: '';?></label></td>
                          <td rowspan="9"><textarea rows="10" width="100%" id="note_terms" name="note_terms"></textarea></td>
                        </tr>
                         <?php 
                      include 'db/connection.php';
                      $queryname = $dbConn->query("SELECT * FROM customerlists where customerid='".$_SESSION['id']."' ");
                      $getname = $queryname->fetch(PDO::FETCH_ASSOC);
                      ?>
                        <tr>
                          <td> <label class=" control-label ">Customer Name </label></td>
                          <td>  
                        <label for="minval" class=" control-label" style="text-transform:uppercase;"><?php echo $getname['firstname'].' '.$getname['lastname'];?></label></td>
                        </tr>
                         <?php 
                      $querycash = $dbConn->query("SELECT * FROM stocks where model_id = '".$row['model_id']."'");
                      $getcash = $querycash->fetch(PDO::FETCH_ASSOC);
                      ?>                <tr>
                        <td><label class=" control-label ">Price </label>
                        
                     </td>
                        <td><label for="minval" class=" control-label" ><?php echo number_format($getcash['price'],2);?></label></td>
                        <input type="hidden" value="<?php echo $getcash['price'];?>" id="price" name="price">
                      </tr>
                      <tr>
                        <td><label class="control-label">Input Number of Terms</label></td>
                        <td><input type="text" maxlength="2" class="form-control" style="width:100px;" id="terms1" name="terms1" parsley-trigger="change" parsley-required="true" parsley-type="number" parsley-min="6" parsley-max="36" parsley-validation-minlength="0"></td>
                      </tr>
                      <tr>
                        <td><label class="control-label">Input Downpayment</label></td>
                        <td><input type="text" class="form-control" style="width:100px;" id="downpayment" name="downpayment" parsley-trigger="change" parsley-required="true" parsley-type="number" parsley-min="<?php echo $getcash['downpayment'];?>" parsley-max="<?php echo $getcash['price'];?>" parsley-validation-minlength="0"> </td>
                      </tr>
                      

                      <tr>
                        <td><label class="control-label">Contract Price</label></td>
                        <td><label id="total_price"></label></td>
                      </tr>
                      <tr>
                        <td><label class="control-label">Downpayment</label></td>
                        <td><label id="total"></label></td>
                      </tr>
                      <tr>
                        <td><label class="control-label">Contract Balance</label></td>
                        <td><div id="contract_balance"></div></td>
                      </tr>
                      <tr>
                        <td><label class="control-label">Monthly Installment</label></td>
                        <td><div id="monthly_installment"></div></td>
                      </tr>
                       </table>
                    
                     
                         <input type="hidden" value="<?php echo $fetchsettings['monthly_rate'];?>" id="rates" name="rates">
                       
                          <input type="hidden" id="category_name" name="category_name" value="<?php echo $_POST['category2'];?>">
                   
                        <input type="hidden" id="model_name" name="model_name" value="<?php echo $_POST['model2'];?>">

                        <input type="hidden" id="customer_id" name="customer_id" value="<?php echo $_POST['account2'];?>">

                     <input type="hidden" id="engine2" name="engine2" value="<?php echo $_POST['engine2'];?>">
                    
                     <input type="hidden" id="chassis2" name="chassis2" value="<?php echo $_POST['chassis2'];?>">
                     
                      
                     

                      <div class="form-group form-footer footer-black-transparent">
                        <div class="col-sm-offset-4 col-sm-8">
                          <input type="submit" class="btn btn-primary btn-lg" name="SUBMIT" id="SUBMIT" name="SUBMIT">
                          <button type="reset" class="btn btn-danger btn-lg">CANCEL</button>
                        </div>
                      </div>

                    </form>
      </div> -->
      <div class="widget-container animated fadeIn" hidden id="termsform">
        <form method="post" parsley-validate id="addterms"  class="form-horizontal">
         <?php 
                        include 'db/connection.php';
                        $querysettings = $dbConn->query("SELECT * FROM settings");
                        $fetchsettings = $querysettings->fetch(PDO::FETCH_ASSOC);
                        ?>

          <div class="row">
            <div class="col-lg-12">
              <div class="row invoice-header">
                <?php 
                      include 'db/connection.php';
                      $queryname = $dbConn->query("SELECT * FROM customerlists where customerid='".$_SESSION['id']."' ");
                      $getname = $queryname->fetch(PDO::FETCH_ASSOC);
                      ?>
                <div class="col-md-12 text-right">
                  <h2>
                   Account ID: <?php echo isset($_SESSION['id']) ? $_SESSION['id']: '';?>
                  </h2>
                  <p>
                    <?php echo date("Y-m-d");?>
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="well">
                <strong>Unit Details</strong>
                <h3 style="text-transform:uppercase;">
                  <?php echo isset($row['category_name']) ? $row['category_name']: '';?>-<?php echo isset($row['model_name']) ? $row['model_name']: '';?>
                </h3>
                 <?php 
                      $querycash = $dbConn->query("SELECT * FROM stocks where model_id = '".$row['model_id']."'");
                      $getcash = $querycash->fetch(PDO::FETCH_ASSOC);
                      ?>   
                <p>
                Price: <?php echo number_format($getcash['price'],2);?><br>
                 Downpayment: <?php echo number_format($getcash['downpayment'],2);?><br><br>
                </p>
                <input type="hidden" value="<?php echo $getcash['price'];?>" id="price" name="price">
                <strong>Customer Details</strong>
                <h3>
                  <?php echo $getname['firstname'].' '.$getname['lastname'];?>
                </h3>
                <p>
                  Address: <?php echo $getname['address'];?><br>
                  Contact: <?php echo $getname['contact'];?><br>
                </p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="well">
                <strong>Computations</strong>
                <br>
                <h3></h3>
                <p>
                  Contract Price: <label id="total_price"></label><br>
                  Downpayment: <label id="total"></label><br>
                  Contract Balance: <label id="contract_balance"></label><br>
                  Monthly Installment: <label id="monthly_installment"></label>
                </p>
              </div>
            </div>

          </div>
          <div class="row">
            <div class="col-md-3">Input no. of terms: </div>
            <div class="col-md-3"><input type="text" maxlength="2" class="form-control"  id="terms1" name="terms1" parsley-trigger="change" parsley-required="true" parsley-type="number" parsley-min="6" parsley-max="36" parsley-validation-minlength="0"></div>
            <div class="col-md-3">Input Downpayment: </div>
            <div class="col-md-3"><input type="text" class="form-control" id="downpayment" name="downpayment" parsley-trigger="change" parsley-required="true" parsley-type="number" parsley-min="<?php echo $getcash['downpayment'];?>" parsley-max="<?php echo $getcash['price'];?>" parsley-validation-minlength="0"> </div>
          </div>
          <div class="row">
            <div class="col-md-3">Note:<input type="hidden" value="<?php echo $getcash['downpayment'];?>" id="realdown">
           </div>
            <div class="col-md-9"><textarea rows="10" width="100%" id="note_terms" name="note_terms" class="form-control"></textarea></div>
                </div>
                     

                     
                         <input type="hidden" value="<?php echo $fetchsettings['monthly_rate'];?>" id="rates" name="rates">
                       
                          <input type="hidden" id="category_name" name="category_name" value="<?php echo $_POST['category2'];?>">
                   
                        <input type="hidden" id="model_name" name="model_name" value="<?php echo $_POST['model2'];?>">

                        <input type="hidden" id="customer_id" name="customer_id" value="<?php echo $_POST['account2'];?>">

                     <input type="hidden" id="engine2" name="engine2" value="<?php echo $_POST['engine2'];?>">
                    
                     <input type="hidden" id="chassis2" name="chassis2" value="<?php echo $_POST['chassis2'];?>">
                     
                      
                     
                     <div class="row">
                      <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-8">
                          <input type="submit" class="btn btn-primary btn-lg" name="SUBMIT" id="SUBMIT" name="SUBMIT">
                          <button type="reset" class="btn btn-danger btn-lg">CANCEL</button>
                        </div>
                      </div>
                      </div>
                    </form>
      </div>
  </div>
</div>
</div>
</div>
<script>
  $(document).ready(function () 
  {
      $("#backunit").click(function (e) 
     { 
        $("#content").load("applyunit.php");
     })

        $("#cash").click(function (e) 
     { 
        $("#cashform").show();
        $("#termsform").hide();
        $("#choosepayments").hide();
     })


        $("#terms").click(function (e) 
     { 
        $("#cashform").hide();
        $("#termsform").show();
        $("#choosepayments").hide();
     })

  
    
});
</script>
  <script>
      $(document).ready(function () 
   { 
     
     
    $("#terms1").keyup(function()
    {   
        
        var terms = $(this).val();
        var price = $("#price").val();
        $("#downpayment").val("");
        var rates = $("#rates").val();

        var contract_price = (price)* (1+ (rates * terms)) / terms * terms;
        
        if (terms > 36) 
          {
            alert("Only 36 terms");
            $(this).val("");
          }else

          {
        $("#total_price").html("Php: "+contract_price.toFixed(2)+"");
      }
    });

    $("#downpayment").change(function()
    {   
        var terms = $("#terms1").val();
        var price = $("#price").val();
        var downpayment = $(this).val();

        var rates = $("#rates").val();
        var compute =  balance - downpayment;
        var contract_price = (price)* (1+ (rates * terms)) / terms * terms;
        var balance = contract_price - downpayment;
        var monthly = balance / terms;
        var realdown = $("#realdown").val();

        $("#monthly_installment").html("Php: "+monthly.toFixed(2)+"");
        $("#total_price").html("Php: "+contract_price.toFixed(2)+"");
       
        $("#contract_balance").html("Php: "+balance.toFixed(2)+"");
        $("#total").html("Php: "+downpayment+"");

        if (parseFloat(realdown) > parseFloat(downpayment)) 
          {
            alert("Please input minimum downpayment");
            $("#downpayment").val("");
             $("#monthly_installment").html("");
       
        $("#contract_balance").html("");
        $("#total").html("");
            $("#downpayment").focus();
          }
         
    });



        $("#cash_form").submit(function () 
     {      
      
            var category_name = $("#category_name").val();
            var model_name = $("#model_name").val();
            var customer_id = $("#customer_id").val();
            var engine2 = $("#engine2").val();
            var chassis2 = $("#chassis2").val();

            var note = $("#note").val();
          
           
             $.ajax(
                    {

                        type: "POST",
                        url: "execute/cash.php",
                        data: "category_name="+category_name+"&model_name=" + model_name + "&customer_id=" + customer_id + "&engine2=" + engine2 + "&chassis2="+ chassis2 + "&note=" + note +"&submit=",
                        cache: false,
                        success: function (data) 
                        {
                            
                             
                            $("#display").html('<div id="display1">'+data+'</div>');
                            $("#display1").show();
                            $("#cash").hide();                                   
                        }

                    });

            
            return false; 
            
         });

     $("#addterms").submit(function () 
     {      
      
            var category_name = $("#category_name").val();
            var model_name = $("#model_name").val();
            var customer_id = $("#customer_id").val();
            var engine2 = $("#engine2").val();
            var chassis2 = $("#chassis2").val();

            var note = $("#note").val();
            var terms1 = $("#terms1").val();
            var downpayment = $("#downpayment").val();

           
             $.ajax(
                    {

                        type: "POST",
                        url: "execute/terms.php",
                        data: "category_name="+category_name+"&model_name=" + model_name + "&customer_id=" + customer_id + "&engine2=" + engine2 + "&chassis2="+ chassis2 + "&note=" + note + "&terms1=" +terms1+ "&downpayment=" +downpayment+ "&submit=",
                        cache: false,
                        success: function (data) 
                        {
                            
                             
                            // $("#display").html('<div id="display1">'+data+'</div>');
                            // $("#display1").show();
                            $("#terms").hide();
                            $("#content").html(data);                                   
                        }

                    });

            
            return false; 
            
         });
 
    
    });
    </script>
<div class="row"></div>