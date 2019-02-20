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
					while ($i <= 4) 
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
	

	// query for getting rates
	$getrates = $dbConn->query("SELECT * FROM settings");
		$rowrates =$getrates->fetch(PDO::FETCH_ASSOC);
		// query for getting owned id
		$getown = $dbConn->query("SELECT * FROM accounts where account_id  = '".$_POST['accounts']."' ");
		$fetch2 = $getown->fetch(PDO::FETCH_ASSOC);
		// are condition sa mga nay penalty
		if ($_POST['months'] > 0 ) 
		{	
			// gi compute ang months og penalty rate
			 $penalty = $fetch2['monthly_installment'] * $rowrates['penalty_rate'];
			// final penalty 
			$pila = $_POST['months'] * number_format($penalty,2);
		}
		// if walay penalty gi set ang penalty og 0
		else
		{
			$pila = 0;
		}

		// count numnber of payments
		 $update = ($_POST['amount'] + $fetch2['deposit']- $pila) /$fetch2['monthly_installment'];
		// number format to zero decimal places
		 '<br> NUMBER OF MONTHS: ';
		 $sure = intval($update);
		// fetch pila months tanan na bayad niya
		 '<br> NUMBER OF ALL MONTHS: ';
		 $shit = $fetch2['months'] + $sure;
		 '<br>';
		// gi times pila ka months bayrana og pila bayranan
		 'Count: '.$count =  $sure * $fetch2['monthly_installment'];
		 "<br>";
		// gi compute pila sobra sa kwarta
		 ' CHANGE: ' .$amount = ($fetch2['deposit'] + ($_POST['amount'] - $pila)) - $count; 
		 "<br>";

		// condition ni are if nay sobra kwarta pag bayad

		// if walay sobra gi set ang deposit og 0
		if ($amount <= 0)
		{
			 $deposit = 0;
		}
		// are gi store if nay sobra greater than 0
		else
		{
			$deposit = $amount;
		}


		// query for inserting transaction
	$dbConn->query("INSERT INTO transaction (trans_id,customerid,model_id,datepayment,total_paid,amount,deposit,user_id,penalty,branch) VALUES ('".$confirmation."','".$_POST['accounts']."','".$_POST['model_name']."','".date('Y-m-d')."','".$_POST['amount']."','".$count."','".$deposit."','".$_SESSION['username']."','".$pila."','".$_SESSION['branch']."')");
	// query for getting info for property
	$kuha = $dbConn->query("SELECT * FROM models where id = '".$_POST['model_name']."' ");
	$fetch = $kuha->fetch(PDO::FETCH_ASSOC);
	// getting all transaction on specific users
	$kuhatrans = $dbConn->query("SELECT sum(total_paid) FROM transaction where customerid = '".$_POST['accounts']."'");
	$fetch1 = $kuhatrans->fetch(PDO::FETCH_ASSOC);
	 'Total paid:'. $fetch1['sum(total_paid)'];
	// update the current settings
	$dbConn->query("UPDATE accounts SET deposit = '".$deposit."',totalpaid = '".$fetch1['sum(total_paid)']."',months = '".$shit."' where account_id  = '".$_POST['accounts']."' ");

}
// }

?>


<html>
<head>
	<title>OFFICIAL RECEIPT</title>
	 
	<script language="javascript">
function Clickheretoprint()
{ 
  var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,"; 
      disp_setting+="scrollbars=yes,width=900, height=400, left=100, top=25"; 
  var content_vlue = document.getElementById("print_content").innerHTML; 
  
  var docprint=window.open("","",disp_setting); 
   docprint.document.open(); 
   docprint.document.write('<html><head><title>OFFICIAL RECEIPT</title>'); 
   docprint.document.write('</head><body onLoad="self.print()" style="width: 900px; font-size:16px; font-family:verdana;">');          
   docprint.document.write(content_vlue);          
   docprint.document.write('</body></html>'); 
   docprint.document.close(); 
   docprint.focus(); 
}
</script>
</head>
<body style="font-family: verdana;" border="1">

<center><a href="javascript:Clickheretoprint()" class="btn btn-primary btn-large">Print</a></center>
<br>
<div id="print_content">
<img src="../logo-big.png" width="100" height="100" style="float:left;"><strong>RUSI MOTORBIKES</strong><br>Cordova Cebu<br>Email Us: rusi@yahoo.com<br>Contact: <a href="#">(12345)123-123</a> and call on <a href="#">(+6332)1758751</a>
<br><br><br><br>
OR #: <?php echo $confirmation;?>
<br>
Date: <?php echo date("M d Y") ?>
<br>
<table width="500px" border="0" cellspadding="5" cellspacing="10">
	
	<TR>
		<td><b>MONTH(S)</b></td>
		<td><b>TOTAL</b></td>
	</TR>
	<tr>
		<td><br><?php 
		for ($i=0; $i < $sure ; $i++) { 
			$start = $fetch2['months'] + $i;
			$str = 'P'.$start.'M';
$date = new DateTime($fetch2['datepayment']);
$date->add(new DateInterval($str));
echo $date->format('M  Y') . "<br>";
		}

		?><br><br></td>
		<td><br><?php 
		for ($i=0; $i < $sure ; $i++) { 
			echo 'Php '. number_format($fetch2['monthly_installment'],2).'<br>';
		}

		?><br><br></td>
	</tr>
	<tr>
		<td>PENALTY:</td>
		<td><?php echo isset($pila) ? 'Php '. number_format($pila,2) : ''; ?></td>	
	</tr>

	<tr>
		<td>DEPOSIT</td>
		<TD><?php echo isset($deposit) ? 'Php '. number_format($deposit,2) : ''; ?></TD>
	</tr>
	<tr>
		<td><b>TOTAL PAID</b></td>
		<TD><font size="3px"><?php echo isset($_POST['amount']) ? 'Php '. number_format($_POST['amount'],2) : ''; ?></font></TD>
	</tr>

</table>
<br>
<br>
<br>
<table width="500px" border="1">
<tr>
	<td width="350px">Prepared by:</td>
	<td width="150px">Account Number:</td>
</tr>
<tr>
	<td width="100px"><?php echo $_SESSION['fullname'];?></td>
	<td width="400px"><?php echo $_POST['accounts'];?></td>
</tr>
</table>

</div>
</body>
<?php 
unset($_SESSION['confirmation']); ?>
</html>