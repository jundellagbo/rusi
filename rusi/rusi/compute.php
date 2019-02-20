 <?php 

include('connection.php');


// getting information of the clients

$getinfo = $dbConn->query("SELECT * FROM admin_bill where Homeownerid = 'XX3MT5X05'");
$row = $getinfo->fetch(PDO::FETCH_ASSOC);


//getting rates

$getrates = $dbConn->query("SELECT * FROM admin_rates");
$rates = $getrates->fetch(PDO::FETCH_ASSOC);



	list
	( $safe_date
	, $requested_day
	, $actual_day
	) = nextMonth($row['Datepayment'], 'Y-m-d');




	function nextMonth($date, $format='c')
	{   
		include ('connection.php');
		$result =$dbConn->query("SELECT * FROM admin_bill where Homeownerid='GGW5RRLK6' ");
		$row = $result->fetch(PDO::FETCH_ASSOC);


		$timestamp  = strtotime($date);
		$start_Y    = date('Y', $timestamp);
		$start_m    = date('m', $timestamp);
		$start_d    = date('d', $timestamp);

		// MAKE A TIMESTAMP FOR THE FIRST, LAST AND REQUESTED DAY OF NEXT MONTH
		$timestamp_first = mktime(0,0,0, $start_m+$row['Months'] + 1,  1, $start_Y);
		$timestamp_last  = mktime(0,0,0, $start_m+$row['Months'] + 1, date('t', $timestamp_first), $start_Y);
		$timestamp_try   = mktime(0,0,0, $start_m+$row['Months'] + 1, $start_d, $start_Y);

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

	
	echo 'Monthly Due Date = '.$safe_date.'<br>';

	echo 'Monthly Payment = '.$row['Bill_MonthlyPayment'].'<br>';
	
	

		$date1 = $safe_date;
		$date2 = date("Y-m-d");

		$ts1 = strtotime($date1);
		$ts2 = strtotime($date2);

		$year1 = date('Y', $ts1);
		$year2 = date('Y', $ts2);

		$month1 = date('m', $ts1);
		$month2 = date('m', $ts2);

	$diff = (($year2 - $year1) * 12) + ($month2 - $month1);

	$myamount = 500;

	if (date("Y-m-d") <= $safe_date) 
		{
		
		$countmonths = $myamount / $row['Bill_MonthlyPayment'];

		$countmonths = intval($countmonths);

		$totalpayment = $countmonths * $row['Bill_MonthlyPayment'];

		$totaldeposit = $myamount - $totalpayment;

		$totalpenalty = 0;

		}
	else
		
		{

		$totalmonthsnotpaid = $diff + 1;


		$countmonths = $myamount / $row['Bill_MonthlyPayment'];
		
		$countmonths = intval($countmonths);

		$totalpayment = $countmonths * $row['Bill_MonthlyPayment'];



		$totalpenalty = ($row['Bill_MonthlyPayment'] * $rates['setRates']) * $totalmonthsnotpaid;

		$totaldeposit = $myamount - $totalpayment;

		}


		
	
	echo 'Amount Tender = '.$myamount.'<br>';

	echo 'Total Months Not Paid = '.$totalmonthsnotpaid.'<br>';

	echo 'Total Months = '.$countmonths.'<br>';

	echo 'Total Payment = '.$totalpayment.'<br>';

	echo 'Total Deposit = '.$totaldeposit.'<br>';

	echo 'Total Penalty= '.$totalpenalty.'<br>';


	echo 'Total Pay = '.$totalpenalty.'<br>';


?>   