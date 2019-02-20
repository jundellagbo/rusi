                                       <?php 

                           include 'db/connection.php';
                           $getaccount = $dbConn->query("SELECT * FROM accounts where status = 'current'");
                           while($disacc = $getaccount->fetch(PDO::FETCH_ASSOC))
{
$d1 = new DateTime($disacc['datepayment']);
$time = date("Y-m-d");
$d2 = new DateTime($time);

// @link http://www.php.net/manual/en/class.dateinterval.php
$interval = $d2->diff($d1);

$bird = $interval->format('%m');
$minus = $bird - $disacc['months'];

if ($minus >= 1) 
{

    
                $a =1;
                $i = 0;
                $i += $a;
                   

}


}
echo isset($i)? ' <p class="counter animated fadeIn">'.$i.'</p>' :'';


?>