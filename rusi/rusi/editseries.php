<?php include("db/connection.php"); ?>
<?php
	extract($_POST);
	if(!empty($sid)) {

		 $stmt = $dbConn->prepare("SELECT * FROM models WHERE id =:sid");
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
        <i class="fa fa-list-alt"></i>Edit Series <div class="pull-right"><a href="#" class="fa fa-undo " id="backstocks" style="font-size:20px;"></a></div>
      </div>
      <div class="widget-content padded">  
    
        <form parsley-validate id="editseries" name="editstocks" class="form-horizontal">
          <fieldset>      

                          <div class="form-group">
                          <label  class="col-sm-2 control-label">Category Name</label>
                          <div class="col-sm-3">
                          <input type="hidden" id="model_id" name="model_id" value="<?php echo $row['id'];?>">
                          <select class="form-control" name="category_name" id="category_name" required>
                            <option value="">CHOOSE</option>
                            <?php
                            $getcat = $dbConn->query("SELECT * FROM categories");
                            while ($row1 = $getcat->fetch(PDO::FETCH_ASSOC)) 
                            {
                              
                            ?>
                            <option value="<?php echo $row1['category_name']; ?>" <?php if ($row1['category_name'] == $row['category_name']) { echo 'selected';
                              # code...
                            }?>><?php echo $row1['category_name']; ?></option>
                            <?php } ?>
                          </select>
                          </div>
                           <label  class="col-sm-2 control-label">Model Name</label>
                          <div class="col-sm-4">
                          <input type="text"  class="form-control" required  value="<?php echo $row['model_name'];?>" id="model_name" name="model_name" parsley-trigger="change" parsley-required="true" parsley-minlength="4" parsley-validation-minlength="1">
                          </div>
                          </div>

                          <div class="form-group">
                          <label  class="col-sm-2 control-label">Price</label>
                          <div class="col-sm-4">
                          <input type="number" step="0.01" min="0" class="form-control"  value="<?php echo $row['price'];?>" required id="price" name="price">
                          </div>
                           <label  class="col-sm-1 control-label">Downpayment</label>
                          <div class="col-sm-4">
                          <input type="number" step="0.01" min="0" class="form-control"  value="<?php echo $row['downpayment'];?>" required id="downpayment" name="downpayment">
                         
                          </div>
                          </div>

                      

                          

                          
                           <div class="form-group">
                          <label  class="col-sm-4 control-label"></label>
                          <div class="col-sm-5">
                          <input type="submit" class="btn btn-success btn-lg btn-block" value="Update" name="submit">
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
        $("#content").load("series.php");
     });

  
     $("#editseries").submit(function (e) 
     {      
       e.preventDefault();
      if($(this).parsley().isValid())
      {
            var category_name = $("#category_name").val();
            var model_name = $("#model_name").val();
            var model_id = $("#model_id").val();
            var price = $("#price").val();
            var downpayment = $("#downpayment").val();
             $.ajax(
                    {

                        type: "POST",
                        url: "execute/updateseries.php",
                        data: "category_name=" + category_name + "&model_name="  + model_name + "&price=" + price + "&downpayment=" + downpayment + "&model_id="+ model_id +"&submit=",
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