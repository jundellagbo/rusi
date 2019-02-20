
<!DOCTYPE html>
<html>
  <head>
    <title>
    RUSI - MOTORCYCLES
    </title>
    
<?php 
ob_start();
include 'auth.php';
 $have = 'proceed';

?>
     <link href="stylesheets/bootstrap.min.css" media="all" rel="stylesheet" type="text/css" />
    <link href="stylesheets/font-awesome.min.css" media="all" rel="stylesheet" type="text/css" /> 
    <link href="stylesheets/isotope.css" media="all" rel="stylesheet" type="text/css" /> 
    <link href="stylesheets/jquery.fancybox.css" media="all" rel="stylesheet" type="text/css" /> 
    <link href="stylesheets/style.css" media="all" rel="stylesheet" type="text/css" /> 
    <link href="stylesheets/animate.min.css" media="all" rel="stylesheet" type="text/css" />
    <link href="stylesheets/datepicker.css" media="all" rel="stylesheet" type="text/css" /> 
      <link href="stylesheets/daterange-picker.css" media="all" rel="stylesheet" type="text/css" /> 
    <script src="javascripts/jquery-1.10.2.min.js" type="text/javascript"></script>
    <script src="javascripts/jquery-ui.js" type="text/javascript"></script>
    <script src="javascripts/bootstrap.min.js" type="text/javascript"></script>
    <script src="javascripts/jquery.bootstrap.wizard.js" type="text/javascript"></script>
    <script src="javascripts/fullcalendar.min.js" type="text/javascript"></script>
    <script src="javascripts/gcal.js" type="text/javascript"></script>
    <script src="javascripts/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="javascripts/datatable-editable.js" type="text/javascript"></script>
    <script src="javascripts/jquery.easy-pie-chart.js" type="text/javascript"></script>
    <script src="javascripts/excanvas.min.js" type="text/javascript"></script>
    <script src="javascripts/jquery.isotope.min.js" type="text/javascript"></script>
    <script src="javascripts/isotope_extras.js" type="text/javascript"></script>
    <script src="javascripts/modernizr.custom.js" type="text/javascript"></script>
    <script src="javascripts/jquery.fancybox.pack.js" type="text/javascript"></script>
    <script src="javascripts/select2.js" type="text/javascript"></script>
    <script src="javascripts/jquery.inputmask.min.js" type="text/javascript"></script>
    <script src="javascripts/jquery.validate.js" type="text/javascript"></script>
    <script src="javascripts/bootstrap-timepicker.js" type="text/javascript"></script>
    <script src="javascripts/bootstrap-colorpicker.js" type="text/javascript"></script>
    <script src="javascripts/ladda.min.js" type="text/javascript"></script>
    <script src="javascripts/daterange-picker.js" type="text/javascript"></script>
    <script src="javascripts/date.js" type="text/javascript"></script>
    <script src="javascripts/morris.min.js" type="text/javascript"></script>
    <script src="javascripts/skycons.js" type="text/javascript"></script>
    <script src="javascripts/fitvids.js" type="text/javascript"></script>
    <script src="javascripts/jquery.sparkline.min.js" type="text/javascript"></script>
    <script src="javascripts/dropzone.js" type="text/javascript"></script>
    <script src="javascripts/jquery.nestable.js" type="text/javascript"></script>
    <script src="javascripts/main.js" type="text/javascript"></script>
    <script src="javascripts/respond.js" type="text/javascript"></script>
       <script type="text/javascript" src="js/tinymce/tinymce.min.js"></script>
       
<script type="text/javascript">
tinyMCE.init({
  selector: "#tinymce",
  theme : "modern",
  width: 1100,
  height: 400,
  relative_urls:false,
  document_base_url:"http://localhost/capstone",
  menubar: "edit view insert format table tools",
  plugins: [
         "advlist autolink link image lists charmap preview hr anchor pagebreak spellchecker",
         "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
         "table contextmenu directionality emoticons template paste textcolor"
   ],
  
   toolbar: "styleselect | bold italic | forecolor backcolor emoticons | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | undo redo |  link image | print media preview fullpage ", 
   file_browser_callback: RoxyFileBrowser 
  });
 
 function RoxyFileBrowser(field_name, url, type, win) {
  var roxyFileman = 'http://localhost/capstone/admin/fileman/index.html';
  if (roxyFileman.indexOf("?") < 0) {     
    roxyFileman += "?type=" + type;   
  }
  else {
    roxyFileman += "&type=" + type;
  }
  roxyFileman += '&input=' + field_name + '&value=' + document.getElementById(field_name).value;
  if(tinyMCE.activeEditor.settings.language){
    roxyFileman += '&langCode=' + tinyMCE.activeEditor.settings.language;
  }
  tinyMCE.activeEditor.windowManager.open({
     file: roxyFileman,
     title: 'File Manager',
     width: 1200, 
     height: 800,
     resizable: "yes",
     plugins: "media",
     inline: "yes",
     close_previous: "no"  
  }, {     window: win,     input: field_name    });
  return false; 
} 
  
</script>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
  </head>
  <body class="page-header-fixed layout-boxed bg-2">
    <div class="modal-shiftfix">
      <!-- Navigation -->
      <div class="navbar navbar-fixed-top scroll-hide">
        <div class="container-fluid top-bar" id="high">
          <div class="pull-right">
            <ul class="nav navbar-nav pull-right">
              <li class="dropdown notifications hidden-xs">
                <a class="dropdown-toggle" id="flag" data-toggle="dropdown" href="#"><span aria-hidden="true" class="fa fa-bell-o"></span>
                  <div class="sr-only">
                    Notifications
                  </div>
                  <script>
$(function()
{
     function loadnow()
              {
                $("#counter").load("count_notify.php");
              }
              setInterval(function(){loadnow()},1000);
});
           
            </script>
              <div id="counter">
                 

               </div>
                </a>
                <ul class="dropdown-menu" id="count">
                </ul>
              </li>
               <script>
$(function()
{
     function loadnow()
              {
                $("#count_msg").load("count_message.php");
              }
              setInterval(function(){loadnow()},1000);
});
           
            </script>
              <?php 
              if ($_SESSION['type'] == 'Branch Manager' || $_SESSION['type'] == 'Regional Manager' || $_SESSION['type'] == 'Administrator') 
              {
                echo '<li class="dropdown messages hidden-xs">
                <a class="dropdown-toggle" id="click_message" data-toggle="dropdown" href="#"><span aria-hidden="true" class="fa fa-envelope-o"></span>
                  <div class="sr-only">
                    Messages
                  </div>
                  <div id="count_msg">
                  </div>
                 
                </a>
                <ul class="dropdown-menu" id="display_message">
                 
                  
                </ul>
              </li> ';
              }
              
              ?>
              <li class="dropdown user hidden-xs"><a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <label width="34" height="34"/><?php echo $_SESSION['fullname']; ?><b class="caret"></b></a>
                <ul class="dropdown-menu">
                 
                  <li><a href="logout.php">
                    <i class="fa fa-sign-out"></i>Logout</a>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
          <button class="navbar-toggle"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
          <a class="logo" href="index.php?display=dashboard">RUSI MOTORCYCLES</a>
          <!-- <form class="navbar-form form-inline col-lg-2 hidden-xs">
            <input class="form-control" placeholder="Search" type="text">
          </form> -->
        </div>
        <div class="container-fluid main-nav clearfix">
          <div class="nav-collapse">
          <?php 
          
          switch ($_SESSION['type']) 
          {
            case 'Administrator':
              include 'admin.php';
              break;
            case 'Branch Manager':
              include 'manager.php';
              break;
            case 'Accounting':
              include 'accounting.php';
              break;
              case 'Regional Manager':
                include 'admin.php';
                break;
            default:
              # code...
              break;
          }


          ?>
           
          </div>
        </div>
      </div>
      <!-- End Navigation -->
      <div class="container-fluid main-content" id="content">
      </div>
    </div>
    
      </div>
    </div>
    <script>
       $(document).ready(function () 
        { 

           $('#content').html('<center><br><br><br><img src="loader.gif"></center>');

              $("#content").load("home.php");
           

           $("#click_message").click(function (e)
            { 
             
              

              $("#display_message").load("display_message.php");

            });
           
            $("#accountlists").click(function (e)
            { 
             
              $('#content').html('<center><br><br><br><img src="loader.gif"></center>');

              $("#content").load("table.php");

            });

             $("#flag").click(function (e)
            { 
             
              

              $("#count").load("notify.php");

            });

            $("#settings").click(function (e)
            { 
             
              $('#content').html('<center><br><br><br><img src="loader.gif"></center>');

              $("#content").load("settings.php");

            });

            $("#logs").click(function (e)
            { 
             
               $('#content').html('<center><br><br><br><img src="loader.gif"></center>');

              $("#content").load("logs.php");

            });

            $("#dashboard").click(function (e)
            { 
             
             $('#content').html('<center><br><br><br><img src="loader.gif"></center>');

              $("#content").load("content.php");

            });

            $("#liststocks").click(function (e)
            { 
             
              $('#content').html('<center><br><br><br><img src="loader.gif"></center>');

              $("#content").load("liststocks.php");

            });

             $("#addusers").click(function (e)
            { 
             
              $('#content').html('<center><br><br><br><img src="loader.gif"></center>');

              $("#content").load("addusers.php");

            });

              $("#userlist").click(function (e)
            { 
             
              $('#content').html('<center><br><br><br><img src="loader.gif"></center>');

              $("#content").load("userlist.php");

            });

               $("#application").click(function (e)
            { 
             
              $('#content').html('<center><br><br><br><img src="loader.gif"></center>');

              $("#content").load("application.php");

            });

                 $("#addstocks").click(function (e)
            { 
             
              $('#content').html('<center><br><br><br><img src="loader.gif"></center>');

              $("#content").load("addstocks.php");

            });
                   $(document).on("click","#transactions",function (e)
            { 
             
              $('#content').html('<center><br><br><br><img src="loader.gif"></center>');

              $("#content").load("transactions.php");

            });

            $(document).on("click","#reports",function (e)
            { 
             
              $('#content').html('<center><br><br><br><img src="loader.gif"></center>');
            
              $("#content").load("reports.php");

            });

              $(document).on("click","#ca",function (e)
            { 
             
              $('#content').html('<center><br><br><br><img src="loader.gif"></center>');

              $("#content").load("current.php");

            });

                   $(document).on("click","#history",function (e)
            { 
             
              $('#content').html('<center><br><br><br><img src="loader.gif"></center>');

              $("#content").load("overdue.php");

            });

                     $(document).on("click","#payments",function (e)
            { 
             
              $('#content').html('<center><br><br><br><img src="loader.gif"></center>');

              $("#content").load("payments.php");

            });
                       $(document).on("click","#page",function (e)
            { 
             
              $('#content').html('<center><br><br><br><img src="loader.gif"></center>');

              $("#content").load("page.php");

            });
                       $(document).on("click","#approval",function (e)
            { 
             
              $('#content').html('<center><br><br><br><img src="loader.gif"></center>');

              $("#content").load("listapplications.php");

            });


        });
    </script>
  </body>
</html>