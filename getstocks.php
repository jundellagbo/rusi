<?php include("db/connection.php"); ?>
<?php
	extract($_POST);
	if(!empty($sid)) {

		 $stmt = $dbConn->prepare("SELECT * FROM stocks WHERE model_id =:sid");
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
        <i class="fa fa-list-alt"></i>Edit Stocks<div class="pull-right"><a href="#" style="font-size:20px;" class="fa fa-undo" id="backstocks"></a></div>
      </div>
      <div class="widget-content padded">  
    
        <form parsley-validate id="editstocks" name="editstocks" class="form-horizontal">
          <fieldset>      

                          <div class="form-group">
                          <label  class="col-sm-2 control-label">Category Name</label>
                          <div class="col-sm-4">
                          <input type="hidden" id="model_id" name="model_id" value="<?php echo $row['model_id'];?>">
                          <input type="text" readonly class="form-control" value="<?php echo $row['category_name'];?>" name="category_name" required id="category_name" parsley-trigger="change" parsley-required="true" parsley-minlength="4" parsley-validation-minlength="1">
                          </div>
                           <label  class="col-sm-1 control-label">Model Name</label>
                          <div class="col-sm-4">
                          <input type="text" readonly class="form-control" required  value="<?php echo $row['model_name'];?>" id="model_name" name="model_name" parsley-trigger="change" parsley-required="true" parsley-minlength="4" parsley-validation-minlength="1">
                          </div>
                          </div>

                          <div class="form-group">
                          <label  class="col-sm-2 control-label">Engine Number</label>
                          <div class="col-sm-4">
                          <input type="text" class="form-control"  value="<?php echo $row['engine_number'];?>" required id="engine_number" name="engine_number" parsley-trigger="change" parsley-required="true" parsley-minlength="4" parsley-validation-minlength="1">
                          </div>
                           <label  class="col-sm-1 control-label">Chassis</label>
                          <div class="col-sm-4">
                          <input type="text" class="form-control"  value="<?php echo $row['chassis'];?>" required id="chassis" name="chassis" parsley-trigger="change" parsley-required="true" parsley-minlength="4" parsley-validation-minlength="1">
                         
                          </div>
                          </div>

                          <div class="form-group">
                          <label  class="col-sm-2 control-label">Color</label>
                          <div class="col-sm-4">
                          <input type="text" class="form-control" value="<?php echo $row['color'];?>" required  id="color" name="color" parsley-trigger="change" parsley-required="true" parsley-minlength="4" parsley-validation-minlength="1">
                          </div>
                           <label  class="col-sm-1 control-label"></label>
                          <div class="col-sm-4">
                          </div>
                          </div>

                          

                          
                           <div class="form-group">
                          <label  class="col-sm-2 control-label"></label>
                          <div class="col-sm-5">
                          <input type="submit" class="btn btn-success btn-lg btn-block" value="Update">
                          </div>
                           
                          <div class="col-sm-3">
                           <input type="reset" class="btn btn-danger btn-lg btn-block" value="Discard">
                         
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
      $("#backstocks").click(function (e) 
     { 
        $("#content").load("liststocks.php");
     });

  
     $("#editstocks").submit(function (e) 
     {      
       e.preventDefault();
      if($(this).parsley().isValid())
      {
            var category_name = $("#category_name").val();
            var model_name = $("#model_name").val();
            var engine_number = $("#engine_number").val();
            var chassis = $("#chassis").val();
            var color = $("#color").val();
            var model_id = $("#model_id").val();
             $.ajax(
                    {

                        type: "POST",
                        url: "execute/update_stocks.php",
                        data: "category_name=" + category_name + "&model_name="  + model_name + "&engine_number=" + engine_number + "&chassis=" + chassis + "&color="+ color + "&model_id="+ model_id +"&submit=",
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