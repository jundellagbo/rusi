<?php include("db/connection.php"); ?>
<?php
	extract($_POST);
	if(!empty($sid)) {

		 $stmt = $dbConn->prepare("SELECT * FROM accounts WHERE account_id =:sid");
 		 $stmt->execute(array(":sid"=>$sid));
  		$row = $stmt->fetch(PDO::FETCH_ASSOC);
  		
  		
  		$globalid =  $row['model_id'];

  		session_start();
  		$_SESSION['start'] = $globalid;

	}


$getinfo = $dbConn->query("SELECT * FROM accounts where account_id = '".$row['account_id']."'");
$row = $getinfo->fetch(PDO::FETCH_ASSOC);


//getting rates

$getrates = $dbConn->query("SELECT * FROM settings");
$rates = $getrates->fetch(PDO::FETCH_ASSOC);



        
                      


list
    ( $safe_date
    , $requested_day
    , $actual_day
    ) = nextMonth($row['datepayment'], 'Y-m-d');
   



function nextMonth($date, $format='c')
{   
    include 'db/connection.php';
    $getaccount = $dbConn->query("SELECT * FROM accounts where model_id = '".$_SESSION['start']."' ");
                           $disacc = $getaccount->fetch(PDO::FETCH_ASSOC);                       

    $timestamp  = strtotime($date);
    $start_Y    = date('Y', $timestamp);
    $start_m    = date('m', $timestamp);
    $start_d    = date('d', $timestamp);

    // MAKE A TIMESTAMP FOR THE FIRST, LAST AND REQUESTED DAY OF NEXT MONTH
    $timestamp_first = mktime(0,0,0, $start_m+$disacc['months'] + 1,  1, $start_Y);
    $timestamp_last  = mktime(0,0,0, $start_m+$disacc['months'] + 1, date('t', $timestamp_first), $start_Y);
    $timestamp_try   = mktime(0,0,0, $start_m+$disacc['months'] + 1, $start_d, $start_Y);

    // USE THE LESSER OF THE REQUESTED DAY AND THE LAST OF THE MONTH
    if ($timestamp_try > $timestamp_last) $timestamp_try = $timestamp_last;
    $good_date = date($format, $timestamp_try);

    return array
    ( $good_date
    , $start_d
    , date('d', $timestamp_try)
    )
    ;
}
  
   // echo 'Monthly Due Date = '.$safe_date.'<br>';

  // echo 'Monthly Payment = '.$row['monthly_installment'].'<br>';
  
  

    $date1 = $safe_date;
    $date2 = date("Y-m-d");

    $ts1 = strtotime($date1);
    $ts2 = strtotime($date2);

    $year1 = date('Y', $ts1);
    $year2 = date('Y', $ts2);

    $month1 = date('m', $ts1);
    $month2 = date('m', $ts2);

  $diff = (($year2 - $year1) * 12) + ($month2 - $month1);

  $myamount = 0;

  if (date("Y-m-d") <= $safe_date) 
    {
    
    $countmonths = $myamount / $row['monthly_installment'];

    $countmonths = intval($countmonths);

    // $totalpayment = $countmonths * $row['monthly_installment'];

     $totalpayment = $row['monthly_installment'];

    $totaldeposit = $myamount - $totalpayment;

    $totalpenalty = 0;

     $totalmonthsnotpaid = $diff;

     $totalminimum = $row['monthly_installment'];

     $_SESSION['rebate'] =$rates['rebate_rate'];

     $rebate = $rates['rebate_rate'];

     $diff = 0;

    }
  else
    
    {

    $totalmonthsnotpaid = $diff;


    $countmonths = $myamount / $row['monthly_installment'];
    
    $countmonths = intval($countmonths);

    $totalpenalty = ($row['monthly_installment'] * $rates['penalty_rate']) * $totalmonthsnotpaid;

   $totalpenaltyminimum = ($row['monthly_installment'] * $rates['penalty_rate']) * ($totalmonthsnotpaid - 1 );

    $totalpayment = $totalmonthsnotpaid * $row['monthly_installment'] + $totalpenalty;

    // $totaldeposit = $myamount - $totalpayment;

    if ($totalmonthsnotpaid == 1) 
    {
      $penaltyrate = ($row['monthly_installment'] * $rates['penalty_rate'] );
      $totalminimum =  number_format($penaltyrate,2)+ $row['monthly_installment'];

    }
    else
    {
      $totalminimum = ($totalmonthsnotpaid - 1) * $row['monthly_installment'] + number_format($totalpenaltyminimum,2);

    }

    $_SESSION['rebate'] = $rates['rebate_rate'];
    
    $rebate = 0;

    }


    
  
  // echo 'Amount Tender = '.$myamount.'<br>';

  // echo 'Total Months Not Paid = '.$totalmonthsnotpaid.'<br>';

  // echo 'Total Months = '.$countmonths.'<br>';

  // echo 'Total Payment = '.$totalpayment.'<br>';

  // echo 'Total Deposit = '.$totaldeposit.'<br>';

  // echo 'Total Penalty= '.$totalpenalty.'<br>';


  // echo "Total Minimum =  ".$totalminimum." ";



?>
  <div id="#msg"></div>
  <div class="row animated fadeInDown">
              <div class="col-lg-12">
                <div class="widget-container label-container fluid-height">
                  <div class="heading">
                    <i class="fa fa-money"></i>Account Overview <div class="pull-right">
              <a class="fa fa-undo" id="backsettings" style="font-size:20px;">  </a></div>
                  </div>
                  <input type="hidden" id="terms" value="<?php echo $row['terms'];?>">
                  <input type="hidden" id="monthsuse" value="<?php echo $row['months'];?>">
                  <?php 
                  
                  include 'db/connection.php';
                  $getcustomer = $dbConn->query("SELECT * FROM accounts where model_id = '".$globalid."' ");
                  $discustom = $getcustomer->fetch(PDO::FETCH_ASSOC);
                  ?>
                  <div class="widget-content">
                  <!-- header -->
                      <div class="col-lg-12">
                      <div class="row invoice-header">
                      <div class="col-md-6">
                      </div>
                      <div class="col-md-6 text-center">
                      <h2>
                      <?php echo isset($discustom['account_id']) ? $discustom['account_id'] : '';?>

                      </h2>
                      <p>
                      <?php echo date("Y-m-d");?>
                      </p>
                      </div>
                      </div>
                      </div>
                   <!-- end sa header -->
                   <?php 

                   $getinfo = $dbConn->query("SELECT * FROM customerlists where customerid = '".$discustom['account_id']."'");
                   $disinfo = $getinfo->fetch(PDO::FETCH_ASSOC);
                   ?>
                   <!-- well -->
                      <div class="row">
                      <div class="col-md-offset-1 col-md-5">
                      <div class="well">
                      <strong>Customer Information</strong>
                      <h3>
                      <?php echo $disinfo['firstname'] . " " .$disinfo['lastname'];?>
                     
                      </h3>
                      <p>
                      <b>Contact Number:</b> <?php echo $disinfo['contact'];?><br>
                      <b>Address:</b> <?php echo $disinfo['address'];?><br>
                      <b>Tin:</b> <?php echo $disinfo['tin']; ?><br>
                      <b>Contract Price:</b> <?php echo number_format($discustom['contract_price'],2); ?><br>
                      <b>Downpayment:</b> <?php echo number_format($discustom['downpayment'],2); ?><br>
                       </p>
                      </div>
                      </div>
                          <?php 
                  $getstocks = $dbConn->query("SELECT * FROM stocks where model_id = '".$globalid."' ");
                  $disstocks = $getstocks->fetch(PDO::FETCH_ASSOC);
                  ?>
                      <div class="col-md-5">
                      <div class="well">
                      <strong>Product Info</strong>
                      <h3 style="text-transform:uppercase;">
                      <?php echo $disstocks['category_name']. " - ". $disstocks['model_name'];?>
                      </h3>
                      <p>
                      <b>Engine Number:</b> <?php echo $disstocks['engine_number']?><br>
                      <b>Chassis Number:</b> <?php echo $disstocks['chassis']?><br>
                      <b>Color:</b> <?php echo $disstocks['color']?><br><br>
                      </p>

                      </div>
                      </div>
                      </div>

                   <!-- end well -->
                    <p>
                        <form class="form-horizontal" method="post" id="getpay" name="getpay">
                          

							
              <div class="form-group">
							<div class="col-md-offset-1 col-md-3">
								<b style="font-size:23px">Remaining Balance:</b>
							</div>

							<div class="col-md-3" style="font-size:23px;color:green;">
              <b> <?php $remain = $discustom['contract_price'] - ($discustom['monthly_installment'] * $discustom['months']);
                 echo number_format($remain,2); ?></b>
                 <input type="hidden" value="<?php echo $remain;?>" id="remain">
								
							</div>
              <div class="col-md-2">
                <b style="font-size:23px">Deposit:</b>
              </div>

              <div class="col-md-2" style="font-size:23px;color:green;">
              <b> <?php echo number_format($row['deposit'],2); ?></b>
                
              </div>
              </div>

                       
                         
                          	 <input type="hidden" value="<?php echo $globalid;?>" name="model_name" id="model_name" >
                       <input  type="hidden" name="accounts" id="accounts" value="<?php echo isset($discustom['account_id']) ? $discustom['account_id'] : '' ?>">
						
		
  <input type="hidden" name="nextpayment" id="nextpayment" required class="span6 m-wrap" parsley-trigger="change" parsley-required="true" parsley-minlength="4" value="<?php echo $safe_date;?>" readonly parsley-validation-minlength="1" />
                              
                              
                          <div class="form-group">
                          	
							

							<div class="col-md-offset-1 col-md-3">
								<b style="font-size:23px;">Monthly Amort:</b>
							</div>

							<div class="col-md-3" style="font-size:23px;color:green;">

              <b>
                <?php echo number_format($row['monthly_installment'],2);?>
						  </b>
                                  <input type="hidden" value="<?php echo isset($row['monthly_installment'])? $row['monthly_installment'] : '' ;?>" id="minimum"></div>
                <div class="col-md-2">
                <b style="font-size:23px">Rebate:</b>
              </div>

              <div class="col-md-2" style="font-size:23px;color:green;">
              <b> <?php echo isset($rebate)? $rebate: '0.00'; ?></b>
                
              </div>
              <input type="hidden" name="pay" id="pay" value="<?php echo isset($pay) ? $pay : 0 ?>">
							<input type="hidden" value="<?php echo $rebate;?>" id="rebate" name="rebate">
              
                          </div>

                          <div class="form-group">
                          	
							

							<div class="col-md-offset-1 col-md-3">
								<b style="font-size:23px;">Months:</b>
							</div>

							<div class="col-md-3" style="font-size:23px;color:red;"><b>
							<?php echo isset($diff)? $diff : '0' ;?></b></div>



                <input  type="hidden" name="months" id="months" required class="span6 m-wrap" value="<?php echo isset($diff)? $diff : 0 ;?>"  />

                <div class="col-md-2">
                <b style="font-size:23px;">Overdue:</b>
              </div>

              <div class="col-md-1" style="font-size:23px;color:red;"><b>
  <?php  
  if ($diff == 0) 
  {
    echo '0.00';
  }
  else{

if ($remain < $row['monthly_installment']) 
{
  $penals = $row['monthly_installment'] * $rates['penalty_rate'];
  $now = $remain + $penals; 
  echo number_format($now,2);
}
else
{

}
  
 echo isset($totalminimum)? number_format($totalminimum,2) : '' ;


 }?></b></div>


              </div>
              <div class="form-group">      
							<div class="col-md-offset-1 col-md-3">
								<b style="font-size:23px;">Total Penalty: </b>
							</div>

							<div class="col-md-3" style="font-size:23px;color:red;">
              <b>
							<?php echo isset($totalpenalty)? number_format($totalpenalty,2) : '' ;?></b>
              </div>
							<div class="col-md-2">
                <b style="font-size:23px;">Minimum: </b>
              </div>

              <div class="col-md-3" style="font-size:23px;color:red;">
              <b>
              <?php 

              if ($remain < $row['monthly_installment']) 
              {
                $min = $remain - $row['deposit'];

              echo isset($min)?  number_format($min,2) : '' ;
              }
              else
              {
                $min = $totalminimum - $row['deposit'];

              echo isset($min)?  number_format($min,2) : '' ;
              }
              ?></b>
              </div>

                          </div>

                          <div class="form-group">
                          	
							<div class="col-md-offset-1 col-md-3" style="font-size:23px;">
								<b>Total Payment:</b>
							</div>

							<div class="col-md-3" style="font-size:23px;color:#428bca;">
              <b>

              <?php 

                if ($remain < $row['monthly_installment']) 
                {
                  echo number_format($remain,2);
                }
                else
                {
              echo isset($totalpayment)? number_format($totalpayment,2) : '0.00' ;
                }
               $_SESSION['minimum'] = isset($minimum)? $minimum : '0.00';?></b>
              </div>
							<div class="col-md-2" style="font-size:23px;" >
								<b>Amount Tender</b>
							</div>

							<div class="col-md-2">
								
                <?php 

                $totalfull = $remain + number_format($totalpenalty,2);


                ?>

							 <input name="amount" id="amount" min="<?php if($remain < $row['monthly_installment']){echo $totalfull;}else{echo isset($totalminimum) ? $totalminimum - $row['deposit'] : '0.00' ;}?>" required type="number" max="<?php echo isset($totalfull) ? $totalfull : '0.00'  ?>" step="0.01" class="form-control"/>
							 <div id="msgamount"></div>
							 </div>
							

                          </div>
                          <div class="form-group">
                          	
							<label class="control-label col-md-offset-1 col-md-1" style="font-size:23px;"><b>Method:</b></label>
              <div class="col-md-offset-1 col-md-4">
              <label class="radio-inline"><input checked="" name="paymethod" type="radio" value="change"><span>Change</span></label>
              <label class="radio-inline"><input  name="paymethod" type="radio" value="advance"><span>Advance Payment</span></label>
              </div>

							<div class="col-md-4">

								<input type="submit" class="btn btn-primary btn-lg btn-block" value="SUBMIT" id="SUBMIT" name="PROCEED">

							</div>

							

                          </div>

							</div>
							</div>
                       </form>
                
                      </p>
                  </div>
                </div>
              </div>
            </div>
<div class="row"></div>
</div>
 <script>
  $(document).ready(function () 
        { 

            $("#backsettings").click(function (e) 
     { 
        $("#content").load("payments.php");
     });

  

        	// $(document).on("change","#amount",function (e)
         //    { 
         //     var  min = $("#minimum").val();
         //     var amount = $("#amount").val();
         //     var remain = $("#remain").val();
         //     var months = $("#months").val();
         //     var terms = $("#terms").val();
         //     var monthsuse = $("#monthsuse").val();
         //     var rebate = $("#rebate").val();

         //     var total = (parseInt(terms) - parseInt(monthsuse)) - parseInt(months);
         //     var grand = parseFloat(rebate) * parseFloat(total);
         //     var due = parseFloat(remain) - grand;

         //     if (parseFloat(min) > parseFloat(amount)) 
         //     	{
         //     		$("#msgamount").html("<font color='red'>Please input greater than " + " " +min.toFixed(2) + "</font>");
         //     		// alert("Please input greater than " + " " +min);
         //     		$("#amount").val("");
         //     		$("#amount").focus();
         //     	}
         //     	else if (parseFloat(min) <= parseFloat(amount)) 
         //     	{
         //     		$("#msgamount").html("");
         //     		if (parseFloat(amount) > parseFloat(remain)) 
         //      {
         //        $("#msgamount").html("<font color='red'>Full payment is " + " " +due + "</font>");
              
         //        $("#amount").val("");
         //        $("#amount").focus();
         //      }
         //     	}
             
         //     	else
         //     	{
         //     		$("#msgamount").html("<font color='red'>Please input greater than " + " " +min.toFixed(2) + "</font>");
             	
         //     		$("#amount").val("");
         //     		$("#amount").focus();
         //     	}
             
         //    });

        	 $("#getpay").submit(function (e) 
     {     
            var accounts = $("#accounts").val();
            var pay =$("#pay");
            var amount = $("#amount").val();
            var model_name = $("#model_name").val();
            var months = $("#months").val();
            var rebate = $("#rebate").val();
            var paymethod = $("input[name=paymethod]:checked").val();
             $.ajax(
                    {

                        type: "POST",
                        url: "execute/payterms.php",
                        data: "accounts="+accounts+"&amount="+amount+ "&model_name="+model_name+ "&months="+months+"&pay="+pay+"&rebate="+rebate+"&paymethod="+paymethod+"&SUBMIT=",
                        cache: false,
                        success: function (data) 
                        {
                            
                            $("#content").html(data);
                            $('html,body').animate(
                              {scrollTop:
                            $("#content").offset().top},2000);
        
                                                                 
                        }

                    });

            
            return false; 

           
         });

        });
 </script>