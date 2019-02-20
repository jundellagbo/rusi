<?php include("db/connection.php"); ?>
<?php
  extract($_POST);
  if(!empty($sid)) {

     $stmt = $dbConn->prepare("SELECT * FROM customerlists WHERE id =:sid");
     $stmt->execute(array(":sid"=>$sid));
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      

      session_start();
  }
?>
       <script type="text/javascript" src="js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
tinyMCE.init({
  selector: "#tinymce",
  theme : "modern",
  width: 1000,
  height: 100,
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
  var roxyFileman = 'http://localhost/capstone/fileman/index.html';
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
<script src="javascripts/parsley.min.js"></script>
<div id="call"></div>

<div id="display" class="animated fadeInDown"></div>
    <div class="animated fadeInDown">
<div class="row">

<div class="row">
  <div class="col-md-12">
    <div class="widget-container">
      <div class="heading">
        <i class="fa fa-edit"></i>Client Profile<div class="pull-right"><a href="#" id="backsettings" class="fa fa-undo" style="font-size:20px;"></a></div>
      </div>
      <div class="widget-content padded">
        <form method="post" enctype="multipart/form-data" id="applicationform" parsley-validate class="form-horizontal">
          <fieldset>
            <div class="row">
             
                          <div class="form-group">
                           <div class="col-sm-offset-1 col-sm-9">

                            <h2>Add Profile</h2>
                           </div>
                          </div>
                          <div class="form-group">
                            <div class="col-sm-offset-1 col-sm-8">
                            <input type="hidden" value="<?php echo $row['id'];?>" name="profile_id" id="profile_id">
                            <textarea id="tinymce"></textarea></div>
                          </div>
                         
                          
                          <div class="form-group">
                          <div class="col-sm-3">
                             </div>
                            <div class="col-sm-5">
                              <input   type="submit" name="SUBMIT" id="submit" value="ADD PROFILE" class="btn btn-success btn-lg btn-block"><br><br>
                              </div>
                             
                           </form>
                           <div class="form-group scrollable">
                            <div class="col-sm-offset-1 col-sm-9">

                            <h2>Profile History</h2><br>
                            <?php echo $row['profile'];?></div>
                          </div>
                          </div>
            </div>
           
          </fieldset>
      </div>
    </div>
  </div></div>

</div>

<script>
  $(document).ready(function () 
        { 

           $("#backsettings").click(function (e) 
     { 
        $("#content").load("listapplications.php");
     });

    $("#applicationform").submit(function (e) 
     {      e.preventDefault();
        if($(this).parsley().isValid())
        {
            
            var profile_id = $("#profile_id").val();
            var uploadform = $("#tinymce").val();
             $.ajax(
                    {

                        type: "POST",
                        url: "execute/updateprofile.php",
                        data: "profile_id="+profile_id+"&uploadform="+uploadform+"&SUBMIT=",
                        cache: false,
                        success: function (data) 
                        {
                            
                           
                            $("#display").html(data);
                        }

                    });

            
            return false; 
        }
         });

});
</script>