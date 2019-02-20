
<div class="animated fadeInDown">
<div class="row hidden-print">
          <div class="col-md-12">
            <div class="widget-container fluid-height">
              <div class="heading">
                <span class="fa fa-bar-chart-o"></span>Reports
              </div>
              <div class="widget-content padded">
                   <form class="form-horizontal" method="post" id="reportsform" >
                          <div class="form-group">
                          <div class="col-md-1">
                          
                          </div>
                          <div class="col-md-2">
                          Date From:
                          </div>
                          <div class="col-md-3">
                         <input type="date"  class="form-control" required id="datefrom" name="datefrom">
                         </div>
                          <div class="col-md-1">
                          
                          </div>
                          <div class="col-md-1">
                          Date To:
                          </div>
                          <div class="col-md-3">
                         <input type="date"  class="form-control" required id="dateto" name="dateto">
                         </div>
                          <div class="col-md-3">
                         </div>
                        </div>
                        <div class="form-group">
                       <!--    <div class="col-md-1">
                          
                          </div>
                          <div class="col-md-2">
                          Search
                          </div>
                          <div class="col-md-3">
                          <select class="form-control" id="search_name">
                            <option value="">CHOOSE</option>
                            <option value="all">All</option>
                            <option value="category_name">Category Name</option>
                             <option value="model_name">Model Name</option>
                             <option value="customer_name">Customer Name</option>
                         
                          </select>
                         </div>
                          <div class="col-md-3">
                          <input type="text" class="form-control" id="searchcat" name="searchcat" placeholder="Input Search">
                          </div> -->
                          <div class="col-md-5"></div>
                          <div class="col-md-3">
                          <input type="submit" value="SEARCH" name="submit" id="submit" class="btn btn-primary btn-block btn-lg">
                          </div>
                         
                         
                         </div>
                        </div>
                    </form>
              </div>
            </div>
          </div>
</div>
</div>
         
        <script>
        $(document).ready(function  ()
        {
           $("#reportsform").submit(function (e) 
     {     
           var  datefrom = $("#datefrom").val();
           var  dateto  = $("#dateto").val();
           var  search_name = $("#search_name").val();
           var searchcat = $("#searchcat").val();

             $.ajax(
                    {

                        type: "POST",
                        url: "execute/results.php",
                        data: "datefrom="+datefrom+"&dateto="+dateto+"&search_name="+search_name+"&searchcat="+searchcat+"&SUBMIT=",
                        cache: false,
                        success: function (data) 
                        {
                            
                           
                            $("#display").html(data);
                      

                        }

                    });

            
            return false; 
        })

            $("#dateto").change(function (e) 
     {     
           var  datefrom = $("#datefrom").val();
           var  dateto  = $("#dateto").val();
           
           if (datefrom > dateto) 
            {
              alert("INVALID DATE TIME RANGE");
              $("#dateto").val(" ");

              $("#dateto").focus();
            
            };

      
        })

        });

        </script>

<div id="display"></div>