<?php include("db/connection.php"); ?>
<?php
	extract($_POST);
	if(!empty($sid)) {

		 $stmt = $dbConn->prepare("SELECT * FROM users WHERE username =:sid");
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
        <i class="fa fa-user"></i>Edit Users<div class=" pull-right"><a href="#" class="fa fa-undo" id="backsettings" style="font-size:20px;"></a></div>
    
      </div>
      <div class="widget-content padded">
        <form parsley-validate id="editusers" name="editusers" class="form-horizontal">
          <fieldset>      

                          <div class="form-group">
                          <label  class="col-sm-2 control-label">Firstname</label>
                          <div class="col-sm-4">
                          <input type="text" class="form-control" value="<?php echo $row['firstname'];?>" name="firstname" required id="firstname" parsley-trigger="change" parsley-required="true" parsley-minlength="4" parsley-validation-minlength="1">
                          </div>
                           <label  class="col-sm-1 control-label">Middlename</label>
                          <div class="col-sm-4">
                          <input type="text" class="form-control" required  value="<?php echo $row['middlename'];?>" id="middlename" name="middlename" parsley-trigger="change" parsley-required="true" parsley-minlength="4" parsley-validation-minlength="1">
                          </div>
                          </div>

                          <div class="form-group">
                          <label  class="col-sm-2 control-label">Lastname</label>
                          <div class="col-sm-4">
                          <input type="text" class="form-control"  value="<?php echo $row['lastname'];?>" required id="lastname" name="lastname" parsley-trigger="change" parsley-required="true" parsley-minlength="4" parsley-validation-minlength="1">
                          </div>
                           <label  class="col-sm-1 control-label"></label>
                          <div class="col-sm-4">
                        
                          </div>
                          </div>

                          <div class="form-group">
                          <label  class="col-sm-2 control-label">Username</label>
                          <div class="col-sm-4">
                          <input type="text" class="form-control" value="<?php echo $row['username'];?>" required  id="username" name="username" parsley-trigger="change" parsley-required="true" parsley-minlength="4" parsley-validation-minlength="1">
                          </div>
                           <label  class="col-sm-1 control-label"></label>
                          <div class="col-sm-4">
                          </div>
                          </div>

                          <div class="form-group">
                          <label  class="col-sm-2 control-label">Password</label>
                          <div class="col-sm-4">
                          <input type="password" class="form-control" value="<?php echo $row['password'];?>" required id="password" name="password" parsley-trigger="change" parsley-required="true" parsley-minlength="6" parsley-type="alphanum" parsley-validation-minlength="1">
                          </div>
                           <label  class="col-sm-1 control-label">Confirm Password</label>
                          <div class="col-sm-4">
                          <input type="password" class="form-control" required  value="<?php echo $row['password'];?>" id="passwordconfirm" name="passwordconfirm" parsley-trigger="change" parsley-required="true" parsley-minlength="6" parsley-type="alphanum" parsley-validation-minlength="1" parsley-equalto="#password">
                          </div>
                          </div>

                          <div class="form-group">
                          <label  class="col-sm-2 control-label">Contact</label>
                          <div class="col-sm-4">
                          <input type="text" class="form-control" required id="contact" value="<?php echo $row['contact'];?>" name="contact" parsley-trigger="change" parsley-minlength="4" parsley-type="number" parsley-validation-minlength="1">
                          </div>
                           <label  class="col-sm-1 control-label"></label>
                          <div class="col-sm-4">
                          </div>
                          </div>

                          <div class="form-group">
                          <label  class="col-sm-2 control-label">Account Type</label>
                          <div class="col-sm-4">
                          <select class="form-control" id="accounttype" id="branch" name="branch" parsley-trigger="change" parsley-required="true" parsley-error-container="#selectbox">
                          <option value="Branch Manager" <?php if($row['type'] == 'Branch Manager'){ echo 'selected';}else{echo ''; }?> >Branch Manager</option>
                                              <option value="Credit Investigator" <?php if($row['type'] == 'Credit Investigator'){ echo 'selected';}else{echo ''; }?>>Credit Investigator</option>
                                              <option value="Accounting" <?php if($row['type'] == 'Accounting'){ echo 'selected';}else{echo ''; }?>>Accounting</option>
                                              <option value="Regional Manager" <?php if($row['type'] == 'Regional Manager'){ echo 'selected';}else{echo ''; }?>>Regional Manager</option>
                          </select>
                          </div>
                           <label  class="col-sm-1 control-label">Branch</label>
                          <div class="col-sm-4">
                         <select class="form-control" id="branch" required id="accounttype" name="accounttype" parsley-trigger="change" parsley-required="true" parsley-error-container="#selectbox">
                        <option value="Mandaue" <?php if($row['branchid'] == 'Mandaue'){ echo 'selected';}else{echo ''; }?>>Mandaue</option>
                                                <option value="Cordova" <?php if($row['branchid'] == 'Cordova'){ echo 'selected';}else{echo ''; }?>>Cordova</option>
                                          
                            
                          </select></div>
                          </div>
                          <div class="form-group">
                          <label  class="col-sm-2 control-label">Status</label>
                          <div class="col-sm-4">
                         <select class="form-control" name="status" id="status" >
                                              <option value="active">Active</option>
                                              <option value="not active">Not Active</option>
                                            </select>
                          </div>
                           <label  class="col-sm-1 control-label"></label>
                          <div class="col-sm-4">
                        </div>
                          </div>
                           <div class="form-group">
                          <label  class="col-sm-2 control-label"></label>
                          <div class="col-sm-5">
                          <input type="submit" class="btn btn-primary btn-lg btn-block">
                          </div>
                           
                          <div class="col-sm-3">
                           <input type="reset" class="btn btn-danger btn-lg btn-block">
                         
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
        $("#content").load("userlist.php");
     });
  
     $("#editusers").submit(function (e) 
     {      
       e.preventDefault();
      if($(this).parsley().isValid())
      {
            var firstname = $("#firstname").val();
            var middlename = $("#middlename").val();
            var lastname = $("#lastname").val();
            var username = $("#username").val();
            var password = $("#password").val();
            var contact = $("#contact").val();
            var branch  = $("#branch").val();
            var accounttype = $("#accounttype").val();
            var status = $("#status").val();
           
             $.ajax(
                    {

                        type: "POST",
                        url: "execute/update_users.php",
                        data: "firstname=" + firstname + "&middlename="  + middlename + "&status=" + status + "&lastname=" + lastname + "&username="+ username +"&password=" + password + "&contact=" +contact+ "&branch=" +branch+ "&accounttype=" + accounttype + "&submit=",
                        cache: false,
                        success: function (data) 
                        {
                            
                            $("#editusers").trigger("reset");
                             
                            $("#display").html(data);
                          $("#content").load("userlist.php",10000);
                          
                                                            
                        }

                    });

            
            return false; 
            }
         });    
});
</script>
<div class="row"></div>