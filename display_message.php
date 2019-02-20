<?php


session_start();
include 'db/connection.php';

if ($_SESSION['branch'] == 'any') 
{
$count_message = $dbConn->query("SELECT * FROM stocks where status = 'repo' AND price = '0'");

}
else
{
$count_message = $dbConn->query("SELECT * FROM stocks where status = 'repo' AND price = '0' AND branch = '".$_SESSION['branch']."'");
}
  if ($count_message->rowCount() == 0) 
  {
    echo '<li><a href="#">NO MESSAGE</a></li>';
  }
  else
  {
    while($display_message = $count_message->fetch(PDO::FETCH_ASSOC))
{
  echo ' <li><a href="#" id="click_msg" data-message="'.$display_message['model_id'].'"">
                    '.$display_message['category_name'].' : '.$display_message['engine_number'].'</a>
                  </li>';
}
  }


?>
<script>
	
	$(document).ready(function()
    {
      

      $(document).on("click", "#click_msg", function() 
      {
          var id = $(this).data("message");

          $.ajax(
          {
          type : "post",
          url : "getmessage.php",
          
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