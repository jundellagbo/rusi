<?php
include '../db/connection.php';
session_start();
// if (is_null($_SESSION['confirmation']))
// {

// 	header("location:owned.php");
// }

	if (isset($_POST['SUBMIT'])) 
{


	$letter = 'RUSI';
function numberletter() 
{
					$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
					srand((double)microtime()*1000000);
					$i = 0;
					$passii = '' ;
					while ($i 	<= 4) 
					{
						$num = rand() % 33;
						$tmp = substr($chars, $num, 1);
						$passii = $passii . $tmp;
						$i++;
					}
					return $passii;
}
$ccnumbers = numberletter();
$confirmation = $letter.'-'.$ccnumbers;
	

	// getting information of the clients

$getinfo = $dbConn->query("SELECT * FROM accounts where account_id = '".$_POST['accounts']."'");
$row = $getinfo->fetch(PDO::FETCH_ASSOC);


//getting rates

$getrates = $dbConn->query("SELECT * FROM settings");
$rates = $getrates->fetch(PDO::FETCH_ASSOC);



    


    function nextMonth($date, $format='c')
    {   
        include ('../db/connection.php');
        $result =$dbConn->query("SELECT * FROM accounts where account_id='".$_POST['accounts']."' ");
        $row = $result->fetch(PDO::FETCH_ASSOC);


        $timestamp  = strtotime($date);
        $start_Y    = date('Y', $timestamp);
        $start_m    = date('m', $timestamp);
        $start_d    = date('d', $timestamp);

        // MAKE A TIMESTAMP FOR THE FIRST, LAST AND REQUESTED DAY OF NEXT MONTH
        $timestamp_first = mktime(0,0,0, $start_m+$row['months'] + 1,  1, $start_Y);
        $timestamp_last  = mktime(0,0,0, $start_m+$row['months'] + 1, date('t', $timestamp_first), $start_Y);
        $timestamp_try   = mktime(0,0,0, $start_m+$row['months'] + 1, $start_d, $start_Y);

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

    list
    ( $safe_date
    , $requested_day
    , $actual_day
    ) = nextMonth($row['datepayment'], 'Y-m-d');

    
     // 'Monthly Due Date = '.$safe_date.'<br>';

     // 'Monthly Payment = '.$row['Bill_MonthlyPayment'].'<br>';
    
    

        $date1 = $safe_date;
        $date2 = date("Y-m-d");

        $ts1 = strtotime($date1);
        $ts2 = strtotime($date2);

        $year1 = date('Y', $ts1);
        $year2 = date('Y', $ts2);

        $month1 = date('m', $ts1);
        $month2 = date('m', $ts2);

    $diff = (($year2 - $year1) * 12) + ($month2 - $month1);

    $myamount = $_POST['amount'] + $row['deposit'];

    if (date("Y-m-d") <= $safe_date) 
        {
        
        $countmonths = $myamount / $row['monthly_installment'];

        $countmonths = intval($countmonths);

        $totalpayment = $countmonths * $row['monthly_installment'];

        $totaldeposit = $myamount - $totalpayment;

        $fourth = $countmonths;

        $fifth = $totalpayment;

        $pilamonths = $countmonths + $row['months'];

        $totalpenalty = 0;

        $second = 0;

        if ($_POST['paymethod'] == 'change') 
        {
            $change = $totaldeposit;
            $game = 0;

        }
        else
        {
            $deposit = $totaldeposit;
             $game = $totaldeposit;
        }



        }
    else
        
        {

        $totalmonthsnotpaid = $diff;

        $countmonths = $myamount / $row['monthly_installment'];
        
        $countmonths = intval($countmonths);

         $time = $totalmonthsnotpaid - $countmonths;

        if ($time == 1) 
        {
            $minus = 1;
        }
        else
        {
            $minus = 0;
        }

        $totalpayment = $countmonths * $row['monthly_installment'];

        $rates = ($row['monthly_installment'] * $rates['penalty_rate']);

         $totalpenalty = $rates * ($totalmonthsnotpaid - $minus);

        $first = $row['monthly_installment'] * ($totalmonthsnotpaid - $minus) ;

        $second = $totalpenalty + $first;

        $third = $myamount - $second;

        $fourth = $third / $row['monthly_installment'];

        $fifth = $row['monthly_installment'] *  intval($fourth);

        $sixth = $third - $fifth;

        $totaldeposit = $sixth;

        $pilamonths = ($totalmonthsnotpaid - $minus) + intval($fourth);



         if ($_POST['paymethod'] == 'change') 
        {
            $change = $totaldeposit;
            $game = 0;
        }
        else
        {
            $deposit = $totaldeposit;
            $game = $totaldeposit;
        }

        }



    // echo 'Amount Tender = '.$myamount.'<br>';

    // echo 'Total Months Not Paid = '.$totalmonthsnotpaid.'<br>';

    // echo 'Total Months = '.$countmonths.'<br>';

    // echo 'Total Payment = '.$totalpayment.'<br>';

    // echo 'Total Deposit = '.$totaldeposit.'<br>';

    // echo 'Total Penalty= '.$totalpenalty.'<br>';


    // echo 'Total Pay = '.$totalpenalty.'<br>';




        $monthsnow = intval($fourth);
        $fixrebate1 = $_SESSION['rebate'] * intval($fourth);
		// query for inserting transaction
	 $dbConn->query("INSERT INTO transaction (trans_id,customerid,model_id,datepayment,total_paid,amount,user_id,penalty,branch,due_date,months,rebate,deposit) VALUES ('".$confirmation."','".$_POST['accounts']."','".$_POST['model_name']."','".date('Y-m-d')."','".$totalpayment."','".$_POST['amount']."','".$_SESSION['username']."','".$totalpenalty."','".$_SESSION['branch']."','".$safe_date."','".$countmonths."','".$fixrebate1."','".$game."')");
	// query for getting info for property
	$kuha = $dbConn->query("SELECT * FROM models where id = '".$_POST['model_name']."' ");
	$fetch = $kuha->fetch(PDO::FETCH_ASSOC);
	// getting all transaction on specific users
	$kuhatrans = $dbConn->query("SELECT sum(total_paid) FROM transaction where customerid = '".$_POST['accounts']."'");
	$fetch1 = $kuhatrans->fetch(PDO::FETCH_ASSOC);
	 'Total paid:'. $fetch1['sum(total_paid)'];
     $newmonths = $row['months'] + $countmonths;
	// update the current settings
	$dbConn->query("UPDATE accounts SET deposit = '".$game."',totalpaid = '".$fetch1['sum(total_paid)']."',months = '".$newmonths."' where account_id  = '".$_POST['accounts']."' ");

}
// }
function convert_number_to_words($number) {
    
    $hyphen      = '-';
    $conjunction = ' and ';
    $separator   = ', ';
    $negative    = 'negative ';
    $decimal     = ' point ';
    $dictionary  = array(
        0                   => 'zero',
        1                   => 'one',
        2                   => 'two',
        3                   => 'three',
        4                   => 'four',
        5                   => 'five',
        6                   => 'six',
        7                   => 'seven',
        8                   => 'eight',
        9                   => 'nine',
        10                  => 'ten',
        11                  => 'eleven',
        12                  => 'twelve',
        13                  => 'thirteen',
        14                  => 'fourteen',
        15                  => 'fifteen',
        16                  => 'sixteen',
        17                  => 'seventeen',
        18                  => 'eighteen',
        19                  => 'nineteen',
        20                  => 'twenty',
        30                  => 'thirty',
        40                  => 'fourty',
        50                  => 'fifty',
        60                  => 'sixty',
        70                  => 'seventy',
        80                  => 'eighty',
        90                  => 'ninety',
        100                 => 'hundred',
        1000                => 'thousand',
        1000000             => 'million',
        1000000000          => 'billion',
        1000000000000       => 'trillion',
        1000000000000000    => 'quadrillion',
        1000000000000000000 => 'quintillion'
    );
    
    if (!is_numeric($number)) {
        return false;
    }
    
    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
        );
        return false;
    }

    if ($number < 0) {
        return $negative . convert_number_to_words(abs($number));
    }
    
    $string = $fraction = null;
    
    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }
    
    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens   = ((int) ($number / 10)) * 10;
            $units  = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds  = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . convert_number_to_words($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= convert_number_to_words($remainder);
            }
            break;
    }
    
    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = array();
        foreach (str_split((string) $fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode(' ', $words);
    }
    
    return $string;
}

?>

<div class="row animated fadeInDown">
<div class="col-lg-12">
            <div class="widget-container fluid-height clearfix">
              <div class="heading">
                <i class="fa fa-money hidden-print"></i>Receipt<center><a onclick="javascript:window.print();" class="btn btn-lg btn-teal hidden-print">
									Print <i class="fa fa-print"></i>
								</a></center>
              </div>
              <br>
              <div class="widget-content padded clearfix">
            	<div class="col-md-4">
            		<table border="1" width="330px" height="100%" >
            			<th colspan="2">In settlement of the following</th>
            			
            			<tbody >
            				<tr>
            				<td>Invoice No.</td>
            				<td>Amount</td>
            				</tr>
            				<tr>
            				<td></td>
            				<td></td>
            				</tr>
            				<tr>
            				<td><?php 
                            $start = $row['months'];
            $str = 'P'.$start.'M';
$date = new DateTime($row['datepayment']);
$date->add(new DateInterval($str));
echo $date->format('M  Y')."-";
            $str = 'P'.$pilamonths.'M';
$date = new DateTime($row['datepayment']);
$date->add(new DateInterval($str));
echo $date->format('M  Y') . "<br>";
                            ?></td>
            				<td><?php echo number_format($totalpayment,2);?></td>
            				</tr>
            				<tr>
            				<td>Penalty:</td>
            				<td><?php echo number_format($totalpenalty,2);?></td>
            				</tr>
                                <tr>
                            <td>Deposit:</td>
                            <td><?php echo isset($deposit) ? number_format($deposit,2) :'0.00';?></td>
                            </tr>
            				<tr>
            				<td>Less: Rebates</td>
            				<td>(<?php $fixrebate = $_SESSION['rebate'] * intval($fourth);
                                echo number_format($fixrebate,2);
                            ?>)</td>
            				</tr>
            				<tr>
            				<td><b>Total Due</b></td>
            				<td></td>
            				</tr>
                                <tr>
                            <td>Total Change</td>
                            <td><?php echo isset($change) ? number_format($change,2) : '0.00' ;?></td>
                            </tr>
            				<tr>
            				<td></td>
            				<td></td>
            				</tr>
            				<tr>
            				<td>Total Payment</td>
            				<td><?php $totals = $_POST['amount'];
            					echo number_format($_POST['amount'],2);
            				?></td>
            				</tr>
            				
            				
            			</tbody>
            		</table>
            		<br>
            		<br>
            		<table>
            			<tr><td><b>Account ID: <?php echo $_POST['accounts']; ?></b></td></tr>
            			<tr><td></td></tr>
            			<tr><td><u><b>NOTE: This Receipt is not valid for claim of input taxes. This official receipt shall be valid until May 11,2020.</b></u></td></tr>
            			<tr>
            			<td><br></td>
            			</tr>
            			<tr>
            			<td>Track your accounts here : <b>www.rusi.com.ph/track</b></td>
            			</tr>	
            		</table>
            	</div>
            	<div class="col-md-8">
            	<?php

            	$getinfo = $dbConn->query("SELECT * FROM customerlists where customerid = '".$_POST['accounts']."' "
            		
            		);
            	$disinfo = $getinfo->fetch(PDO::FETCH_ASSOC);
            	?>
            	<table width="100%" height="100%" cellpadding="12">
            		<tr>
            			<td>
            			<img src="images/logo.png">
						</td>
						<td><h3>RUSI MOTORBIKES</h3>Operated by: RUSI motorbikes INC<br>Puso Poblacion Cordova Cebu<br>TIN: 12398-12312-123-123- VAT EXEMPT<br>TEL. Nos: 345-1234/495-123123</td>
            		</tr>
            		<tr>
            		<td style="color:red;">NO: <?php echo $confirmation;?></td>
            			<td></td>
					</tr>
					<tr>
						<td>OFFICIAL RECEIPT</td>
						<td>Date: <?php echo date("m-d-Y");?></td>
					</tr>
					<tr>
						<td colspan="2"><pre>RECEIVED from 		<b><?php echo $disinfo['firstname']." ". $disinfo['lastname'];?></b>  		with TIN:	<b></b>
						<br>and address of 	<b><?php echo $disinfo['address'];?></b>			engaged in the 			
						<br>business style of  , the sum of <b><?php echo convert_number_to_words($totals);?> pesos only</b> 
						<br><b>(P <?php echo number_format($totals,2);?>)</b> in partial/ fullpayment for</pre></td>
					</tr>
					<tr>
						<td colspan="2">___<u><?php echo $_SESSION['fullname'];?></u>____</td>
						
					</tr>
					<tr>
						<td colspan="2">Authorized Signature</td>
					</tr>	
            	</table>
            	</div>
              </div>
            </div>
          </div>
          </div>

	 
<div class="row"></div>