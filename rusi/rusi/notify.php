  <?php 
session_start();
                           include 'db/connection.php';
                           $getaccount = $dbConn->query("SELECT * FROM accounts where status = 'current' ");
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

    echo '
                  <li class="animated fadeIn"><a href="#" id="readmsg" data-msgpay="'.$disacc['account_id'].'"">
                    <div class="notifications label label-danger">
                      NOT PAID
                    </div>
                    <p>
                      '.$disacc['account_id'].'
                    </p></a>
                    
                  </li>
                
                </ul>';
                $a =1;
                $i = 1;
                 $i += $a;
                   

}


}

echo isset($i)? '' : '<li><a href="#">
                   
                    <p>
                     NOTHING
                    </p></a>
                    
                  </li>';



?>
<script>
  $(document).ready(function()
    {
      

      $(document).on("click", "#readmsg", function() 
      {
          var id = $(this).data("msgpay");

          $.ajax(
          {
          type : "post",
          url : "getpay.php",
          
          data : {sid : id},
          success : function(data)
            {

              $("#content").html(data);

            }

          });
        return false;
      })
    });
</script>