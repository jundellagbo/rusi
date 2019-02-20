<?php include("db/connection.php"); ?>
<?php
	extract($_POST);
	if(!empty($sid)) {

		 $stmt = $dbConn->prepare("SELECT * FROM categories WHERE id =:sid");
 		 $stmt->execute(array(":sid"=>$sid));
  		$row = $stmt->fetch(PDO::FETCH_ASSOC);
  		

  		session_start();
	}
?>
       
<script src="javascripts/parsley.min.js"></script>
<div id="display"></div>
<div class="animated fadeInDown">
<div class="row">
  <div class="col-md-12">
    <div class="widget-container">
      <div class="heading">
        <i class="fa fa-list-alt"></i>Edit Category Name<div class="pull-right">
              <a class="fa fa-undo" id="backsettings" style="font-size:20px;">  </a></div>
      </div>
      <div class="widget-content padded"> 
        <form parsley-validate id="editcategory" name="editcategory" class="form-horizontal">
          <fieldset>      

                          <div class="form-group">
                           <div class="col-sm-2">
                       
                          </div>
                          <label  class="col-sm-2 control-label">Category Name</label>
                          <div class="col-sm-4">
                          <input type="hidden" id="categoryid" name="categoryid" value="<?php echo $row['id'];?>">
                          <input type="text" class="form-control" value="<?php echo $row['category_name'];?>" name="category_name" required id="category_name" parsley-trigger="change" parsley-required="true" parsley-minlength="4" parsley-validation-minlength="1">
                          </div>
                         
                          </div>

         

                          
 <div class="col-sm-2">
                       
                          </div>
                          
                           <div class="form-group">
                          <label  class="col-sm-2 control-label"></label>
                          <div class="col-sm-4">
                          <input type="submit" class="btn btn-success btn-lg btn-block" value="UPDATE" name="submit">
                          </div>
                           
                    
                          </div>


          </fieldset>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
<script>
  $(document).ready(function () 
  {
      $("#backsettings").click(function (e) 
     { 
        $("#content").load("categorylist.php");
     });

  
     $("#editcategory").submit(function (e) 
     {      
       e.preventDefault();
      if($(this).parsley().isValid())
      {
            var category_name = $("#category_name").val();

            var categoryid = $("#categoryid").val();

             $.ajax(
                    {

                        type: "POST",
                        url: "execute/updatecategory.php",
                        data: "category_name=" + category_name + "&categoryid="  + categoryid +"&submit=",
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
<div class="row"></div>