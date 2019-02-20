<?php
session_start();
include 'db/connection.php';
if (isset($_SESSION['username'])) 
{
  header("location:index.php");
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>
      Kymco - DBMS
    </title>
    <link href="stylesheets/bootstrap.min.css" media="all" rel="stylesheet" type="text/css" />
    <link href="stylesheets/font-awesome.min.css" media="all" rel="stylesheet" type="text/css" />
    <link href="stylesheets/style.css" media="all"
     rel="stylesheet" type="text/css" />
    <link href="stylesheets/animate.min.css" media="all" rel="stylesheet" type="text/css" />
    <script src="javascripts/jquery-1.10.2.min.js" type="text/javascript"></script>
    <script src="javascripts/jquery-ui.js" type="text/javascript"></script>
    <script src="javascripts/bootstrap.min.js" type="text/javascript"></script>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
  </head>
  <body class="login">
    <!-- Login Screen -->
    <div class="login-wrapper">

      <div class="logo">
        <img src="images/logo.png">
      </div>
      <form method="post" id="login" name="login">
        <div  id="loginmessage">
          
        </div>
        <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-user"></i></span><input class="form-control" required placeholder="Username" type="text" id="username" name="username">
          </div>
        </div>
        <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-lock"></i></span><input class="form-control" required placeholder="Password" type="password" id="password" name="password">
          </div>
        </div>
      
        <input class="btn btn-lg btn-primary btn-block" type="submit" id="SUBMIT" name="SUBMIT" value="LOG IN">
      
      </form>
    </div>

     <script>
        $(document).ready(function () 
        { 

          $("#login").submit(function (e) 
            { 
          var username = $("#username").val();
          var password = $("#password").val();
           
           $.ajax(
                    {

                        type: "POST",
                        url: "execute/check_account.php",
                        data: "username="+username+"&password="+password+"&SUBMIT=",
                        cache: false,
                        success: function (data) 
                        {

                            if (data == 1) 
                            {
                              window.location='index.php';
                            }
                            else
                            {
                            $("#loginmessage").html('<div id="display1" >'+data+'</div>');
                            $("#display1").show();
                            }
                        }

                    });

            
            return false; 
             });
        });
    </script>
  </body>
</html>