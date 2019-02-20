<script src="javascripts/parsley.min.js"></script>
<div id="display"></div>
<div class="animated fadeInDown">
<div class="row">
  <div class="col-md-12">
    <div class="widget-container">
      <div class="heading">
        <i class="fa fa-shield"></i>Add Users
      </div>
      <div class="widget-content padded">
        <form parsley-validate id="addingusers" name="addingusers" class="form-horizontal">
          <fieldset>      

                          <div class="form-group">
                          <label  class="col-sm-2 control-label">Firstname</label>
                          <div class="col-sm-4">
                          <input type="text" class="form-control" name="firstname" required id="firstname" parsley-trigger="change" parsley-required="true" parsley-minlength="4" parsley-validation-minlength="1">
                          </div>
                           <label  class="col-sm-1 control-label">Middlename</label>
                          <div class="col-sm-4">
                          <input type="text" class="form-control" required  id="middlename" name="middlename" parsley-trigger="change" parsley-required="true" parsley-minlength="4" parsley-validation-minlength="1">
                          </div>
                          </div>

                          <div class="form-group">
                          <label  class="col-sm-2 control-label">Lastname</label>
                          <div class="col-sm-4">
                          <input type="text" class="form-control"  required id="lastname" name="lastname" parsley-trigger="change" parsley-required="true" parsley-minlength="4" parsley-validation-minlength="1">
                          </div>
                           <label  class="col-sm-1 control-label"></label>
                          <div class="col-sm-4">
                        
                          </div>
                          </div>

                          <div class="form-group">
                          <label  class="col-sm-2 control-label">Username</label>
                          <div class="col-sm-4">
                          <input type="text" class="form-control" required  id="username" name="username" parsley-trigger="change" parsley-required="true" parsley-minlength="4" parsley-validation-minlength="1">
                          </div>
                           <label  class="col-sm-1 control-label"></label>
                          <div class="col-sm-4">
                          </div>
                          </div>

                          <div class="form-group">
                          <label  class="col-sm-2 control-label">Password</label>
                          <div class="col-sm-4">
                          <input type="password" class="form-control" required id="password" name="password" parsley-trigger="change" parsley-required="true" parsley-minlength="6" parsley-type="alphanum" parsley-validation-minlength="1">
                          </div>
                           <label  class="col-sm-1 control-label">Confirm Password</label>
                          <div class="col-sm-4">
                          <input type="password" class="form-control" required  id="passwordconfirm" name="passwordconfirm" parsley-trigger="change" parsley-required="true" parsley-minlength="6" parsley-type="alphanum" parsley-validation-minlength="1" parsley-equalto="#password">
                          </div>
                          </div>

                          <div class="form-group">
                          <label  class="col-sm-2 control-label">Contact</label>
                          <div class="col-sm-4">
                          <input type="text" class="form-control" required id="contact" name="contact" parsley-trigger="change" parsley-minlength="4" parsley-type="number" parsley-validation-minlength="1">
                          </div>
                           <label  class="col-sm-1 control-label"></label>
                          <div class="col-sm-4">
                          </div>
                          </div>

                          <div class="form-group">
                          <label  class="col-sm-2 control-label">Account Type</label>
                          <div class="col-sm-4">
                          <select class="form-control" id="accounttype" id="branch" name="branch" parsley-trigger="change" parsley-required="true" parsley-error-container="#selectbox">
                          <option value="">Please choose</option>
                            <option value="Accounting">Accounting</option>
                            <option value="Branch Manager">Branch Manager</option>
                            <option value="Regional Manager">Regional Manager</option>
                            <option value="Administrator">Administrator</option>
                            <option value="Credit Investigator">Credit Investigator</option>
                          </select>
                          </div>
                           <label  class="col-sm-1 control-label">Branch</label>
                          <div class="col-sm-4">
                         <select class="form-control" id="branch" required id="accounttype" name="accounttype" parsley-trigger="change" parsley-required="true" parsley-error-container="#selectbox">
                         <option value="">Please choose</option>
                            <option value="Cordova">Cordova</option>
                            <option value="Mandaue">Mandaue</option>
                            
                          </select></div>
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

  
     $("#addingusers").submit(function (e) 
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
           
             $.ajax(
                    {

                        type: "POST",
                        url: "execute/add_users.php",
                        data: "firstname=" + firstname + "&middlename=" + middlename + "&lastname=" + lastname + "&username="+ username +"&password=" + password + "&contact=" +contact+ "&branch=" +branch+ "&accounttype=" + accounttype + "&submit=",
                        cache: false,
                        success: function (data) 
                        {
                            
                            $("#addingusers").trigger("reset");
                             
                            $("#display").html(data);
                          
                            $("#addingusers").parsley().reset();                                      
                        }

                    });

            
            return false; 
            }
         });    
});
</script>