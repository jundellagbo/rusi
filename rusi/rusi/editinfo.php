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
        <i class="fa fa-edit"></i>Personal Information<div class="pull-right"><a href="#" class="fa fa-undo" id="backsettings" style="font-size:20px;"></a></div>
      </div>
      <div class="widget-content padded">
        <form method="post" enctype="multipart/form-data" id="applicationform" parsley-validate class="form-horizontal">
          <fieldset>
            <div class="row">
              <div class="form-group">
                            <label for="firstname" class="col-sm-2 control-label">First Name</label>
                            <div class="col-sm-4">
                            <input type="hidden" value="<?php echo $row['id']?>" name="infoid" id="infoid">
                              <input type="text"  class="form-control parsley-validated" id="firstname" name="firstname" parsley-trigger="change" parsley-required="true" parsley-minlength="1" parsley-validation-minlength="1" value="<?php echo $row['firstname'];?>">
                            </div>
                            <label for="middlename" class="col-sm-2 control-label">Middle Name </label>
                            <div class="col-sm-4">
                              <input type="text" class="form-control parsley-validated" name="middlename" id="middlename" parsley-trigger="change" parsley-required="true" parsley-minlength="1" parsley-validation-minlength="1" value="<?php echo $row['middlename'];?>">
                            </div>
                          </div>
                           <div class="form-group">
                            <label for="lastname" class="col-sm-2 control-label">Last Name</label>
                            <div class="col-sm-4">
                              <input type="text"  class="form-control parsley-validated" id="lastname" name="lastname" parsley-trigger="change" parsley-required="true" parsley-minlength="1" parsley-validation-minlength="1" value="<?php echo $row['lastname'];?>">
                            </div>
                            <label for="tin" class="col-sm-2 control-label">TIN</label>
                            <div class="col-sm-4">
                              <input type="text" class="form-control parsley-validated" name="tin" id="tin" parsley-trigger="change" parsley-required="true" parsley-minlength="1" parsley-validation-minlength="1" value="<?php echo $row['tin'];?>">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="address" class="col-sm-2 control-label">ADDRESS</label>
                            <div class="col-sm-4">
                              <input type="text"  class="form-control parsley-validated" id="address" name="address" parsley-trigger="change" parsley-required="true" parsley-minlength="1" parsley-validation-minlength="1" value="<?php echo $row['address'];?>">
                            </div>
                            <label for="contact" class="col-sm-2 control-label">CONTACT</label>
                            <div class="col-sm-4">
                              <input type="text" class="form-control parsley-validated" name="contact" id="contact" parsley-trigger="change" parsley-required="true" parsley-type="digits" parsley-minlength="1" parsley-validation-minlength="1" value="<?php echo $row['contact'];?>">
                            </div>
                          </div>
                       
                         
                          
                          <div class="form-group">
                          <div class="col-sm-4">
                             </div>
                            <div class="col-sm-5">
                              <input type="submit" name="submit" id="submit" value="UPDATE" class="btn btn-primary btn-lg btn-block">
                              </div>
                             
                           </form>
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
            var firstname = $("#firstname").val();
            var middlename = $("#middlename").val();
            var lastname   = $("#lastname").val();
            var tin = $("#tin").val();
            var address = $("#address").val();
            var contact = $("#contact").val();
            var infoid = $("#infoid").val();

             $.ajax(
                    {

                        type: "POST",
                        url: "execute/updateinfo.php",
                        data: "firstname="+firstname+"&middlename="+middlename+"&lastname="+lastname+"&tin="+tin+ "&address="+address+"&contact="+contact+"&infoid="+infoid+"&SUBMIT=",
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